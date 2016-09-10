<?php

namespace App\Http\Controllers;

use App\Http\Repository\MapRepository;
use App\Http\Repository\PostRepository;
use App\Jobs\Test;
use App\P;
use App\Post;
use App\Project;
use DB;
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dispatch(new Test());

        $page_size = 7;
        if ($map = $this->mapRepository->get('page_size')) {
            $page_size = $map->value;
        }
        $posts = $this->postRepository->pagedPosts($page_size);
        return view('index', ['posts' => $posts]);
    }

    public function home()
    {
        return redirect('/');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        /*$page_size = 7;
        if ($map = $this->mapRepository->get('page_size')) {
            $page_size = $map->value;
        }*/
        $posts = Post::search($query)->get();
        return view('search', compact('posts'));
    }

    public function projects()
    {
        return view('projects');
    }
}
