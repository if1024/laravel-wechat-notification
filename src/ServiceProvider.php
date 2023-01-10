<?php
/**
 * @time:2023/1/9 11:39
 * @Author:if1024 m@mmz.la
 */

namespace If1024\LaravelWechatNotification;

use If1024\LaravelWechatNotification\Channels\WechatTemplateChannel;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $channels = [
            'official_account',
        ];

        foreach ($channels as $channel) {
            Notification::extend($channel, function ($app) use ($channel) {
                return new WechatTemplateChannel($channel);
            });
        }
    }
}