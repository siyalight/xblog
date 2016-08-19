<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/19
 * Time: 17:41
 */
namespace App\Http\Repository;

use App\Tag;

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
            return Tag::all();
        });

        return $tags;
    }

    public function clearCache()
    {
        cache()->tags(TagRepository::$tag)->flush();
    }
}