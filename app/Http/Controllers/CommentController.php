<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CommentRepository;
use App\Http\Repositories\PostRepository;
use App\Http\Requests;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentRepository;
    protected $postRepository;

    /**
     * CommentController constructor.
     * @param CommentRepository $commentRepository
     * @param PostRepository $postRepository
     */
    public function __construct(CommentRepository $commentRepository, PostRepository $postRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->postRepository = $postRepository;
        $this->middleware('auth',['except'=>'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | mixed
     */
    public function store(Request $request)
    {
        if (!$request->get('content')) {
            return ['status' => 500, 'msg' => 'empty content'];
        }
        if ($comment = $this->commentRepository->create($request))
            return ['status' => 200, 'msg' => 'success', 'comment' => $comment];
        return ['status' => 500, 'msg' => 'failed'];
    }

    /**
     * Display the specified resource.
     *
     * @param $post_id
     * @return \Illuminate\Http\Response|mixed
     */
    public function show($post_id)
    {
        $post = $this->postRepository->getWithoutContent($post_id);
        $comments = $this->commentRepository->getByPost($post);
        return view('post.comments', compact('post', 'comments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response | mixed
     */
    public function destroy($id)
    {
        if ($this->commentRepository->delete($id)) {
            return back()->with('success', '删除成功');
        }
        return back()->withErrors('删除失败');
    }
}
