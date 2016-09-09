<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/19
 * Time: 17:41
 */
namespace App\Http\Repository;

use App\Map;
use App\Tag;
use Illuminate\Http\Request;

/**
 * Class TagRepository
 * @package App\Http\Repository
 */
class MapRepository extends Repository
{
    static $tag = 'map';

    public function getAll()
    {
        $tags = $this->remember('tag.all', function () {
            return Map::all();
        });
        return $tags;
    }

    public function create(Request $request)
    {
        $this->clearCache();

        $map = Map::create([
            'name' => $request['name'],
            'value' => $request['value'],
        ]);
        return $map;
    }
    public function tag()
    {
        return MapRepository::$tag;
    }
}