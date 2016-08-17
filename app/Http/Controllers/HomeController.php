<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*$this->middleware('auth');*/
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $key = 'post.page.' . request()->get('page', "1");
        $posts = cache($key);
        if (!$posts) {
            $posts = Post::published()->orderBy('created_at', 'desc')->paginate(7);
            cache([$key => $posts], 6000);
        }
        return view('index', ['posts' => $posts]);
    }
}
