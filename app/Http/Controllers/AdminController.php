<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Page;
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
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $info = [];
        $info['post_count'] = Post::withTrashed()->count();
        $info['user_count'] = User::count();
        $info['category_count'] = Category::count();
        $info['tag_count'] = Tag::count();
        $info['page_count'] = Page::count();

        return view('admin.index', compact('info'));
    }

    public function posts()
    {
        $posts = Post::withTrashed()->orderBy('created_at','desc')->select(['id', 'title', 'slug', 'deleted_at', 'published_at'])->paginate(20);
        return view('admin.posts', compact('posts'));
    }

    public function tags()
    {
        $tags = Tag::paginate(20);
        return view('admin.tags', compact('tags'));
    }

    public function categories()
    {
        $categories = Category::paginate(20);
        return view('admin.categories', compact('categories'));
    }

    public function users()
    {
        $users = User::paginate(20);
        return view('admin.users', compact('users'));
    }

    public function pages()
    {
        $pages = Page::paginate(20);
        return view('admin.pages', compact('pages'));
    }

}
