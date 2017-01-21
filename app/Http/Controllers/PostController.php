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

    /**
     * PostController constructor.
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
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
        return view('post.show', compact('post'));
    }
}
