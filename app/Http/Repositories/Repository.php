<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/25
 * Time: 13:07
 */

namespace App\Http\Repositories;

use Closure;

abstract class Repository
{
    public $time = 60;

    /**
     * @return string
     */
    public abstract function tag();

    public abstract function model();

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

    public function count()
    {
        $count = $this->remember($this->tag() . '.count', function () {
            return $this->model()->count();
        });
        return $count;
    }

    public function all()
    {
        $all = $this->remember($this->tag() . '.all', function () {
            return $this->model()->all();
        });
        return $all;
    }

    public function forget($key, $tag = null)
    {
        cache()->tags($tag == null ? $this->tag() : $tag)->forget($key);
    }

    public function clearAllCache()
    {
        cache()->flush();
    }
}