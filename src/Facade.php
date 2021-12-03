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

/**
 * Class Facade.
 */
class Facade extends \think\Facade
{
    /**
     * 默认为 Server.
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'wechat.official_account';
    }

    /**
     * @param mixed $name
     * @param mixed $config
     *
     * @return \EasyWeChat\OfficialAccount\Application
     */
    public static function officialAccount($name = '', $config = [])
    {
        return $name ? app('wechat.official_account.'.$name, ['config' => $config]) : app('wechat.official_account', ['config' => $config]);
    }

    /**
     * @param mixed $name
     * @param mixed $config
     *
     * @return \EasyWeChat\Work\Application
     */
    public static function work($name = '', $config = [])
    {
        return $name ? app('wechat.work.'.$name, ['config' => $config]) : app('wechat.work', ['config' => $config]);
    }

    /**
     * @param mixed $name
     * @param mixed $config
     *
     * @return \EasyWeChat\Pay\Application
     */
    public static function pay($name = '', $config = [])
    {
        return $name ? app('wechat.payment.'.$name, ['config' => $config]) : app('wechat.payment', ['config' => $config]);
    }

    /**
     * @param mixed $name
     * @param mixed $config
     *
     * @return \EasyWeChat\MiniApp\Application
     */
    public static function miniApp($name = '', $config = [])
    {
        return $name ? app('wechat.mini_app.'.$name, ['config' => $config]) : app('wechat.mini_app', ['config' => $config]);
    }

    /**
     * @param mixed $name
     * @param mixed $config
     *
     * @return \EasyWeChat\OpenPlatform\Application
     */
    public static function openPlatform($name = '', $config = [])
    {
        return $name ? app('wechat.open_platform.'.$name, ['config' => $config]) : app('wechat.open_platform', ['config' => $config]);
    }

    /**
     * @param mixed $name
     * @param mixed $config
     *
     * @return \EasyWeChat\OpenWork\Application
     */
    public static function openWork($name = '', $config = [])
    {
        return $name ? app('wechat.open_work.'.$name, ['config' => $config]) : app('wechat.open_work', ['config' => $config]);
    }
}
