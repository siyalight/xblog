<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Repository\CategoryRepository;
use App\Http\Repository\PostRepository;
use App\Http\Repository\TagRepository;
use App\Http\Requests;
use App\Page;
use App\Post;
use App\Tag;
use App\User;
use DB;

class AdminController extends Controller
{
    protected $postRepository;
    protected $tagRepository;
    protected $categoryRepository;

    /**
     * AdminController constructor.
     * @param PostRepository $postRepository
     * @param CategoryRepository $categoryRepository
     * @param TagRepository $tagRepository
     */
    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository, TagRepository $tagRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
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
        $posts = $this->postRepository->pagedPostsWithOutContentWithTrashed();
        dd($posts);
        return view('admin.posts', compact('posts'));
    }

    public function tags()
    {
        $tags = $this->tagRepository->getAll();
        return view('admin.tags', compact('tags'));
    }

    public function categories()
    {
        $categories = $this->categoryRepository->getAll();
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
