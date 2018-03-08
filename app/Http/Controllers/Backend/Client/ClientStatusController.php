<?php

namespace App\Http\Controllers\Backend\Client;

use App\Models\Client\Client;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Client\ClientRepository;
use App\Http\Requests\Backend\Client\RestoreClientRequest;
use App\Http\Requests\Backend\Client\ForceDeleteClientRequest;
use App\Http\Requests\Backend\Client\ManageClientRequest;

/**
 * Class ClientStatusController.
 */
class ClientStatusController extends Controller
{
    /**
     * @var ClientRepository
     */
    protected $clientRepository;

    /**
     * @param ClientRepository $clientRepository
     */
    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * @param ManageClientRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ManageClientRequest $request)
    {
        return view('backend.client.deleted')
            ->withClients($this->clientRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    /**
     * @param Client              $deletedClient
     * @param ManageClientRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function delete(Client $deletedClient, ForceDeleteClientRequest $request)
    {
        $this->clientRepository->forceDelete($deletedClient);

        return redirect()->route('admin.client.deleted')->withFlashSuccess(__('alerts.backend.clients.deleted_permanently', ['client' => $deletedClient->name]));
    }

    /**
     * @param Client              $deletedClient
     * @param ManageClientRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(Client $deletedClient, RestoreClientRequest $request)
    {
        $this->clientRepository->restore($deletedClient);

        return redirect()->route('admin.client.index')->withFlashSuccess(__('alerts.backend.clients.restored', ['client' => $deletedClient->name]));
    }

    public function showDeletedProfile(Client $deletedClient, ManageClientRequest $request)
    {
        return view('backend.client.show')->withClient($deletedClient);
    }
}
