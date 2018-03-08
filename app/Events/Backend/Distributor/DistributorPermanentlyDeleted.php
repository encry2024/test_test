<?php

namespace App\Events\Backend\Distributor;

use Illuminate\Queue\SerializesModels;

/**
 * Class DistributorPermanentlyDeleted.
 */
class DistributorPermanentlyDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $distributor;
    public $user;

    /**
     * @param $distributor
     */
    public function __construct($user, $distributor)
    {
        $this->distributor = $distributor;
        $this->user        = $user;
    }
}
