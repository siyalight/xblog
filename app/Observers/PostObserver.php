<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/10/5
 * Time: 0:00
 */

namespace App\Observers;


use App\Http\Controllers\SiteMapController;
use App\Post;

class PostObserver
{
    public function created(Post $post)
    {
        cache()->tags(SiteMapController::tag)->flush();
    }

    public function updated(Post $post)
    {
        cache()->tags(SiteMapController::tag)->flush();
    }
}