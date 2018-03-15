<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;

use Auth;
use DB;
# Models
use App\Models\Client\Client;
use App\Models\Transaction\Transaction;
use App\Models\ClientTransaction\ClientTransaction;
/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $transactions = Transaction::all();

        return view('frontend.user.dashboard')->withTransactions($transactions);
    }
}
