<?php

namespace App\Listeners\Backend\Todo;

/**
 * Class TodoEventListener.
 */
class TodoEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info($event->user.' Created To Do '. $event->todo);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info($event->user. ' Updated To Do '. $event->todo);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info($event->user. ' Deleted To Do '. $event->todo);
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        \Log::info($event->user. ' Permanently Deleted To Do '. $event->todo);
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        \Log::info($event->user. ' Restored To Do '. $event->todo);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Todo\TodoCreated::class,
            'App\Listeners\Backend\Todo\TodoEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Todo\TodoUpdated::class,
            'App\Listeners\Backend\Todo\TodoEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Todo\TodoDeleted::class,
            'App\Listeners\Backend\Todo\TodoEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Backend\Todo\TodoPermanentlyDeleted::class,
            'App\Listeners\Backend\Todo\TodoEventListener@onPermanentlyDeleted'
        );

        $events->listen(
            \App\Events\Backend\Todo\TodoRestored::class,
            'App\Listeners\Backend\Todo\TodoEventListener@onRestored'
        );
    }
}
