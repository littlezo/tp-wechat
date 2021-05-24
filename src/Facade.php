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
     * @return \EasyWeChat\OfficialAccount\Application
     */
    public static function officialAccount($name = '', $config = [])
    {
        return $name ? app('wechat.official_account.' . $name, ['config' => $config]) : app('wechat.official_account', ['config' => $config]);
    }

    /**
     * @param mixed $name
     * @param mixed $config
     * @return \EasyWeChat\Work\Application
     */
    public static function work($name = '', $config = [])
    {
        return $name ? app('wechat.work.' . $name, ['config' => $config]) : app('wechat.work', ['config' => $config]);
    }

    /**
     * @param mixed $name
     * @param mixed $config
     * @return \EasyWeChat\Payment\Application
     */
    public static function payment($name = '', $config = [])
    {
        return $name ? app('wechat.payment.' . $name, ['config' => $config]) : app('wechat.payment', ['config' => $config]);
    }

    /**
     * @param mixed $name
     * @param mixed $config
     * @return \EasyWeChat\MiniProgram\Application
     */
    public static function miniProgram($name = '', $config = [])
    {
        return $name ? app('wechat.mini_program.' . $name, ['config' => $config]) : app('wechat.mini_program', ['config' => $config]);
    }

    /**
     * @param mixed $name
     * @param mixed $config
     * @return \EasyWeChat\OpenPlatform\Application
     */
    public static function openPlatform($name = '', $config = [])
    {
        return $name ? app('wechat.open_platform.' . $name, ['config' => $config]) : app('wechat.open_platform', ['config' => $config]);
    }

    /**
     * @param mixed $name
     * @param mixed $config
     * @return \EasyWeChat\OpenWork\Application
     */
    public static function openWork($name = '', $config = [])
    {
        return $name ? app('wechat.open_work.' . $name, ['config' => $config]) : app('wechat.open_work', ['config' => $config]);
    }

    /**
     * @param mixed $name
     * @param mixed $config
     * @return \EasyWeChat\MicroMerchant\Application
     */
    public static function microMerchant($name = '', $config = [])
    {
        return $name ? app('wechat.micro_merchant.' . $name, ['config' => $config]) : app('wechat.micro_merchant', ['config' => $config]);
    }
}
