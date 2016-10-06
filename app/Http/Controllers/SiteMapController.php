<?php

namespace App\Http\Controllers;

use App\Post;

use App\Http\Requests;
use Lufficc\Cache\Cacheable;

class SiteMapController extends Controller
{
    use Cacheable;
    const key = 'sitemap.index';
    const tag = 'sitemap';

    public function index()
    {
        $view = $this->remember(SiteMapController::key,function (){
            $posts = Post::select([
                'slug',
                'updated_at',
            ])->orderBy('view_count', 'desc')->get();
            return view('sitemap.index', compact('posts'))->render();
        });
        return response($view)->header('Content-Type', 'text/xml');
    }

    /**
     * @return string
     */
    public function tag()
    {
        return SiteMapController::tag;
    }

    public function cacheTime()
    {
        return 60 * 24;
    }
}
