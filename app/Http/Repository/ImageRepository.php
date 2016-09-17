<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/19
 * Time: 17:41
 */
namespace App\Http\Repository;

use App\Image;
use App\Map;
use Illuminate\Http\Request;
use Lufficc\FileUploadManager;
use Storage;


/**
 * Class TagRepository
 * @package App\Http\Repository
 */
class ImageRepository extends Repository
{
    static $tag = 'image';
    private $fileUploadManager;

    /**
     * ImageRepository constructor.
     * @param FileUploadManager $fileUploadManager
     */
    public function __construct(FileUploadManager $fileUploadManager)
    {
        $this->fileUploadManager = $fileUploadManager;
    }


    public function getAll($page = 12)
    {
        $maps = $this->remember('image.page.' . $page . request()->get('page', 1), function () use ($page) {
            return Image::paginate($page);
        });
        return $maps;
    }

    public function get($key)
    {
        $map = $this->remember('image.one.' . $key, function () use ($key) {
            return Map::where('key', $key)->first();
        });
        return $map;
    }

    public function uploadImageToQiNiu(Request $request, $html)
    {
        $data = [];
        $file = $request->file('image');
        $fileName = 'images/' . $file->hashName();
        if ($this->fileUploadManager->uploadFile($fileName, $file->getRealPath())) {
            $image = Image::firstOrNew([
                'name' => $file->getClientOriginalName(),
                'key' => $fileName,
                'size' => $file->getSize(),
            ]);
            if ($image->save()) {
                if ($html) {
                    $this->clearCache();
                    return true;
                }
                $data['filename'] = getUrlByFileName($fileName);
            } else {
                if ($html)
                    return false;
                $data['error'] = 'upload failed';
            }
        } else {
            if ($html)
                return false;
            $data['error'] = 'upload failed';
        }
        $this->clearCache();
        return $data;
    }


    public function uploadImageToLocal(Request $request)
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


    public function delete($key)
    {
        $result = $this->fileUploadManager->deleteFile($key);
        if ($result) {
            $this->clearCache();
            Image::where('key', $key)->delete();
        }
        return $result;
    }

    public function tag()
    {
        return ImageRepository::$tag;
    }

    public function model()
    {
        return app(Image::class);
    }
}