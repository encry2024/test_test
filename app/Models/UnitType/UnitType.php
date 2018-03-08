<?php

namespace App\Models\UnitType;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UnitType\Traits\Relationship\UnitTypeRelationship;
use App\Models\UnitType\Traits\Attribute\UnitTypeAttribute;

class UnitType extends Model
{
    use SoftDeletes,
        UnitTypeAttribute,
        UnitTypeRelationship;

    protected $fillable = ['name', 'description'];
}
