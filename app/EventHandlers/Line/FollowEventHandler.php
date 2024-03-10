<?php

namespace App\EventHandlers\Line;

use App\EventHandlers\EventHandler;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Webhook\Model\FollowEvent;

class FollowEventHandler implements EventHandler
{
    /**
     * @param MessagingApiApi $bot
     * @param FollowEvent $event
     */
    public function __construct(
        private MessagingApiApi $bot,
        private FollowEvent $event
    ) {
    }

    public function handle()
    {
    }
}
