<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/25
 * Time: 13:07
 */

namespace App\Http\Repository;

use Closure;

abstract class Repository
{
    public $time = 120;

    /**
     * @return string
     */
    public abstract function tag();

    public function remember($key, Closure $entity, $tag = null)
    {
        return cache()->tags($tag == null ? $this->tag() : $tag)->remember($key, $this->time, $entity);
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