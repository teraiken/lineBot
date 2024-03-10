<?php

namespace App\EventHandlers\Line;

use App\EventHandlers\EventHandler;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Webhook\Model\AccountLinkEvent;

class AccountLinkEventHandler implements EventHandler
{
    /**
     * @param MessagingApiApi $bot
     * @param AccountLinkEvent $event
     */
    public function __construct(
        private MessagingApiApi $bot,
        private AccountLinkEvent $event
    ) {
    }

    public function handle()
    {
    }
}
