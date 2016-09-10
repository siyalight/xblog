<?php

namespace App\Http\Controllers;

use App\Http\Repository\MapRepository;
use App\Http\Repository\PostRepository;
use App\P;
use App\Post;
use App\Project;
use DB;

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
        $page_size = 7;
        if ($map = $this->mapRepository->get('page_size')) {
            $page_size = $map->value;
        }
        $posts = $this->postRepository->pagedPosts($page_size);
        $posts = Post::search('1')->paginate($page_size);
        return view('index', ['posts' => $posts]);
    }

    public function home()
    {
        return redirect('/');
    }

    public function projects()
    {
        return view('projects');
    }
}
