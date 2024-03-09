<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Clients\MessagingApi\Configuration;

class LineBotServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(MessagingApiApi::class, function () {
            $client = new Client();
            $config = new Configuration();
            $config->setAccessToken(config('line-bot.channel_access_token'));

            return new MessagingApiApi(
                client: $client,
                config: $config,
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
