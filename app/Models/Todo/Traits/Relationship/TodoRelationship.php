<?php

namespace App\Models\Todo\Traits\Relationship;

use App\Models\Auth\User;

/**
 * Trait TodoRelationship.
 */
trait TodoRelationship
{
    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
