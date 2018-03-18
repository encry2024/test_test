<?php

namespace App\Models\DistributorInventory\Traits\Relationship;

use App\Models\Inventory\Inventory;
use App\Models\Distributor\Distributor;

/**
 * Trait DistributorInventoryRelationship.
 */
trait DistributorInventoryRelationship
{
    /**
     * @return mixed
     */
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function clients()
    {
        return $this->belongsTo(Distributor::class);
    }
}
