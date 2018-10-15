<?php

namespace App\Http\Controllers\Backend\Inventory\UnitType;

# Facades
use Illuminate\Http\Request;
use Auth;
# Controllers
use App\Http\Controllers\Controller;
# Requests
use App\Http\Requests\Backend\Inventory\UnitType\ManageUnitTypeRequest;
use App\Http\Requests\Backend\Inventory\UnitType\StoreUnitTypeRequest;
use App\Http\Requests\Backend\Inventory\UnitType\UpdateUnitTypeRequest;
# Repository
use App\Repositories\Backend\Inventory\UnitType\UnitTypeRepository;
# Models
use App\Models\UnitType\UnitType;
use App\Http\Requests\Backend\Inventory\DeleteInventoryRequest;

class UnitTypeController extends Controller
{
    /**
     *
     * @var UnitTypeRepository $unitTypeRepository
     */
    protected $unitTypeRepository;

    public function __construct(UnitTypeRepository $unitTypeRepository)
    {
        $this->unitTypeRepository = $unitTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageUnitTypeRequest $request)
    {
        $unit_types = UnitType::all();

        return view('backend.inventory.unit_type.index', compact('unit_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnitTypeRequest $request)
    {
        $this->unitTypeRepository->create($request->only('name', 'description'));

        return redirect()->back()->withFlashSuccess('Unit Type "'. strtoupper($request->name) .'" was successfully created');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnitTypeRequest $request, UnitType $unit_type)
    {
        $this->unitTypeRepository->update($unit_type, $request->only('name', 'description'));

        return redirect()->back()->withFlashSuccess('Unit Type "'.$unit_type->name.'" was successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnitType $unit_type, DeleteInventoryRequest $request)
    {
        $this->unitTypeRepository->deleteById($unit_type->id);

        $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
        $asset_link = "<a href='".route('admin.inventory.unit_type.show', $unit_type->id)."'>".$unit_type->name.'</a>';

        event(new UnitTypeDeleted($auth_link, $asset_link));

        return redirect()->back()->withFlashSuccess(__('alerts.backend.unit_types.deleted', ['unit_type' => $unit_type->name]));
    }
}
