<?php

namespace App\EventHandlers\Line\MessageHandlers;

use App\EventHandlers\EventHandler;
use Illuminate\Http\Request;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Webhook\Model\MessageEvent;

class TextMessageHandler implements EventHandler
{
    /**
     * @param MessagingApiApi $bot
     * @param Request $request
     * @param MessageEvent $event
     */
    public function __construct(
        private MessagingApiApi $bot,
        private Request $request,
        private MessageEvent $event
    ) {
    }

    public function handle()
    {
    }
}
