<?php

namespace App\Http\Controllers\Backend\Distributor;

use App\Models\Distributor\Distributor;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Distributor\DistributorRepository;
use App\Http\Requests\Backend\Distributor\RestoreDistributorRequest;
use App\Http\Requests\Backend\Distributor\ForceDeleteDistributorRequest;
use App\Http\Requests\Backend\Distributor\ManageDistributorRequest;

/**
 * Class DistributorStatusController.
 */
class DistributorStatusController extends Controller
{
    /**
     * @var DistributorRepository
     */
    protected $distributorRepository;

    /**
     * @param DistributorRepository $distributorRepository
     */
    public function __construct(DistributorRepository $distributorRepository)
    {
        $this->distributorRepository = $distributorRepository;
    }

    /**
     * @param ManageDistributorRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ManageDistributorRequest $request)
    {
        return view('backend.distributor.deleted')
            ->withDistributors($this->distributorRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    /**
     * @param Distributor              $deletedDistributor
     * @param ManageDistributorRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function delete(Distributor $deletedDistributor, ForceDeleteDistributorRequest $request)
    {
        $this->distributorRepository->forceDelete($deletedDistributor);

        return redirect()->route('admin.distributor.deleted')->withFlashSuccess(__('alerts.backend.distributors.deleted_permanently', ['distributor' => $deletedDistributor->name]));
    }

    /**
     * @param Distributor              $deletedDistributor
     * @param ManageDistributorRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(Distributor $deletedDistributor, RestoreDistributorRequest $request)
    {
        $this->distributorRepository->restore($deletedDistributor);

        return redirect()->route('admin.distributor.index')->withFlashSuccess(__('alerts.backend.distributors.restored', ['distributor' => $deletedDistributor->name]));
    }
}
