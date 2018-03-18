<?php

namespace App\Listeners\Backend\Distributor;

/**
 * Class DistributorEventListener.
 */
class DistributorEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info($event->user.' Created Distributor '. $event->distributor);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info($event->user.' Updated Distributor '. $event->distributor);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info($event->user.' Deleted Distributor '. $event->distributor);
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        \Log::info($event->user.' Permanently Deleted Distributor '. $event->distributor);
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        \Log::info($event->user.' Restored Distributor '. $event->distributor);
    }

    /**
     * @param $event
     */
    public function onCreatedInventory($event)
    {
        \Log::info($event->user.' Stored '. $event->total_added_item .' Item(s) to Distributor '. $event->distributor);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Distributor\DistributorCreated::class,
            'App\Listeners\Backend\Distributor\DistributorEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Distributor\DistributorUpdated::class,
            'App\Listeners\Backend\Distributor\DistributorEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Distributor\DistributorDeleted::class,
            'App\Listeners\Backend\Distributor\DistributorEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Backend\Distributor\DistributorPermanentlyDeleted::class,
            'App\Listeners\Backend\Distributor\DistributorEventListener@onPermanentlyDeleted'
        );

        $events->listen(
            \App\Events\Backend\Distributor\DistributorRestored::class,
            'App\Listeners\Backend\Distributor\DistributorEventListener@onRestored'
        );

        $events->listen(
            \App\Events\Backend\Distributor\DistributorCreatedInventory::class,
            'App\Listeners\Backend\Distributor\DistributorEventListener@onCreatedInventory'
        );
    }
}
