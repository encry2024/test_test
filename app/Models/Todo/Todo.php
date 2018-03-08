<?php

namespace App\Models\Todo;

use Illuminate\Database\Eloquent\Model;
use App\Models\Todo\Traits\Relationship\TodoRelationship;

class Todo extends Model
{
    use TodoRelationship;
    //
    protected $fillable = ['user_id', 'title', 'description', 'priority_level', 'status'];
}
