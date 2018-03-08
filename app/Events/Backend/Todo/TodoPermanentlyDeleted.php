<?php

namespace App\Events\Backend\Todo;

use Illuminate\Queue\SerializesModels;

/**
 * Class TodoPermanentlyDeleted.
 */
class TodoPermanentlyDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $todo;
    public $user;

    /**
     * @param $todo
     */
    public function __construct($user, $todo)
    {
        $this->todo = $todo;
        $this->user = $user;
    }
}
