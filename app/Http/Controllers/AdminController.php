<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

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
}
