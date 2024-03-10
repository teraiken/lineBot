<?php

namespace App\EventHandlers\Line;

use App\Models\User;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Webhook\Model\FollowEvent;

class FollowEventHandler extends LineBaseEventHandler
{
    /**
     * @param MessagingApiApi $bot
     * @param FollowEvent $event
     */
    public function __construct(
        MessagingApiApi $bot,
        FollowEvent $event
    ) {
        parent::__construct(bot: $bot, event: $event);
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        User::create([
            'line_user_id' => $this->event->getSource()->getUserId(),
        ]);

        $this->replyText($this->event->getReplyToken(), 'Got followed event');
    }
}
