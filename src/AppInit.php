<?php

declare(strict_types=1);
/**
 * @version 1.0.0
 * @author @小小只^v^ <littlezov@qq.com>  littlezov@qq.com
 * @contact  littlezov@qq.com
 * @link     https://github.com/littlezo
 * @document https://github.com/littlezo/wiki
 * @license  https://github.com/littlezo/MozillaPublicLicense/blob/main/LICENSE
 *
 */
namespace littler\WeChat;

use EasyWeChat\MicroMerchant\Application as MicroMerchant;
use EasyWeChat\MiniProgram\Application as MiniProgram;
use EasyWeChat\OfficialAccount\Application as OfficialAccount;
use EasyWeChat\OpenPlatform\Application as OpenPlatform;
use EasyWeChat\OpenWork\Application as OpenWork;
use EasyWeChat\Payment\Application as Payment;
use EasyWeChat\Work\Application as Work;

class AppInit
{
    protected $apps = [
        'official_account' => OfficialAccount::class,
        'work' => Work::class,
        'mini_program' => MiniProgram::class,
        'payment' => Payment::class,
        'open_platform' => OpenPlatform::class,
        'open_work' => OpenWork::class,
        'micro_merchant' => MicroMerchant::class,
    ];

    public function register()
    {
        $default = config('wechat.default') ? config('wechat.default') : [];
        foreach ($this->apps as $name => $app) {
            if (! config('wechat.' . $name)) {
                continue;
            }
            $configs = config('wechat.' . $name);
            foreach ($configs as $config_name => $module_default) {
                bind('wechat.' . $name . '.' . $config_name, function ($config = []) use ($app, $module_default, $default) {
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
                bind('wechat.' . $name, 'wechat.' . $name . '.default');
            }
        }
    }
}
