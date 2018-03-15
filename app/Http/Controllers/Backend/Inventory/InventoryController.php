<?php

namespace App\Http\Controllers\Backend\Inventory;

use Auth;
# Controllers
use App\Http\Controllers\Controller;
# Requests
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Inventory\ManageInventoryRequest;
use App\Http\Requests\Backend\Inventory\UpdateInventoryRequest;
use App\Http\Requests\Backend\Inventory\StoreInventoryRequest;
use App\Http\Requests\Backend\Inventory\DeleteInventoryRequest;
# Repository
use App\Repositories\Backend\Inventory\InventoryRepository;
# Models
use App\Models\Inventory\Inventory;
use App\Models\Distributor\Distributor;
use App\Models\UnitType\UnitType;
# Events
use App\Events\Backend\Inventory\InventoryDeleted;
use App\Events\Backend\Inventory\InventoryRestocked;

class InventoryController extends Controller
{
    /**
     * @var InventoryRepository
     */
    protected $inventoryRepository;

    /**
     * InventoryController constructor.
     *
     * @param InventoryRepository $inventoryRepository
     */
    public function __construct(inventoryRepository $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageInventoryRequest $request)
    {
        return view('backend.inventory.index')
        ->withInventories($this->inventoryRepository->getPaginatedInventory('25', 'id', 'desc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ManageInventoryRequest $request)
    {
        $distributors   = Distributor::all();
        $unit_types     = UnitType::all();

        return view('backend.inventory.create', compact('distributors', 'unit_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInventoryRequest $request)
    {
        $this->inventoryRepository->create($request->only(
            'distributor',
            'unit_type',
            'name',
            'stocks',
            'critical_stocks_level',
            'price_per_unit'
        ));

        return redirect()->back()
            ->withFlashSuccess(__('alerts.backend.inventories.created', ['item' => strtoupper($request->name)]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory, ManageInventoryRequest $request)
    {
        /*$inventory->with(['distributor' => function($query) {
            $query->withTrashed();
        }])->withTrashed()*/
        return view('backend.inventory.show')->withItem($inventory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory, ManageInventoryRequest $request)
    {
        $distributors   = Distributor::all();
        $unit_types     = UnitType::all();

        return view('backend.inventory.edit')->withInventory($inventory)->withDistributors($distributors)->with('unit_types', $unit_types);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInventoryRequest $request, Inventory $inventory)
    {
        $this->inventoryRepository->update($inventory, $request->only(
            'distributor',
            'unit_type',
            'name',
            'stocks',
            'critical_stocks_level',
            'price_per_unit'
        ));

        return redirect()->back()->withFlashSuccess(__('alerts.backend.inventories.updated', ['item' => $inventory->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory, DeleteInventoryRequest $request)
    {
        $this->inventoryRepository->deleteById($inventory->id);

        $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
        $asset_link = "<a href='".route('admin.inventory.show', $inventory->id)."'>".$inventory->name.'</a>';

        event(new InventoryDeleted($auth_link, $asset_link));

        return redirect()->back()->withFlashSuccess(__('alerts.backend.inventories.deleted', ['item' => $inventory->name]));

        // return redirect()->route('admin.inventory.deleted')->withFlashSuccess(__('alerts.backend.inventorys.deleted', ['inventory' => $inventory->name]));
    }

    public function addStocks(Request $request, Inventory $inventory)
    {
        $requested_stock = $request->stocks;
        $current_stock   = $inventory->stocks;
        $total_stocks    = $requested_stock + $current_stock;

        if ($inventory->update(['stocks' => $total_stocks])) {
            $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
            $asset_link = "<a href='".route('admin.inventory.show', $inventory->id)."'>".$inventory->name.'</a>';

            event(new InventoryRestocked($auth_link, $requested_stock.$inventory->unit_type->name, $asset_link));
        }

        return redirect()->back()->withFlashSuccess('You have successfully restocked '.$request->stocks.$inventory->unit_type->name.' on item "'.$inventory->name);
    }

    public function getItem(Request $request)
    {
        $inventories = Inventory::with(['distributor', 'unit_type'])->where('id', $request->item_id)->first();

        return json_encode($inventories);
    }
}
