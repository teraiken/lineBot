<?php

namespace App\EventHandlers\Line;

use App\EventHandlers\EventHandler;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Webhook\Model\PostbackEvent;

class PostbackEventHandler implements EventHandler
{
    /**
     * @param MessagingApiApi $bot
     * @param PostbackEvent $event
     */
    public function __construct(
        private MessagingApiApi $bot,
        private PostbackEvent $event
    ) {
    }

    public function handle()
    {
    }
}
