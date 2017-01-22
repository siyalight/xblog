<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

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

    public function __construct(CommentRepository $commentRepository, PostRepository $postRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->postRepository = $postRepository;
    }

    public function restore($comment_id)
    {
        $comment = Comment::withTrashed()->findOrFail($comment_id);

        $this->checkPolicy('restore', $comment);

        if ($comment->trashed()) {
            $comment->restore();
            $this->commentRepository->clearAllCache();
            return redirect()->route('admin.comments')->with('success', '恢复成功');
        }
        return redirect()->route('admin.comments')->withErrors('恢复失败');
    }
}
