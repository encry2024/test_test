<?php

namespace App\Http\Controllers\Backend\Client;

# Requests
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Client\ManageClientRequest;
use App\Http\Requests\Backend\Client\StoreClientRequest;
use App\Http\Requests\Backend\Client\UpdateClientRequest;
# Controllers
use App\Http\Controllers\Controller;
# Models
use App\Models\Client\Client;
# Repository
use App\Repositories\Backend\Client\ClientRepository;


class ClientController extends Controller
{
    /**
     * @var ClientRepository
     *
     */

    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageClientRequest $request)
    {
        return view('backend.client.index')
            ->withClients($this->clientRepository->getPaginatedClient(25, 'id', 'desc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ManageClientRequest $request)
    {
        return view('backend.client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        $this->clientRepository->create($request->only(
            'name',
            'contact_person_first_name',
            'contact_person_last_name',
            'contact_person_email',
            'contact_person_contact_number',
            'address'
        ));

        return redirect()->back()->withFlashSuccess(__('alerts.backend.clients.created', ['client' => strtoupper($request->name)]));
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
