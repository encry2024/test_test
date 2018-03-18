<?php

namespace App\Events\Backend\Distributor;

use Illuminate\Queue\SerializesModels;

/**
 * Class DistributorCreatedInventory.
 */
class DistributorCreatedInventory
{
    use SerializesModels;

    /**
     * @var
     */
    public $distributor;
    public $total_added_item;
    public $user;

    /**
     * @param $distributor
     */
    public function __construct($user, $total_added_item, $distributor)
    {
        $this->distributor      = $distributor;
        $this->total_added_item = $total_added_item;
        $this->user             = $user;
    }
}
