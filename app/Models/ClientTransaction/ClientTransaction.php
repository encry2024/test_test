<?php

namespace App\Models\ClientTransaction;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory\Inventory;
use App\Models\Transaction\Transaction;

class ClientTransaction extends Model
{
    protected $fillable = [
        'transaction_id', 'inventory_id', 'delivered_stocks', 'total_price'
    ];

    protected $table = 'client_transaction';

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
