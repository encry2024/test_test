<?php

namespace App\Events\Backend\Inventory;

use Illuminate\Queue\SerializesModels;

/**
 * Class InventoryRestocked.
 */
class InventoryRestocked
{
    use SerializesModels;

    /**
     * @var
     */
    public $inventory;
    public $stocks;
    public $user;

    /**
     * @param $inventory
     */
    public function __construct($user, $stocks, $inventory)
    {
        $this->inventory = $inventory;
        $this->user      = $user;
        $this->stocks    = $stocks;
    }
}
