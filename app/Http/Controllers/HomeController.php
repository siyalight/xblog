<?php

namespace App\Http\Controllers;

use App\Http\Repository\PostRepository;
use App\P;
use App\Post;
use App\Project;
use DB;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(Project::all());
        $posts = $this->postRepository->pagedPosts();
        return view('index', ['posts' => $posts]);
    }

    public function home()
    {
        return redirect('/');
    }

    public function passport()
    {
        return view('passport');
    }
}
