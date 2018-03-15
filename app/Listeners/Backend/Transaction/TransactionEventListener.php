<?php

namespace App\Listeners\Backend\Transaction;

/**
 * Class TransactionEventListener.
 */
class TransactionEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info($event->user.' Created transaction '. $event->transaction);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Transaction\TransactionCreated::class,
            'App\Listeners\Backend\Transaction\TransactionEventListener@onCreated'
        );
    }
}
