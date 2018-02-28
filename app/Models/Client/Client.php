<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Client\Traits\Attribute\ClientAttribute;
// use App\Models\Client\Traits\Relationship\ClientRelationship;

class Client extends Model
{
    use SoftDeletes,
        ClientAttribute;
        // ClientRelationship;

    protected $fillable = [
        'name',
        'contact_person_first_name',
        'contact_person_last_name',
        'contact_person_email',
        'contact_person_contact_number',
        'address'
    ];

    protected $dates = ['deleted_at'];

}
