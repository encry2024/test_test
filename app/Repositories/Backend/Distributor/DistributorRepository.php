<?php

namespace App\Repositories\Backend\Distributor;

# Facades
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Auth;
# Models
use App\Models\Auth\User;
use App\Models\Distributor\Distributor;
# Exception
use App\Exceptions\GeneralException;
# Repository
use App\Repositories\BaseRepository;
# Events
use App\Events\Backend\Distributor\DistributorCreated;
use App\Events\Backend\Distributor\DistributorUpdated;
use App\Events\Backend\Distributor\DistributorRestored;
use App\Events\Backend\Distributor\DistributorPermanentlyDeleted;

/**
 * Class DistributorRepository.
 */
class DistributorRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Distributor::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getPaginatedDistributors($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
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
     * @return Distributor
     */
    public function create(array $data) : Distributor
    {
        return DB::transaction(function () use ($data) {
            $distributor = parent::create([
                'name'                      => strtoupper($data['name']),
                'contact_person_first_name' => strtoupper($data['contact_person_first_name']),
                'contact_person_last_name'  => strtoupper($data['contact_person_last_name']),
                'email'                     => $data['email'],
                'contact_number'            => $data['contact_number'],
                'address'                   => strtoupper($data['address'])
            ]);

            if ($distributor) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = "<a href='".route('admin.distributor.show', $distributor->id)."'>".$distributor->name.'</a>';

                event(new DistributorCreated($auth_link, $asset_link));

                return $distributor;
            }

            throw new GeneralException(__('exceptions.backend.distributors.create_error'));
        });
    }

    /**
     * @param Distributor  $distributor
     * @param array $data
     *
     * @return Distributor
     */
    public function update(Distributor $distributor, array $data) : Distributor
    {
        return DB::transaction(function () use ($distributor, $data) {
            if ($distributor->update([
                'name'                      => strtoupper($data['name']),
                'contact_person_first_name' => strtoupper($data['contact_person_first_name']),
                'contact_person_last_name'  => strtoupper($data['contact_person_last_name']),
                'email'                     => $data['email'],
                'contact_number'            => $data['contact_number'],
                'address'                   => strtoupper($data['address'])
            ]))

            {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = "<a href='".route('admin.distributor.show', $distributor->id)."'>".$distributor->name.'</a>';

                event(new DistributorUpdated($auth_link, $asset_link));

                return $distributor;
            }

            throw new GeneralException(__('exceptions.backend.distributors.update_error'));
        });
    }

    /**
     * @param User $distributor
     *
     * @return User
     * @throws GeneralException
     */
    public function forceDelete(Distributor $distributor) : Distributor
    {
        if (is_null($distributor->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.distributor.delete_first'));
        }

        return DB::transaction(function () use ($distributor) {

            if ($distributor->forceDelete()) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';

                event(new DistributorPermanentlyDeleted($auth_link, $distributor->name));

                return $distributor;
            }

            throw new GeneralException(__('exceptions.backend.distributors.delete_error'));
        });
    }

    /**
     * @param User $distributor
     *
     * @return User
     * @throws GeneralException
     */
    public function restore(Distributor $distributor) : Distributor
    {
        if (is_null($distributor->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.distributor.cant_restore'));
        }

        if ($distributor->restore()) {
            $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
            $asset_link = "<a href='".route('admin.distributor.show', $distributor->id)."'>".$distributor->name.'</a>';

            event(new DistributorRestored($auth_link, $asset_link));

            return $distributor;
        }

        throw new GeneralException(__('exceptions.backend.distributor.restore_error'));
    }
}
