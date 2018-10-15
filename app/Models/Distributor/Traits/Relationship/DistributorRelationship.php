<?php

namespace App\Models\Distributor\Traits\Relationship;

use App\Models\Inventory\Inventory;
use App\Models\DistributorInventory\DistributorInventory;

/**
 * Trait DistributorRelationship.
 */
trait DistributorRelationship
{
    public function inventories()
    {
        return $this->belongsToMany(Inventory::class);
    }

    public function distributor_inventory()
    {
        return $this->hasMany(DistributorInventory::class);
    }
}
