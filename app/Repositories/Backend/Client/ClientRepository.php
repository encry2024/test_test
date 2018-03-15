<?php
/**
 * Created by PhpStorm.
 * User: christanjake2024
 * Date: 1/26/18
 * Time: 2:06 PM
 */

namespace App\Repositories\Backend\Client;

use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Client\Client;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Models\Auth\User;

use App\Events\Backend\Client\ClientCreated;
use App\Events\Backend\Client\ClientUpdated;
use App\Events\Backend\Client\ClientRestored;
use App\Events\Backend\Client\ClientPermanentlyDeleted;
/**
 * Class ClientRepository.
 */
class ClientRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Client::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getPaginatedClient($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @return Client
     */
    public function create(array $data) : Client
    {
        return DB::transaction(function () use ($data) {
            $client = parent::create([
                'name'                              =>  strtoupper($data['name']),
                'contact_person_first_name'         =>  strtoupper($data['contact_person_first_name']),
                'contact_person_last_name'          =>  strtoupper($data['contact_person_last_name']),
                'contact_person_contact_number'     =>  $data['contact_person_contact_number'],
                'contact_person_email'              =>  $data['contact_person_email'],
                'address'                           =>  strtoupper($data['address'])
            ]);

            if ($client) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = "<a href='".route('admin.client.show', $client->id)."'>".$client->name.'</a>';

                $user = new User();
                $user->first_name = $client->contact_person_first_name;
                $user->last_name  = $client->contact_person_last_name;
                $user->email      = $client->contact_person_email;
                $user->password   = bcrypt('cmms123');
                $user->active     = 1;
                $user->confirmed  = 1;
                $user->timezone   = 'Asia/Manila';
                $user->avatar_type= 'gravatar';
                $user->save();

                event(new ClientCreated($auth_link, $asset_link));

                return $client;
            }

            throw new GeneralException(__('exceptions.backend.clients.create_error'));
        });
    }

    /**
     * @param Client  $client
     * @param array $data
     *
     * @return Client
     */
    public function update(Client $client, array $data) : Client
    {
        return DB::transaction(function () use ($client, $data) {
            if ($client->update([
                'name'                              =>  strtoupper($data['name']),
                'contact_person_first_name'         =>  $data['contact_person_first_name'],
                'contact_person_last_name'          =>  $data['contact_person_last_name'],
                'contact_person_contact_number'     =>  $data['contact_person_contact_number'],
                'contact_person_email'              =>  $data['contact_person_email'],
                'address'                           =>  $data['address']
            ]))

            {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = "<a href='".route('admin.client.show', $client->id)."'>".$client->name.'</a>';

                event(new ClientUpdated(Auth::user()->full_name, $asset_link));

                return $client;
            }

            throw new GeneralException(__('exceptions.backend.clients.update_error'));
        });
    }

    /**
     * @param Client $client
     *
     * @return Client
     * @throws GeneralException
     */
    public function forceDelete(Client $client) : Client
    {
        if (is_null($client->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.client.delete_first'));
        }

        return DB::transaction(function () use ($client) {

            if ($client->forceDelete()) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';

                event(new ClientPermanentlyDeleted($auth_link, $client->name));

                return $client;
            }

            throw new GeneralException(__('exceptions.backend.clients.delete_error'));
        });
    }

    /**
     * @param Client $client
     *
     * @return Client
     * @throws GeneralException
     */
    public function restore(Client $client) : Client
    {
        if (is_null($client->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.client.cant_restore'));
        }

        if ($client->restore()) {
            $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
            $asset_link = "<a href='".route('admin.client.show', $client->id)."'>".$client->name.'</a>';

            event(new ClientRestored($auth_link, $asset_link));

            return $client;
        }

        throw new GeneralException(__('exceptions.backend.client.restore_error'));
    }
}
