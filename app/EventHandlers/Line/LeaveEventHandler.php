<?php

namespace App\EventHandlers\Line;

use App\EventHandlers\EventHandler;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Webhook\Model\LeaveEvent;

class LeaveEventHandler implements EventHandler
{
    /**
     * @param MessagingApiApi $bot
     * @param LeaveEvent $event
     */
    public function __construct(
        private MessagingApiApi $bot,
        private LeaveEvent $event
    ) {
    }

    public function handle()
    {
    }
}
