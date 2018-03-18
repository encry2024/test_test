<?php

namespace App\Models\Distributor\Traits\Relationship;

use App\Models\Inventory\Inventory;

/**
 * Trait DistributorRelationship.
 */
trait DistributorRelationship
{
    public function inventories()
    {
        return $this->belongsToMany(Inventory::class);
    }
}
