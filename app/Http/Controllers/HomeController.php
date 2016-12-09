<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PostRepository;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $postRepository;

    /**
     * Create a new controller instance.
     *
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        return view('index');
    }

    public function search(Request $request)
    {
        $key = trim($request->get('q'));
        if ($key == '')
            return back()->withErrors("请输入关键字");

        $key = "%$key%";
        $posts = Post::where('title', 'like', $key)
            ->orWhere('description', 'like', $key)
            ->with(['tags', 'category'])
            ->withCount('comments')
            ->orderBy('view_count', 'desc')
            ->get();
        return view('search', compact('posts'));
    }

    public function projects()
    {
        return view('projects');
    }

    public function achieve()
    {
        $posts = $this->postRepository->achieve();
        $posts_count = $this->postRepository->postCount();
        return view('achieve', compact('posts', 'posts_count'));
    }

}
