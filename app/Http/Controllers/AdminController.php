<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Post;
use App\Tag;
use App\User;
use DB;
class AdminController extends Controller
{
    //
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
    public function index()
    {
        $info=[];
        $info['post_count'] = Post::count();
        $info['user_count'] = User::count();
        $info['category_count'] = Category::count();
        $info['tag_count'] = Tag::count();

        return view('admin.index',compact('info'));
    }

    public function posts()
    {
        $posts = Post::all(['title','created_at','slug']);
        return view('admin.posts',compact('posts'));
    }
}
