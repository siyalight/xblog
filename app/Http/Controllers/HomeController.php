<?php

namespace App\Http\Controllers;

use App\Http\Repositories\MapRepository;
use App\Http\Repositories\PostRepository;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $postRepository;

    protected $mapRepository;

    /**
     * Create a new controller instance.
     *
     * @param PostRepository $postRepository
     * @param MapRepository $mapRepository
     */
    public function __construct(PostRepository $postRepository, MapRepository $mapRepository)
    {
        $this->postRepository = $postRepository;
        $this->mapRepository = $mapRepository;
    }


    public function index()
    {
        return view('index');
    }

    public function search(Request $request)
    {
        $posts = Post::search($request->get('q'))->get();
        return view('search', compact('posts'));
    }

    public function projects()
    {
        return view('projects');
    }

    public function achieve()
    {
        $posts = $this->postRepository->achieve();
        $posts_count = Post::count();
        return view('achieve', compact('posts','posts_count'));
    }

}
