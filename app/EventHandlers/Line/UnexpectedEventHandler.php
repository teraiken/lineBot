<?php

namespace App\EventHandlers\Line;

use App\EventHandlers\EventHandler;
use Illuminate\Support\Facades\Log;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Webhook\Model\Event;
use LINE\Webhook\Model\MessageEvent;

class UnexpectedEventHandler implements EventHandler
{
    /**
     * @param MessagingApiApi $bot
     * @param Event $event
     */
    public function __construct(
        private MessagingApiApi $bot,
        private Event $event
    ) {
    }

    public function handle()
    {
        if ($this->event instanceof MessageEvent) {
            $message = 'Unexpected message type has come, something wrong [class name: %s]';
        } else {
            $message = 'Unexpected event type has come, something wrong [class name: %s]';
        }

        Log::info(sprintf(
            $message,
            get_class($this->event)
        ));
    }
}
