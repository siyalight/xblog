<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/19
 * Time: 17:41
 */
namespace App\Http\Repository;

use App\File;
use App\Image;
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
            return File::where('type', 'image')->paginate($page);
        });
        return $maps;
    }

    public function get($key)
    {
        $map = $this->remember('image.one.' . $key, function () use ($key) {
            return File::where('key', $key)->first();
        });
        return $map;
    }

    public function uploadImageToQiNiu(Request $request, $html)
    {
        $data = [];
        $file = $request->file('image');
        $fileName = 'images/' . $file->hashName();
        if ($this->fileUploadManager->uploadFile($fileName, $file->getRealPath())) {
            $image = File::firstOrNew([
                'name' => $file->getClientOriginalName(),
                'key' => $fileName,
                'size' => $file->getSize(),
                'type' => 'image'
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
        return app(File::class);
    }
}