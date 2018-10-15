<?php

namespace App\Models\DistributorInventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\DistributorInventory\Traits\Relationship\DistributorInventoryRelationship;

class DistributorInventory extends Model
{
    use DistributorInventoryRelationship,
        SoftDeletes;

    protected $table = 'distributor_inventory';

    protected $fillable = [
        'distributor_id',
        'inventory_id'
    ];
}
