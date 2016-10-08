<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/10/5
 * Time: 0:00
 */

namespace App\Observers;


use App\Contracts\XblogCache;
use App\Http\Controllers\SiteMapController;
use App\Post;

class PostObserver
{
    protected $xblogCache;

    public function __construct()
    {

    }

    public function created(Post $post)
    {
        $this->getXblogCache()->clearCache();
        cache()->tags(SiteMapController::tag)->flush();
    }

    public function updated(Post $post)
    {
        $this->getXblogCache()->clearCache();
    }

    /**
     * @return XblogCache
     */
    private function getXblogCache()
    {
        if ($this->xblogCache == null) {
            $this->xblogCache = app('XblogCache');
            $this->xblogCache->setTag(SiteMapController::tag);
        }
        return $this->xblogCache;
    }
}