<?php

namespace App\EventHandlers\Line;

use App\EventHandlers\EventHandler;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Webhook\Model\ThingsEvent;

class ThingsEventHandler implements EventHandler
{
    /**
     * @param MessagingApiApi $bot
     * @param ThingsEvent $event
     */
    public function __construct(
        private MessagingApiApi $bot,
        private ThingsEvent $event
    ) {
    }

    public function handle()
    {
    }
}
