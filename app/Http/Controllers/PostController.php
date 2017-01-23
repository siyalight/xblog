<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CategoryRepository;
use App\Http\Repositories\CommentRepository;
use App\Http\Repositories\PostRepository;
use App\Http\Repositories\TagRepository;
use App\Http\Requests;
use App\Notifications\UserRegistered;
use App\Post;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use League\HTMLToMarkdown\HtmlConverter;
use XblogConfig;

class PostController extends Controller
{
    protected $postRepository;
    protected $commentRepository;

    /**
     * PostController constructor.
     * @param PostRepository $postRepository
     * @param CommentRepository $commentRepository
     */
    public function __construct(PostRepository $postRepository, CommentRepository $commentRepository)
    {
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
    }


    public function index()
    {
        $page_size = XblogConfig::getValue('page_size', 7);
        $posts = $this->postRepository->pagedPosts($page_size);
        return view('post.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = $this->postRepository->get($slug);
        $comments = $this->commentRepository->getByCommentable('App\Post', $post->id);
        $this->onPostShowing($post);
        return view('post.show', compact('post', 'comments'));
    }

    /**
     * onPostShowing, clear this post's unread notifications.
     *
     * @param Post $post
     */

    private function onPostShowing(Post $post)
    {
        $user = auth()->user();
        if (!isAdmin($user)) {
            $post->increment('view_count');
        }
        if (auth()->check()) {
            $unreadNotifications = $user->unreadNotifications;
            foreach ($unreadNotifications as $notifications) {
                $comment = $notifications->data;
                if ($comment['commentable_type'] == 'App\Post' && $comment['commentable_id'] == $post->id) {
                    $notifications->markAsRead();
                }
            }
        }
    }
}
