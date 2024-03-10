<?php

namespace App\EventHandlers\Line\MessageHandlers;

use App\EventHandlers\EventHandler;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Webhook\Model\MessageEvent;

class LocationMessageHandler implements EventHandler
{
    /**
     * @param MessagingApiApi $bot
     * @param MessageEvent $event
     */
    public function __construct(
        private MessagingApiApi $bot,
        private MessageEvent $event
    ) {
    }

    public function handle()
    {
    }
}
