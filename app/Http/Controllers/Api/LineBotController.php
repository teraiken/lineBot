<?php

namespace App\Http\Controllers\Api;

use App\EventHandlers\EventHandler;
use App\EventHandlers\Line\AccountLinkEventHandler;
use App\EventHandlers\Line\BeaconEventHandler;
use App\EventHandlers\Line\FollowEventHandler;
use App\EventHandlers\Line\JoinEventHandler;
use App\EventHandlers\Line\LeaveEventHandler;
use App\EventHandlers\Line\MessageHandlers\AudioMessageHandler;
use App\EventHandlers\Line\MessageHandlers\ImageMessageHandler;
use App\EventHandlers\Line\MessageHandlers\LocationMessageHandler;
use App\EventHandlers\Line\MessageHandlers\StickerMessageHandler;
use App\EventHandlers\Line\MessageHandlers\TextMessageHandler;
use App\EventHandlers\Line\MessageHandlers\VideoMessageHandler;
use App\EventHandlers\Line\PostbackEventHandler;
use App\EventHandlers\Line\ThingsEventHandler;
use App\EventHandlers\Line\UnexpectedEventHandler;
use App\EventHandlers\Line\UnfollowEventHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LINE\Webhook\Model\MessageEvent;
use LINE\Webhook\Model\TextMessageContent;
use LINE\Parser\EventRequestParser;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Clients\MessagingApi\Api\MessagingApiBlobApi;
use LINE\Constants\HTTPHeader;
use LINE\Parser\Exception\InvalidEventRequestException;
use LINE\Parser\Exception\InvalidSignatureException;
use LINE\Webhook\Model\AccountLinkEvent;
use LINE\Webhook\Model\AudioMessageContent;
use LINE\Webhook\Model\BeaconEvent;
use LINE\Webhook\Model\Event;
use LINE\Webhook\Model\FollowEvent;
use LINE\Webhook\Model\ImageMessageContent;
use LINE\Webhook\Model\JoinEvent;
use LINE\Webhook\Model\LeaveEvent;
use LINE\Webhook\Model\LocationMessageContent;
use LINE\Webhook\Model\PostbackEvent;
use LINE\Webhook\Model\StickerMessageContent;
use LINE\Webhook\Model\ThingsEvent;
use LINE\Webhook\Model\UnfollowEvent;
use LINE\Webhook\Model\VideoMessageContent;
use Symfony\Component\HttpFoundation\Response;

class LineBotController extends Controller
{
    /**
     * @param Request $request
     * @param MessagingApiApi $bot
     * @param MessagingApiBlobApi $botBlob
     * @return JsonResponse
     */
    public function __invoke(
        Request $request,
        MessagingApiApi $bot,
        MessagingApiBlobApi $botBlob
    ): JsonResponse {
        try {
            $parsedEvents = EventRequestParser::parseEventRequest(
                $request->getContent(),
                config('line-bot.channel_secret'),
                $request->header(HTTPHeader::LINE_SIGNATURE)
            );
        } catch (InvalidSignatureException | InvalidEventRequestException $e) {
            return response()->json([], Response::HTTP_BAD_REQUEST);
        }

        foreach ($parsedEvents->getEvents() as $event) {
            $handler = $this->getEventHandler($bot, $botBlob, $request, $event);

            $handler->handle();
        }

        return response()->json();
    }

    /**
     * @param MessagingApiApi $bot
     * @param MessagingApiBlobApi $botBlob
     * @param Request $request
     * @param Event $event
     * @return EventHandler
     */
    private function getEventHandler(
        MessagingApiApi $bot,
        MessagingApiBlobApi $botBlob,
        Request $request,
        Event $event
    ): EventHandler {
        if ($event instanceof MessageEvent) {
            $message = $event->getMessage();

            if ($message instanceof TextMessageContent) {
                return new TextMessageHandler($bot, $request, $event);
            } elseif ($message instanceof StickerMessageContent) {
                return new StickerMessageHandler($bot, $event);
            } elseif ($message instanceof LocationMessageContent) {
                return new LocationMessageHandler($bot, $event);
            } elseif ($message instanceof ImageMessageContent) {
                return new ImageMessageHandler($bot, $botBlob, $request, $event);
            } elseif ($message instanceof AudioMessageContent) {
                return new AudioMessageHandler($bot, $botBlob, $request, $event);
            } elseif ($message instanceof VideoMessageContent) {
                return new VideoMessageHandler($bot, $botBlob, $request, $event);
            } else {
                return new UnexpectedEventHandler($bot, $event);
            }
        } elseif ($event instanceof UnfollowEvent) {
            return new UnfollowEventHandler($bot, $event);
        } elseif ($event instanceof FollowEvent) {
            return new FollowEventHandler($bot, $event);
        } elseif ($event instanceof JoinEvent) {
            return new JoinEventHandler($bot, $event);
        } elseif ($event instanceof LeaveEvent) {
            return new LeaveEventHandler($bot, $event);
        } elseif ($event instanceof PostbackEvent) {
            return new PostbackEventHandler($bot, $event);
        } elseif ($event instanceof BeaconEvent) {
            return new BeaconEventHandler($bot, $event);
        } elseif ($event instanceof AccountLinkEvent) {
            return new AccountLinkEventHandler($bot, $event);
        } elseif ($event instanceof ThingsEvent) {
            return new ThingsEventHandler($bot, $event);
        } else {
            return new UnexpectedEventHandler($bot, $event);
        }
    }
}
