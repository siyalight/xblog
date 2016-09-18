<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/19
 * Time: 17:41
 */
namespace App\Http\Repositories;

use App\Comment;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Parsedown;

/**
 * Class CommentRepository
 * @package App\Http\Repository
 */
class CommentRepository extends Repository
{
    static $tag = 'comment';
    protected $parseDown;

    /**
     * PostRepository constructor.
     */
    public function __construct()
    {
        $this->parseDown = new Parsedown();
    }

    public function model()
    {
        return app(Comment::class);
    }

    public function getByPost(Post $post)
    {
        $comments = $this->remember('comments.' . $post->slug, function () use ($post) {
            return $post->comments()->with(['user'])->get();
        });
        return $comments;
    }

    public function create(Request $request)
    {
        $this->clearCache();

        $comment = new Comment();
        $post_id = $request->get('post_id');
        $post = Post::findOrFail($post_id);
        $comment->content = $request->get('content');
        $comment->html_content = $this->parseDown->text($comment->content);
        $comment->user_id = auth()->id();
        $post->comments()->save($comment);

        return $post->comments()->save($comment);
    }

    public function tag()
    {
        return CommentRepository::$tag;
    }

}