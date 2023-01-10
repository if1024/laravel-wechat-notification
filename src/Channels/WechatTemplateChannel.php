<?php
/**
 * @time:2023/1/9 11:41
 * @Author:if1024 m@mmz.la
 */

namespace If1024\LaravelWechatNotification\Channels;

use If1024\LaravelWechatNotification\Messages\WechatTemplateMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class WechatTemplateChannel
{
    protected $channel;

    public function __construct($channel)
    {
        $this->channel = $channel;
    }

    public function send($notifiable, Notification $notification)
    {
        /**
         * @var WechatTemplateMessage $message
         */
        $message = $notification->{'to'.Str::studly($this->channel)}($notifiable);
        $message->to($notifiable->routeNotificationFor($this->channel, $notification));

        return $message->send();
    }
}