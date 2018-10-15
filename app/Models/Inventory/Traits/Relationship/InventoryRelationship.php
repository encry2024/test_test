<?php

namespace App\Models\Inventory\Traits\Relationship;

use App\Models\Distributor\Distributor;
use App\Models\UnitType\UnitType;
use App\Models\Client\Client;
use App\Models\DistributorInventory\DistributorInventory;

/**
 * Trait InventoryRelationship.
 */
trait InventoryRelationship
{
    /**
     * @return mixed
     */
    public function distributors()
    {
        return $this->belongsToMany(Distributor::class)->withPivot('selling_price');
    }

    /**
     * @return mixed
     */
    public function unit_type()
    {
        return $this->belongsTo(UnitType::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function distributor_inventory()
    {
        return $this->hasOne(DistributorInventory::class, 'inventory_id');
    }
}
