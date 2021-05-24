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

use littler\WeChat\Command\Config;
use think\facade\Route;

class Service extends \think\Service
{
    public function boot()
    {
        $this->commands([
            Config::class,
        ]);
    }

    /**
     * littlest
     * register.
     */
    public function register()
    {
        $this->app->register(AppInit::class);
        $this->app->bind('wechat.facade', Facade::class);
        $this->registerOAuthRoutes();
    }

    protected function registerOAuthRoutes(): void
    {
        Route::rule('oauth/wechat', '')->middleware('oauth');
    }
}
