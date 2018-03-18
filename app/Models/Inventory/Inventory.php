<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory\Traits\Attribute\InventoryAttribute;
use App\Models\Inventory\Traits\Relationship\InventoryRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    // Traits
    use SoftDeletes,
        InventoryAttribute,
        InventoryRelationship;

    protected $fillable = [
        'name',
        'distributor_id',
        'unit_type_id',
        'stocks',
        'critical_stocks_level',
        'price_per_unit'
    ];

    protected $dates = ['deleted_at'];
}
