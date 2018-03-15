<?php

namespace App\Events\Backend\Transaction;

use Illuminate\Queue\SerializesModels;

/**
 * Class TransactionUpdated.
 */
class TransactionUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $transaction;
    public $user;

    /**
     * @param $transaction
     */
    public function __construct($user, $transaction)
    {
        $this->transaction = $transaction;
        $this->user      = $user;
    }
}
