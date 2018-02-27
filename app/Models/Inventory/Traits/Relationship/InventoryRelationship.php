<?php

namespace App\Models\Inventory\Traits\Relationship;

use App\Models\Distributor\Distributor;
use App\Models\UnitType\UnitType;

/**
 * Trait InventoryRelationship.
 */
trait InventoryRelationship
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
    public function unit_type()
    {
        return $this->belongsTo(UnitType::class);
    }
}
