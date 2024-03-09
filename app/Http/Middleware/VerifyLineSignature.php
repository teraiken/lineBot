<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use LINE\Constants\HTTPHeader;
use Symfony\Component\HttpFoundation\Response;

class VerifyLineSignature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $channelSecret = config('line-bot.channel_secret');
        $httpRequestBody = $request->getContent();
        $hash = hash_hmac('sha256', $httpRequestBody, $channelSecret, true);
        $signature = base64_encode($hash);

        $headerSignature = $request->header(HTTPHeader::LINE_SIGNATURE);
        if (empty($headerSignature)) {
            return response()->json([], Response::HTTP_BAD_REQUEST);
        }

        if ($headerSignature !== $signature) {
            return response()->json([], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
