<?php

namespace App\Events\Backend\Inventory\UnitType;

use Illuminate\Queue\SerializesModels;

/**
 * Class UnitTypePermanentlyDeleted.
 */
class UnitTypePermanentlyDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $unit_type;
    public $user;

    /**
     * @param $unit_type
     */
    public function __construct($user, $unit_type)
    {
        $this->unit_type = $unit_type;
        $this->user = $user;
    }
}
