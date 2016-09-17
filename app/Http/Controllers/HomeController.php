<?php

namespace App\Http\Controllers;

use App\Http\Repositories\MapRepository;
use App\Http\Repositories\PostRepository;
use App\Post;
use Illuminate\Http\Request;
use Lufficc\FileUploadManager;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $posts = Post::search($query)->get();
        return view('search', compact('posts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function projects()
    {
        return view('projects');
    }
}
