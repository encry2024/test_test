<?php
/**
 * Created by PhpStorm.
 * User: christanjake2024
 * Date: 1/26/18
 * Time: 2:06 PM
 */

namespace App\Repositories\Backend\Transaction;

# Facades
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
# Models
use App\Models\Transaction\Transaction;
use App\Models\ClientTransaction\ClientTransaction;
use App\Models\Inventory\Inventory;
use Auth;
use App\Models\Auth\User;
use App\Models\Client\Client;
# Exceptions
use App\Exceptions\GeneralException;
# Repository
use App\Repositories\BaseRepository;
# Events
use App\Events\Backend\Transaction\TransactionCreated;
use App\Events\Backend\Transaction\TransactionUpdated;
use App\Events\Backend\Transaction\TransactionRestored;
use App\Events\Backend\Transaction\TransactionPermanentlyDeleted;

/**
 * Class TransactionRepository.
 */
class TransactionRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Transaction::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getPaginatedTransaction($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->with(['user', 'accounted_client'])
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
     * @return Transaction
     */
    public function create(array $data) : Transaction
    {
        return DB::transaction(function () use ($data) {
            $client         = Client::find($data['client']);

            $transaction = parent::create([
                'user_id'               =>  Auth::user()->id,
                'client_id'             =>  $client->id,
                'status'                =>  'DELIVERED'
            ]);

            if ($transaction) {
                foreach ($data['orders'] as $key => $value) {
                    $inventory          = Inventory::find($key);
                    $total_price        = $inventory->price_per_unit * $value;
                    $total_stocks       = $inventory->stocks - $value;

                    $client_transaction = ClientTransaction::create([
                        'transaction_id'    =>  $transaction->id,
                        'inventory_id'      =>  $key,
                        'delivered_stocks'  =>  $value,
                        'total_price'       =>  $total_price
                    ]);

                    $inventory->update(['stocks' => $total_stocks]);
                }

                $transaction->update(['reference_id' => date('Y-m-d-').$transaction->id]);

                $auth_link  = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = "<a href='".route('admin.client.show', $data['client'])."'>".$transaction->reference_id.'</a>';

                event(new TransactionCreated($auth_link, $asset_link));

                return $transaction;
            }

            throw new GeneralException(__('exceptions.backend.inventories.create_error'));
        });
    }

    /**
     * @param Transaction  $transaction
     * @param array $data
     *
     * @return Transaction
     */
    public function update(Transaction $transaction, array $data) : Transaction
    {
        return DB::transaction(function () use ($transaction, $data) {
            if ($transaction->update([
                'distributor_id'        =>  $data['distributor'],
                'unit_type_id'          =>  $data['unit_type'],
                'name'                  =>  strtoupper($data['name']),
                'stocks'                =>  str_replace(',','',$data['stocks']),
                'critical_stocks_level' =>  str_replace(',','',$data['critical_stocks_level']),
                'price_per_unit'        =>  str_replace(',','',$data['price_per_unit'])
            ]))

            {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = "<a href='".route('admin.inventory.show', $transaction->id)."'>".$transaction->name.'</a>';

                event(new TransactionUpdated($auth_link, $asset_link));

                return $transaction;
            }

            throw new GeneralException(__('exceptions.backend.inventories.update_error'));
        });
    }

    /**
     * @param Transaction $transaction
     *
     * @return Transaction
     * @throws GeneralException
     */
    public function forceDelete(Transaction $transaction) : Transaction
    {
        if (is_null($transaction->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.inventories.delete_first'));
        }

        return DB::transaction(function () use ($transaction) {

            if ($transaction->forceDelete()) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';

                event(new TransactionPermanentlyDeleted($auth_link, $transaction->name));

                return $transaction;
            }

            throw new GeneralException(__('exceptions.backend.inventories.delete_error'));
        });
    }

    /**
     * @param item $transaction
     *
     * @return item
     * @throws GeneralException
     */
    public function restore(Transaction $transaction) : Transaction
    {
        if (is_null($transaction->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.inventories.cant_restore'));
        }

        if ($transaction->restore()) {
            $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
            $asset_link = "<a href='".route('admin.inventory.show', $transaction->id)."'>".$transaction->name.'</a>';

            event(new TransactionRestored(Auth::user()->full_name, $asset_link));

            return $transaction;
        }

        throw new GeneralException(__('exceptions.backend.inventories.restore_error'));
    }
}
