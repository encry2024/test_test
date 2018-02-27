<?php
/**
 * Created by PhpStorm.
 * User: christanjake2024
 * Date: 1/26/18
 * Time: 2:06 PM
 */

namespace App\Repositories\Backend\Inventory;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Inventory\Inventory;
use App\Models\UnitType\UnitType;

use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;


/**
 * Class InventoryRepository.
 */
class InventoryRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Inventory::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getPaginatedInventory($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
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
     * @return Inventory
     */
    public function create(array $data) : Inventory
    {
        return DB::transaction(function () use ($data) {
            $inventory = parent::create([
                'distributor_id'        =>  $data['distributor'],
                'unit_type_id'          =>  $data['unit_type'],
                'name'                  =>  strtoupper($data['name']),
                'stocks'                =>  $data['stocks'],
                'critical_stocks_level' =>  $data['critical_stocks_level'],
                'price_per_unit'        =>  str_replace(',','',$data['price_per_unit'])
            ]);

            if ($inventory) {
                return $inventory;
            }

            throw new GeneralException(__('exceptions.backend.inventories.create_error'));
        });
    }

    /**
     * @param Inventory  $inventory
     * @param array $data
     *
     * @return Inventory
     */
    public function update(Inventory $inventory, array $data) : Inventory
    {
        return DB::transaction(function () use ($inventory, $data) {
            if ($inventory->update([
                'distributor_id'        =>  $data['distributor'],
                'unit_type_id'          =>  $data['unit_type_id'],
                'name'                  =>  strtoupper($data['name']),
                'stocks'                =>  $data['stocks'],
                'critical_stocks_level' =>  $data['critical_stocks_level'],
                'price_per_unit'        =>  str_replace(',','',$data['price_per_unit'])
            ]))

            {
                return $inventory;
            }

            throw new GeneralException(__('exceptions.backend.inventories.update_error'));
        });
    }

    /**
     * @param Inventory $inventory
     *
     * @return Inventory
     * @throws GeneralException
     */
    public function forceDelete(Inventory $inventory) : Inventory
    {
        if (is_null($inventory->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.inventories.delete_first'));
        }

        return DB::transaction(function () use ($inventory) {

            if ($inventory->forceDelete()) {
                return $inventory;
            }

            throw new GeneralException(__('exceptions.backend.inventories.delete_error'));
        });
    }

    /**
     * @param item $inventory
     *
     * @return item
     * @throws GeneralException
     */
    public function restore(Inventory $inventory) : Inventory
    {
        if (is_null($inventory->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.inventories.cant_restore'));
        }

        if ($inventory->restore()) {
            return $inventory;
        }

        throw new GeneralException(__('exceptions.backend.inventories.restore_error'));
    }
}
