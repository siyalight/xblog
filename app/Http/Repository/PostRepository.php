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
/**
 * Class PostRepository
 * @package App\Http\Repository
 */
class PostRepository
{
    /**
     * @param int $page
     * @return mixed
     */
    public function pagedPostsWithOutContentWithTrashed($page = 20)
    {
        return Post::withTrashed()->orderBy('created_at', 'desc')->select(['id', 'title', 'slug', 'deleted_at', 'published_at'])->paginate($page);
    }

    /**
     * @param int $page
     * @return mixed
     */
    public function pagedPosts($page = 7)
    {
        return Post::with(['tags', 'category'])->published()->orderBy('created_at', 'desc')->paginate($page);
    }

    /**
     * @param $slug string
     * @return Post
     */
    public function get($slug)
    {
        $post = Post::where('slug', $slug)->with('tags')->first();
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

    public function update(Request $request,Post $post)
    {
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
}