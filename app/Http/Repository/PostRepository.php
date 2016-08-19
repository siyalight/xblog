<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/19
 * Time: 17:41
 */
namespace App\Http\Repository;

use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

/**
 * Class PostRepository
 * @package App\Http\Repository
 */
class PostRepository
{

    static $tag = 'post';

    public $time = 1440;

    /**
     * @param int $page
     * @return mixed
     */
    public function pagedPostsWithOutContentWithTrashed($page = 20)
    {
        $posts = cache()->tags(PostRepository::$tag)->remember('post.WithOutContent.' . $page . '' . request()->get('page', 1), $this->time, function () use ($page) {
            return Post::withTrashed()->orderBy('created_at', 'desc')->select(['id', 'title', 'slug', 'deleted_at', 'published_at'])->paginate($page);
        });
        return $posts;
    }

    /**
     * @param int $page
     * @return mixed
     */
    public function pagedPosts($page = 7)
    {
        /*DB::connection()->enableQueryLog();*/
        $posts = cache()->tags(PostRepository::$tag)->remember('post.page.' . $page . '' . request()->get('page', 1), $this->time, function () use ($page) {
            return Post::with(['tags', 'category'])->published()->orderBy('created_at', 'desc')->paginate($page);
        });
        /*var_dump(DB::getQueryLog());*/
        return $posts;
    }

    /**
     * @param $slug string
     * @return Post
     */
    public function get($slug)
    {
        $post = cache()->tags(PostRepository::$tag)->remember('post.one.' . $slug, $this->time, function () use ($slug) {
            return Post::where('slug', $slug)->with('tags')->first();
        });

        if (!$post)
            abort(404);
        return $post;
    }

    /**
     * @param Request $request
     * @return mixed
     */

    public function create(Request $request)
    {
        $this->clearCache();
        cache()->tags(TagRepository::$tag)->flush();

        $ids = [];
        $tags = $request['tags'];
        if (!empty($tags)) {
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                array_push($ids, $tag->id);
            }
        }

        $published = $request->has('published');
        if ($published)
            $request['published_at'] = Carbon::now();

        $post = auth()->user()->posts()->create(
            $request->all()
        );
        $post->tags()->sync($ids);

        return $post;
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return bool|int
     */

    public function update(Request $request, Post $post)
    {
        $this->clearCache();
        cache()->tags(TagRepository::$tag)->flush();


        $ids = [];
        $tags = $request['tags'];
        if (!empty($tags)) {
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                array_push($ids, $tag->id);
            }
        }

        $post->tags()->sync($ids);

        $published = $request->has('published');
        if ($published)
            $request['published_at'] = Carbon::now();

        return $post->update($request->all());
    }

    public function clearCache()
    {
        cache()->tags(PostRepository::$tag)->flush();
    }
}