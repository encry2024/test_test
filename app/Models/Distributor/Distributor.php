<?php

namespace App\Models\Distributor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Distributor\Traits\Attribute\DistributorAttribute;

class Distributor extends Model
{
    use SoftDeletes, DistributorAttribute;
    //
    protected $fillable = ['name', 'contact_person_first_name', 'contact_person_last_name', 'contact_number', 'email', 'address'];

    protected $dates = ['deleted_at'];

    protected $appends = ['full_name'];
}
