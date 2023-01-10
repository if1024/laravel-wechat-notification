<?php
/**
 * @time:2023/1/9 11:57
 * @Author:if1024 m@mmz.la
 */

namespace If1024\LaravelWechatNotification;

use If1024\LaravelWechatNotification\Messages\OfficialAccountTemplateMessage;
use Overtrue\LaravelWeChat\Facade;

class WechatMessage
{
    public static function officialAccount($name = ''): OfficialAccountTemplateMessage
    {
        return new OfficialAccountTemplateMessage(Facade::officialAccount($name));
    }
}