<?php

namespace App\EventHandlers\Line\MessageHandlers;

use App\EventHandlers\EventHandler;
use Illuminate\Http\Request;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Clients\MessagingApi\Api\MessagingApiBlobApi;
use LINE\Webhook\Model\MessageEvent;

class ImageMessageHandler implements EventHandler
{
    /**
     * @param MessagingApiApi $bot
     * @param MessagingApiBlobApi $botBlob
     * @param Request $request
     * @param MessageEvent $event
     */
    public function __construct(
        private MessagingApiApi $bot,
        private MessagingApiBlobApi $botBlob,
        private Request $request,
        private MessageEvent $event
    ) {
    }

    public function handle()
    {
    }
}
