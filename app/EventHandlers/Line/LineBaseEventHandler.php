<?php

namespace App\EventHandlers\Line;

use App\EventHandlers\EventHandler;
use Illuminate\Support\Facades\Log;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Clients\MessagingApi\ApiException;
use LINE\Clients\MessagingApi\Model\Message;
use LINE\Clients\MessagingApi\Model\ReplyMessageRequest;
use LINE\Clients\MessagingApi\Model\TextMessage;
use LINE\Constants\MessageType;
use LINE\Webhook\Model\Event;

abstract class LineBaseEventHandler implements EventHandler
{
    /**
     * @param MessagingApiApi $bot
     * @param Event $event
     */
    protected function __construct(
        protected MessagingApiApi $bot,
        protected Event $event
    ) {
    }

    /**
     * @param string $replyToken
     * @param string $text
     * @return void
     */
    protected function replyText(string $replyToken, string $text): void
    {
        $textMessage = (new TextMessage(['text' => $text, 'type' => MessageType::TEXT]));

        return $this->replyMessage($replyToken, $textMessage);
    }

    /**
     * @param string $replyToken
     * @param Message $message
     * @return void
     */
    protected function replyMessage(string $replyToken, Message $message): void
    {
        $request = new ReplyMessageRequest([
            'replyToken' => $replyToken,
            'messages' => [$message],
        ]);

        try {
            $this->bot->replyMessage($request);
        } catch (ApiException $e) {
            Log::error('BODY:' . $e->getResponseBody());
            throw $e;
        }
    }
}
