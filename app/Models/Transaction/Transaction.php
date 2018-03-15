<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\Traits\Relationship\TransactionRelationship;

class Transaction extends Model
{
    //
    use TransactionRelationship;

    protected $fillable = ['user_id', 'client_id', 'reference_id', 'status'];
}
