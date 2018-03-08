<?php

namespace App\Events\Backend\Client;

use Illuminate\Queue\SerializesModels;

/**
 * Class ClientUpdated.
 */
class ClientUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $client;
    public $user;

    /**
     * @param $client
     */
    public function __construct($user, $client)
    {
        $this->client = $client;
        $this->user   = $user;
    }
}
