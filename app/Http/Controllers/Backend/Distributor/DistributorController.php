<?php

namespace App\Http\Controllers\Backend\Distributor;

# Requests
use App\Http\Requests\Backend\Distributor\ManageDistributorRequest;
use App\Http\Requests\Backend\Distributor\StoreDistributorRequest;
use App\Http\Requests\Backend\Distributor\UpdateDistributorRequest;
# Controllers
use App\Http\Controllers\Controller;
# Models
use App\Models\Distributor\Distributor;
# Repository
use App\Repositories\Backend\Distributor\DistributorRepository;

class DistributorController extends Controller
{
    protected $distributorRepository;

    public function __construct(DistributorRepository $distributorRepository)
    {
        $this->distributorRepository = $distributorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageDistributorRequest $request)
    {
        return view('backend.distributor.index')
            ->withDistributors($this->distributorRepository->getPaginatedDistributors(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ManageDistributorRequest $request)
    {
        return view('backend.distributor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistributorRequest $request)
    {
        $this->distributorRepository->create($request->only(
            'name',
                'contact_person_first_name',
                'contact_person_last_name',
                'contact_number',
                'address',
                'email'
        ));

        return redirect()->back()->withFlashSuccess(__('alerts.backend.distributors.created', ['distributor' => strtoupper($request->name)]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Distributor $distributor, ManageDistributorRequest $request)
    {
        return view('backend.distributor.show')->withDistributor($distributor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Distributor $distributor, ManageDistributorRequest $request)
    {
        return view('backend.distributor.edit')->withDistributor($distributor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDistributorRequest $request, Distributor $distributor)
    {
        $this->distributorRepository->update($distributor, $request->only(
            'name',
                'contact_person_first_name',
                'contact_person_last_name',
                'contact_number',
                'email',
                'address'
        ));

        return redirect()->back()->withFlashSuccess(__('alerts.backend.distributors.updated', ['distributor' => strtoupper($distributor->name)]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distributor $distributor, ManageDistributorRequest $request)
    {
        $this->distributorRepository->deleteById($distributor->id);

        return redirect()->route('admin.supplier.deleted')->withFlashSuccess(__('alerts.backend.distributors.deleted', ['distributor' => $distributor->name]));
    }
}
