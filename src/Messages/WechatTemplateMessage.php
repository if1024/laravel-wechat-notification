<?php
/**
 * @time:2023/1/9 11:42
 * @Author:if1024 m@mmz.la
 */

namespace If1024\LaravelWechatNotification\Messages;

use EasyWeChat\OfficialAccount\Application;

class WechatTemplateMessage
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var array
     */
    protected $message;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function send()
    {
        return $this->app->template_message->send($this->message);
    }

    public function to($openid)
    {
        $this->message['touser'] = $openid;

        return $this;
    }

    public function url($url)
    {
        $this->message['url'] = $url;

        return $this;
    }

    public function template($templateId)
    {
        $this->message['template_id'] = $templateId;

        return $this;
    }

    public function data(array $data)
    {
        $this->message['data'] = $data;

        return $this;
    }
}