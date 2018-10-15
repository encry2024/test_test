<?php
/**
 * Created by PhpStorm.
 * User: christanjake2024
 * Date: 1/26/18
 * Time: 2:06 PM
 */

namespace App\Repositories\Backend\Inventory;

# Facades
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
# Models
use App\Models\Inventory\Inventory;
use App\Models\UnitType\UnitType;
use Auth;
use App\Models\DistributorInventory\DistributorInventory;
# Exceptions
use App\Exceptions\GeneralException;
# Repository
use App\Repositories\BaseRepository;
# Events
use App\Events\Backend\Inventory\InventoryCreated;
use App\Events\Backend\Inventory\InventoryUpdated;
use App\Events\Backend\Inventory\InventoryRestored;
use App\Events\Backend\Inventory\InventoryPermanentlyDeleted;
use App\Events\Backend\Inventory\InventoryRestocked;

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
            $inventory = parent::updateById($data['inventory'], [
                'unit_type_id'          =>  $data['unit_type'],
                'stocks'                =>  str_replace(',','',$data['stocks']),
                'critical_stocks_level' =>  str_replace(',','',$data['critical_stocks_level']),
                'price_per_unit'        =>  str_replace(',','',$data['price_per_unit']),
                'stock_limit'           =>  str_replace(',', '', $data['stock_limit'])
            ]);

            if ($inventory) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = "<a href='".route('admin.inventory.show', $inventory->id)."'>".$inventory->name.'</a>';

                event(new InventoryUpdated($auth_link, $asset_link));

                return $inventory;
            }

            throw new GeneralException(__('exceptions.backend.inventories.update_error'));
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
                'unit_type_id'          =>  $data['unit_type'],
                'name'                  =>  strtoupper($data['name']),
                'stocks'                =>  str_replace(',','',$data['stocks']),
                'stock_limit'           =>  str_replace(',','',$data['stock_limit']),
                'critical_stocks_level' =>  str_replace(',','',$data['critical_stocks_level']),
                'price_per_unit'        =>  str_replace(',','',$data['price_per_unit'])
            ]))

            {
                $distributor_inventory = DistributorInventory::where('inventory_id', $inventory->id)->first();

                if ($distributor_inventory->update(['distributor_id' => $data['distributor']])) {
                    $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                    $asset_link = "<a href='".route('admin.inventory.show', $inventory->id)."'>".$inventory->name.'</a>';

                    event(new InventoryUpdated($auth_link, $asset_link));

                    return $inventory;
                }
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
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';

                event(new InventoryPermanentlyDeleted($auth_link, $inventory->name));

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
            $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
            $asset_link = "<a href='".route('admin.inventory.show', $inventory->id)."'>".$inventory->name.'</a>';

            event(new InventoryRestored(Auth::user()->full_name, $asset_link));

            return $inventory;
        }

        throw new GeneralException(__('exceptions.backend.inventories.restore_error'));
    }

    public function restock($inventory, $data)
    {
        $requested_stock = $data['stocks'];
        $current_stock   = $inventory->stocks;
        $total_stocks    = $requested_stock + $current_stock;

        if ($inventory->unit_type_id == 0) {
            return redirect()->back()->withFlashWarning('Cannot restock. Item does not have unit type. Click view button and add additional information.');
        } else {
            if ($inventory->update(['stocks' => $total_stocks])) {
                $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = "<a href='".route('admin.inventory.show', $inventory->id)."'>".$inventory->name.'</a>';

                event(new InventoryRestocked($auth_link, $requested_stock.$inventory->unit_type->name, $asset_link));

                return redirect()->back()->withFlashSuccess('You have successfully restocked '.$data['stocks'].$inventory->unit_type->name.' on item "'.$inventory->name.'"');
            }
        }
    }
}
