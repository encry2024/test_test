<?php

namespace App\Listeners\Backend\Client;

/**
 * Class ClientEventListener.
 */
class ClientEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info($event->user.' Created Client '. $event->client);
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info($event->user.' Updated Client '. $event->client);
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info($event->user.' Deleted Client '. $event->client);
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        \Log::info($event->user.' Permanently Deleted Client '. $event->client);
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        \Log::info($event->user.' Restored Client '. $event->client);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\Client\ClientCreated::class,
            'App\Listeners\Backend\Client\ClientEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Client\ClientUpdated::class,
            'App\Listeners\Backend\Client\ClientEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Client\ClientDeleted::class,
            'App\Listeners\Backend\Client\ClientEventListener@onDeleted'
        );

        $events->listen(
            \App\Events\Backend\Client\ClientPermanentlyDeleted::class,
            'App\Listeners\Backend\Client\ClientEventListener@onPermanentlyDeleted'
        );

        $events->listen(
            \App\Events\Backend\Client\ClientRestored::class,
            'App\Listeners\Backend\Client\ClientEventListener@onRestored'
        );
    }
}
