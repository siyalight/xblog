<?php
namespace Lufficc\Cache;

/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/10/6
 * Time: 16:58
 */
use App\Contracts\XblogCache;
use Closure;

class Cacheable implements XblogCache
{
    /**
     * @return int  in minutes
     */
    public function cacheTime()
    {
        return 60;
    }

    public $tag;

    public function setTag($tag)
    {
        $this->tag = $tag;
    }


    public function remember($key, Closure $entity, $tag = null)
    {
        return cache()->tags($tag == null ? $this->tag : $tag)->remember($key, $this->cacheTime(), $entity);
    }

    /*
     * clear cache
     */
    public function forget($key, $tag = null)
    {
        cache()->tags($tag == null ? $this->tag : $tag)->forget($key);
    }

    /**
     * clear all cache whit tag post
     * @param null $tag
     */
    public function clearCache($tag = null)
    {
        cache()->tags($tag == null ? $this->tag : $tag)->flush();
    }

    public function clearAllCache()
    {
        cache()->flush();
    }


}