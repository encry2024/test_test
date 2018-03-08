<?php

namespace App\Http\Controllers\Backend\Inventory;

use App\Models\Inventory\Inventory;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Inventory\InventoryRepository;
use App\Http\Requests\Backend\Inventory\RestoreInventoryRequest;
use App\Http\Requests\Backend\Inventory\ForceDeleteInventoryRequest;
use App\Http\Requests\Backend\Inventory\ManageInventoryRequest;

/**
 * Class InventoryStatusController.
 */
class InventoryStatusController extends Controller
{
    /**
     * @var InventoryRepository
     */
    protected $inventoryRepository;

    /**
     * @param InventoryRepository $inventoryRepository
     */
    public function __construct(InventoryRepository $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ManageInventoryRequest $request)
    {
        return view('backend.inventory.deleted')
            ->withInventories($this->inventoryRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    /**
     * @param Inventory              $deletedInventory
     * @param ManageInventoryRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function delete(Inventory $deletedInventory, ForceDeleteInventoryRequest $request)
    {
        $this->inventoryRepository->forceDelete($deletedInventory);

        return redirect()->route('admin.inventory.deleted')->withFlashSuccess(__('alerts.backend.inventories.deleted_permanently', ['item' => $deletedInventory->name]));
    }

    /**
     * @param Inventory              $deletedInventory
     * @param ManageInventoryRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(Inventory $deletedInventory, RestoreInventoryRequest $request)
    {
        $this->inventoryRepository->restore($deletedInventory);

        return redirect()->route('admin.inventory.index')->withFlashSuccess(__('alerts.backend.inventories.restored', ['item' => $deletedInventory->name]));
    }
}
