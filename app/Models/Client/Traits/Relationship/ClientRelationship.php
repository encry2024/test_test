<?php

namespace App\Models\Client\Traits\Relationship;

use App\Models\Distributor\Distributor;
use App\Models\Inventory\Inventory;
use App\Models\Transaction\Transaction;

/**
 * Trait ClientRelationship.
 */
trait ClientRelationship
{

    /**
     * @return mixed
     */
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
