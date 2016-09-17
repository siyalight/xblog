<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/19
 * Time: 17:41
 */
namespace App\Http\Repositories;

use App\File;
use Illuminate\Http\Request;
use Storage;


/**
 * Class TagRepository
 * @package App\Http\Repository
 */
class ImageRepository extends FileRepository
{
    static $tag = 'image';

    public function getAll($page = 12)
    {
        $maps = $this->remember('image.page.' . $page . request()->get('page', 1), function () use ($page) {
            return File::where('type', 'image')->orderBy('created_at', 'desc')->paginate($page);
        });
        return $maps;
    }

    public function uploadImageToQiNiu(Request $request, $html)
    {
        $file = $request->file('image');
        $data = [];
        $url = $this->uploadFile($file);
        if ($url) {
            if ($html) {
                return true;
            } else {
                $data['filename'] = $url;
            }
        } else {
            if ($html)
                return false;
            $data['error'] = 'upload failed';
        }
        return $data;
    }

    public function uploadImageToLocal(Request $request)
    {
        $file = $request->file('image');
        $path = $file->store('public/images');
        $url = Storage::url($path);

        if ($path) {
            $image = File::firstOrNew([
                'name' => $file->getClientOriginalName(),
                'key' => $url,
                'size' => $file->getSize(),
                'type' => 'image'
            ]);
            $result = $image->save();
        } else {
            $result = false;
        }
        $this->clearCache();
        return $result;
    }

    public function tag()
    {
        return ImageRepository::$tag;
    }

    public function model()
    {
        return app(File::class);
    }

    public function type()
    {
        return ImageRepository::$tag;
    }
}