<?php

namespace App\Listeners\Backend\UnitType;

/**
 * Class UnitTypeEventListener.
 */
class UnitTypeEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info($event->user .' Created Unit Type '. $event->unit_type);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info($event->user .' Updated Unit Type '. $event->unit_type);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info($event->user .' Deleted Unit Type '. $event->unit_type);
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        \Log::info($event->user .' Permanently Deleted Unit Type '. $event->unit_type);
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        \Log::info($event->user .' Restored Unit Type '. $event->unit_type);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Inventory\UnitType\UnitTypeCreated::class,
            'App\Listeners\Backend\UnitType\UnitTypeEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Inventory\UnitType\UnitTypeUpdated::class,
            'App\Listeners\Backend\UnitType\UnitTypeEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Inventory\UnitType\UnitTypeDeleted::class,
            'App\Listeners\Backend\UnitType\UnitTypeEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Backend\Inventory\UnitType\UnitTypePermanentlyDeleted::class,
            'App\Listeners\Backend\UnitType\UnitTypeEventListener@onPermanentlyDeleted'
        );

        $events->listen(
            \App\Events\Backend\Inventory\UnitType\UnitTypeRestored::class,
            'App\Listeners\Backend\UnitType\UnitTypeEventListener@onRestored'
        );
    }
}
