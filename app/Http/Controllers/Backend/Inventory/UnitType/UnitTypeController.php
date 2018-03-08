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
    public function destroy($id)
    {
        //
    }
}
