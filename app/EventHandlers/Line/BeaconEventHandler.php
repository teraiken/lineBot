<?php

namespace App\EventHandlers\Line;

use App\EventHandlers\EventHandler;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Webhook\Model\BeaconEvent;

class BeaconEventHandler implements EventHandler
{
    /**
     * @param MessagingApiApi $bot
     * @param BeaconEvent $event
     */
    public function __construct(
        private MessagingApiApi $bot,
        private BeaconEvent $event
    ) {
    }

    public function handle()
    {
    }
}
