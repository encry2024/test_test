<?php

namespace App\Http\Controllers\Backend\Inventory;

# Controllers
use App\Http\Controllers\Controller;
# Requests
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Inventory\ManageInventoryRequest;
use App\Http\Requests\Backend\Inventory\UpdateInventoryRequest;
use App\Http\Requests\Backend\Inventory\StoreInventoryRequest;
use App\Repositories\Backend\Inventory\InventoryRepository;
# Models
use App\Models\Inventory\Inventory;
use App\Models\Distributor\Distributor;
use App\Models\UnitType\UnitType;

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
