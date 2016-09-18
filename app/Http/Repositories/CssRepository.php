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
use Lufficc\FileUploadManager;
use Storage;


/**
 * Class TagRepository
 * @package App\Http\Repository
 */
class CssRepository extends FileRepository
{
    static $tag = 'js';

    public function uploadCss(Request $request)
    {
        $this->deleteAllByType();
        $file = $request->file('css');
        return $this->uploadFile($file, $file->getClientOriginalName());
    }

    public function tag()
    {
        return JsRepository::$tag;
    }


    public function type()
    {
        return 'css';
    }
}