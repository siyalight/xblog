<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/19
 * Time: 17:41
 */
namespace App\Http\Repository;

use App\Tag;
use Illuminate\Http\Request;

/**
 * Class TagRepository
 * @package App\Http\Repository
 */
class TagRepository
{
    static $tag = 'tag';

    public $time = 1440;

    public function getAll()
    {
        $tags = cache()->tags(TagRepository::$tag)->remember('tag.all', $this->time, function () {
            return Tag::withCount('posts')->get();
        });

        return $tags;
    }
    public function create(Request $request)
    {
        $this->clearCache();
        $tag = Tag::create(['name' => $request['name']]);
        return $tag;
    }
    public function clearCache()
    {
        cache()->tags(TagRepository::$tag)->flush();
    }
}