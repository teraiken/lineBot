<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use LINE\Clients\MessagingApi\Api\MessagingApiApi;
use LINE\Clients\MessagingApi\Api\MessagingApiBlobApi;
use LINE\Clients\MessagingApi\Configuration;

class LineBotServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $client = new Client();
        $config = new Configuration();
        $config->setAccessToken(config('line-bot.channel_access_token'));

        $this->app->singleton(MessagingApiApi::class, function () use ($client, $config) {
            return new MessagingApiApi(
                client: $client,
                config: $config,
            );
        });

        $this->app->singleton(MessagingApiBlobApi::class, function () use ($client, $config) {
            return new MessagingApiBlobApi(
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
