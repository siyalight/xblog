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
use Illuminate\Http\Request;
use Lufficc\Mention;
use Parsedown;

/**
 * Class CommentRepository
 * @package App\Http\Repository
 */
class CommentRepository extends Repository
{
    static $tag = 'comment';
    protected $parseDown;
    protected $mention;

    /**
     * PostRepository constructor.
     * @param Mention $mention
     */
    public function __construct(Mention $mention)
    {
        $this->mention = $mention;
        $this->parseDown = new Parsedown();
    }

    public function model()
    {
        return app(Comment::class);
    }

    private function getCacheKey($post_id)
    {
        return 'post.' . $post_id . 'comments';
    }

    public function getByPost(Post $post)
    {
        $comments = $this->remember($this->getCacheKey($post->id), function () use ($post) {
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
        $comment->content = $this->mention->parse($request->get('content'));
        $comment->html_content = $this->parseDown->text($comment->content);

        if (auth()->check()) {
            $user = auth()->user();
            $comment->user_id = $user->id;
            $comment->username = $user->name;
            $comment->email = $user->email;
        } else {
            $comment->username = $request->get('username');
            $comment->email = $request->get('email');
        }

        return $post->comments()->save($comment);
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        $this->forget($this->getCacheKey($comment->commentable_id));
        return $comment->delete();
    }

    public function tag()
    {
        return CommentRepository::$tag;
    }

}