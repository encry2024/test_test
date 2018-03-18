<?php

namespace App\Models\Transaction\Traits\Relationship;

use App\Models\Inventory\Inventory;
use App\Models\Client\Client;
use App\Models\ClientTransaction\ClientTransaction;
use App\Models\Auth\User;

/**
 * Trait TransactionRelationship.
 */
trait TransactionRelationship
{
    /**
     * @return mixed
     */
    public function inventories()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function accounted_client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client_transactions()
    {
        return $this->hasMany(ClientTransaction::class);
    }
}
