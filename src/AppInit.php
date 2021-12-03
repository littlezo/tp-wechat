<?php

declare(strict_types=1);
/**
 * #logic 做事不讲究逻辑，再努力也只是重复犯错
 * ## 何为相思：不删不聊不打扰，可否具体点：曾爱过。何为遗憾：你来我往皆过客，可否具体点：再无你。.
 *
 * @version 1.0.0
 *
 * @author @小小只^v^ <littlezov@qq.com>  littlezov@qq.com
 * @contact  littlezov@qq.com
 *
 * @see     https://github.com/littlezo
 * @document https://github.com/littlezo/wiki
 *
 * @license  https://github.com/littlezo/MozillaPublicLicense/blob/main/LICENSE
 */

namespace littler\WeChat;

use EasyWeChat\MiniApp\Application as MiniApp;
use EasyWeChat\OfficialAccount\Application as OfficialAccount;
use EasyWeChat\OpenPlatform\Application as OpenPlatform;
use EasyWeChat\OpenWork\Application as OpenWork;
use EasyWeChat\Pay\Application as Pay;
use EasyWeChat\Work\Application as Work;

class AppInit
{
    protected $apps = [
        'mini_app' => MiniApp::class,
        'official_account' => OfficialAccount::class,
        'open_platform' => OpenPlatform::class,
        'open_work' => OpenWork::class,
        'pay' => Pay::class,
        'work' => Work::class,
    ];

    public function register()
    {
        $default = config('wechat.default') ? config('wechat.default') : [];
        foreach ($this->apps as $name => $app) {
            if (!config('wechat.'.$name)) {
                continue;
            }
            $configs = config('wechat.'.$name);
            foreach ($configs as $config_name => $module_default) {
                bind('wechat.'.$name.'.'.$config_name, function ($config = []) use ($app, $module_default, $default) {
                    //合并配置文件
                    $account_config = array_merge($module_default, $default, $config);
                    $account_app = app($app, ['config' => $account_config]);
                    if (config('wechat.default.use_tp_cache')) {
                        $account_app['cache'] = app(CacheBridge::class);
                    }

                    return $account_app;
                });
            }
            if (isset($configs['default'])) {
                bind('wechat.'.$name, 'wechat.'.$name.'.default');
            }
        }
    }
}
