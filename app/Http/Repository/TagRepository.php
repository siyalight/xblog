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
class TagRepository extends Repository
{
    static $tag = 'tag';

    public function getAll()
    {
        $tags = $this->remember('tag.all', function () {
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
    public function tag()
    {
        return TagRepository::$tag;
    }
}