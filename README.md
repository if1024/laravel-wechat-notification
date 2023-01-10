<h1 align="center"> laravel-wechat-notification </h1>

Laravel框架下基于 [laravel-wechat](https://github.com/overtrue/laravel-wechat) 使用微信公众号模板消息作为notification通道的composer包。

<p align="center">
<a href="https://packagist.org/packages/if1024/laravel-wechat-notification"><img src="https://poser.pugx.org/if1024/laravel-wechat-notification/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/if1024/laravel-wechat-notification"><img src="https://poser.pugx.org/if1024/laravel-wechat-notification/v/unstable.svg" alt="Latest Unstable Version"></a>
<a href="https://packagist.org/packages/if1024/laravel-wechat-notification"><img src="https://poser.pugx.org/if1024/laravel-wechat-notification/downloads" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/if1024/laravel-wechat-notification"><img src="https://poser.pugx.org/if1024/laravel-wechat-notification/license" alt="License"></a>
</p>

## 安装

```shell
$ composer require if1024/laravel-wechat-notification -vvv
```

## 使用

### 例子

```php
<?php

namespace App\Notifications;

use If1024\LaravelWechatNotification\Messages\OfficialAccountTemplateMessage;
use If1024\LaravelWechatNotification\WechatMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class TestNotify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return ['official_account'];
    }

    public function toOfficialAccount(): OfficialAccountTemplateMessage
    {
        $data = [
            'first'    => 'first',
            'keyword1' => 'keyword1',
            'keyword2' => 'keyword2',
            'keyword3' => 'keyword3',
            'remark'   => 'remark',
        ];

        return WechatMessage::officialAccount()->template('template_id')
                            ->url('https://github.com/')
                            ->data($data);
    }
}

```

### 支持的 WechatMessage 方法

- `to(string $openid)`: 设置模板消息接收人的 openid
- `data(array $data)`: 设置模板消息数据
- `template(string $templateID)`: 设置模板消息的模板 ID
- `miniprogram(string $appid, string $pagepath)`: 设置点击模板消息后跳转的小程序，选填
- `url(string $url)`: 设置点击模板消息后跳转 url，选填

### 在模型里使用`Notifiable` `triat` 来快捷发送消息：

```php
public function routeNotificationForOfficialAccount($notification)
{
    return $this->openid;//返回当前model内的公众号openid字段
}
```

然后这样发送模板消息。可参考官方文档：[消息通知->发送通知](https://learnku.com/docs/laravel/8.x/notifications/9396#fd6d4c)

```php
use App\Notifications\TestNotify;

$user->notify(new TestNotify());
```

批量发送消息

```php
use Illuminate\Support\Facades\Notification;
use App\Notifications\TestNotify;

$users = \App\Models\User::all();
Notification::send($users, new TestNotify());
```

### 说明

1. 如果 `miniprogram` 与 `url`
   同时存在，则优先使用小程序跳转，详情请参考[官方文档](https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Template_Message_Interface.html)
2. `data()`方法接收一个数组，其 `key` 为模板消息中的关键字，`value` 可以为字符串或数组。如果为字符串，则默认颜色为 `#173177`
   ；如果为数组，则第一个参数为显示的数据，第二个参数为字体颜色
   可参考[颜色设置](https://easywechat.com/5.x/official-account/template_message.html#%E5%8F%91%E9%80%81%E4%B8%80%E6%AC%A1%E6%80%A7%E8%AE%A2%E9%98%85%E6%B6%88%E6%81%AF)

## 感谢

感谢 github 上的各位大哥给的参考！感谢超哥的[easywechat](https://github.com/w7corp/easywechat)

## License

MIT