<?php

namespace App\EventHandlers\Line;

use App\EventHandlers\EventHandler;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Webhook\Model\UnfollowEvent;

class UnfollowEventHandler implements EventHandler
{
    /**
     * @param MessagingApiApi $bot
     * @param UnfollowEvent $event
     */
    public function __construct(
        private MessagingApiApi $bot,
        private UnfollowEvent $event
    ) {
    }

    public function handle()
    {
    }
}
