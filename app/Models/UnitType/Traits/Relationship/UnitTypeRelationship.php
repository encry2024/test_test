<?php

namespace App\Models\UnitType\Traits\Relationship;

use App\Models\Inventory\Inventory;

/**
 * Trait UnitTypeRelationship.
 */
trait UnitTypeRelationship
{
    /**
     * @return mixed
     */
    public function distributor()
    {
        return $this->belongsTo(Distributor::class);
    }

    /**
     * @return mixed
     */
    public function inventories()
    {
        return $this->belongsToMany(Inventory::class);
    }
}
