<?php

namespace App\EventHandlers\Line;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Webhook\Model\UnfollowEvent;

class UnfollowEventHandler extends LineBaseEventHandler
{
    /**
     * @param MessagingApiApi $bot
     * @param UnfollowEvent $event
     */
    public function __construct(
        MessagingApiApi $bot,
        UnfollowEvent $event
    ) {
        parent::__construct(bot: $bot, event: $event);
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $userId = $this->event->getSource()->getUserId();

        User::lineUserId($userId)->delete();

        Log::info(sprintf(
            'Unfollowed this bot %s %s',
            $this->event->getType(),
            $userId
        ));
    }
}
