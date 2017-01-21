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

    public function edit(Comment $comment)
    {
        return view('comment.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $this->checkPolicy('manager', $comment);

        if ($this->commentRepository->update($request->get('content'), $comment)) {
            $redirect = request('redirect');
            if ($redirect)
                return redirect($redirect)->with('success', '修改成功');
            return back()->with('success', '修改成功');
        }
        return back()->withErrors('修改失败');
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


    public function destroy($comment_id)
    {
        if (request('force') == 'true') {
            $comment = Comment::withTrashed()->findOrFail($comment_id);
        } else {
            $comment = Comment::findOrFail($comment_id);
        }

        $this->checkPolicy('manager', $comment);

        if ($this->commentRepository->delete($comment, request('force') == 'true')) {
            return back()->with('success', '删除成功');
        }
        return back()->withErrors('删除失败');
    }
}
