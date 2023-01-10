<?php
/**
 * @time:2023/1/9 11:58
 * @Author:if1024 m@mmz.la
 */

namespace If1024\LaravelWechatNotification\Messages;

class OfficialAccountTemplateMessage extends WechatTemplateMessage
{
    public function miniprogram($appId, $pagePath): static
    {
        $this->message['miniprogram'] = [
            'appid'    => $appId,
            'pagepath' => $pagePath
        ];

        return $this;
    }
}