<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Repositories\CommentRepository;
use App\Http\Repositories\PostRepository;
use App\Http\Requests;
use Gate;
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
        $this->middleware('auth', ['except' => ['show', 'store']]);
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
        if (!auth()->check()) {
            if (!($request->get('username') && $request->get('email')) || !str_contains($request->get('email'), '@')) {
                return ['status' => 500, 'msg' => 'empty info'];
            }
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
     * @param Comment $comment
     * @return \Illuminate\Http\Response|mixed
     */
    public function destroy(Comment $comment)
    {
        $this->checkPolicy('manager',$comment);

        dd(back()->with('success', '删除成功'));

        if ($this->commentRepository->delete($comment)) {
            return back()->with('success', '删除成功');
        }
        return back()->withErrors('删除失败');
    }
}
