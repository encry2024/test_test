<?php

namespace App\Models\Transaction\Traits\Relationship;

use App\Models\Inventory\Inventory;
use App\Models\Client\Client;
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

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
