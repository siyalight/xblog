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
    private $xblogCache;

    private function getXblogCache()
    {
        if ($this->xblogCache == null) {
            $this->xblogCache = app('XblogCache');
            $this->xblogCache->setTag($this->tag());
        }
        return $this->xblogCache;
    }

    public abstract function model();

    public abstract function tag();

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

    public function remember($key, Closure $entity, $tag = null)
    {
        return $this->getXblogCache()->remember($key, $entity, $tag);
    }

    public function forget($key, $tag = null)
    {
        $this->getXblogCache()->forget($key, $tag);
    }

    public function clearCache($tag = null)
    {
        $this->getXblogCache()->clearCache($tag);
    }

    public function clearAllCache()
    {
        $this->getXblogCache()->clearAllCache();
    }

}