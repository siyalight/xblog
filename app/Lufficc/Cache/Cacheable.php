<?php
namespace Lufficc\Cache;

/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/10/6
 * Time: 16:58
 */
use Closure;

trait Cacheable
{
    /**
     * @return int  in minutes
     */
    public function cacheTime()
    {
        return 60;
    }

    public abstract function tag();

    public function remember($key, Closure $entity, $tag = null)
    {
        return cache()->tags($tag == null ? $this->tag() : $tag)->remember($key, $this->cacheTime(), $entity);
    }

    public function get($key)
    {
        return cache()->tags($this->tag())->get($key);
    }

    public function put($key, $value)
    {
        return cache()->tags($this->tag())->put($key, $value, $this->cacheTime());
    }

    public function has($key)
    {
        return cache()->tags($this->tag())->has($key);
    }

    /*
     * clear cache
     */
    public function forget($key, $tag = null)
    {
        cache()->tags($tag == null ? $this->tag() : $tag)->forget($key);
    }

    /**
     * clear all cache whit tag post
     * @param null $tag
     */
    public function clearCache($tag = null)
    {
        cache()->tags($tag == null ? $this->tag() : $tag)->flush();
    }

    public function clearAllCache()
    {
        cache()->flush();
    }
}