<?php

namespace App\EventHandlers\Line;

use App\EventHandlers\EventHandler;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Webhook\Model\JoinEvent;

class JoinEventHandler implements EventHandler
{
    /**
     * @param MessagingApiApi $bot
     * @param JoinEvent $event
     */
    public function __construct(
        private MessagingApiApi $bot,
        private JoinEvent $event
    ) {
    }

    public function handle()
    {
    }
}
