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

use Psr\SimpleCache\CacheInterface;
use think\Cache;

class CacheBridge implements CacheInterface
{
    protected $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function get($key, $default = null)
    {
        return $this->cache->get($key, $default);
    }

    public function set($key, $value, $ttl = null)
    {
        return $this->cache->set($key, $value, $ttl);
    }

    public function delete($key)
    {
        return $this->cache->rm($key);
    }

    public function clear()
    {
        return $this->cache->clear();
    }

    public function getMultiple($keys, $default = null)
    {
    }

    public function setMultiple($values, $ttl = null)
    {
    }

    public function deleteMultiple($keys)
    {
    }

    public function has($key)
    {
        return $this->cache->has($key);
    }
}
