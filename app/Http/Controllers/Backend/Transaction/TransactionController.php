<?php

namespace App\Http\Controllers\Backend\Transaction;

# Facades
use Cookie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
# Models
use App\Models\Client\Client;
use App\Models\Inventory\Inventory;
use App\Models\Transaction\Transaction;
# Repository
use App\Repositories\Backend\Transaction\TransactionRepository;
# Events
use App\Events\Backend\Transaction\TransactionDeleted;
# Requests
use App\Http\Requests\Backend\Transaction\ManageTransactionRequest;
use App\Http\Requests\Backend\Transaction\StoreTransactionRequest;

class TransactionController extends Controller
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageTransactionRequest $request)
    {
        return view('backend.transaction.index')->withTransactions($this->transactionRepository->getPaginatedTransaction());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client, Request $request)
    {
        $inventories = Inventory::where('stocks', '!=', 0)->get();

        return view('backend.transaction.create')->withClient($client)->withInventories($inventories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $this->transactionRepository->create($request->only(
            'orders',
            'client'
        ));

        /*return json_encode($this->transactionRepository->create($request->only(
            'orders',
            'client'
        )));*/

        Session::flash('flash_success', 'Transaction was successfully created.');

        return json_encode(route('admin.client.show', $request->client));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view('backend.transaction.show')->withTransaction($transaction);
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
