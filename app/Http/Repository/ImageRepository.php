<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/19
 * Time: 17:41
 */
namespace App\Http\Repository;

use App\Map;
use Illuminate\Http\Request;
use Storage;

/**
 * Class TagRepository
 * @package App\Http\Repository
 */
class ImageRepository extends MapRepository
{
    static $tag = 'map.image';

    public function getAll($page = 12)
    {
        $maps = $this->remember('map.image.page.' . $page . request()->get('page', 1), function () use ($page) {
            return Map::where('tag', 'images')->paginate($page);
        });
        return $maps;
    }

    public function get($key)
    {
        $map = $this->remember('map.image.one.' . $key, function () use ($key) {
            return Map::where('key', $key)->first();
        });
        return $map;
    }

    public function uploadImage(Request $request)
    {
        $file = $request->file('image');
        $path = $file->store('public/images');
        if ($path) {
            $image = Map::firstOrNew([
                'key' => $path
            ]);
            $url = Storage::url($path);
            $image->tag = 'images';
            $image->value = $url;
            $image->meta = json_encode([
                'name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mimeType' => $file->getMimeType(),
                'ctime' => $file->getCTime(),
            ]);
            $result = $image->save();
        } else {
            $result = false;
        }
        $this->clearCache();
        return $result;
    }

    public function count($tag = null)
    {
        return parent::count('images');
    }

    public function delete($key)
    {
        $result = false;
        if (parent::delete($key)) {
            $result = Storage::delete($key);
        }
        return $result;
    }

    public function tag()
    {
        return ImageRepository::$tag;
    }
}