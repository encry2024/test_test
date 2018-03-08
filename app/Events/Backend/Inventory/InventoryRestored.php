<?php

namespace App\Events\Backend\Inventory;

use Illuminate\Queue\SerializesModels;

/**
 * Class InventoryRestored.
 */
class InventoryRestored
{
    use SerializesModels;

    /**
     * @var
     */
    public $inventory;
    public $user;

    /**
     * @param $inventory
     */
    public function __construct($user, $inventory)
    {
        $this->inventory = $inventory;
        $this->user      = $user;
    }
}
