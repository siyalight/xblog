<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Repositories\CssRepository;
use App\Http\Repositories\FontRepository;
use App\Http\Repositories\ImageRepository;
use App\Http\Repositories\JsRepository;
use App\Http\Repositories\UnknownFileRepository;
use Illuminate\Http\Request;

class FileController extends Controller
{
    protected $imageRepository;
    protected $cssRepository;
    protected $jsRepository;
    protected $fontRepository;
    protected $unknownFileRepository;

    /**
     * ImageController constructor.
     * @param ImageRepository $imageRepository
     * @param JsRepository $jsRepository
     * @param FontRepository $fontRepository
     * @param CssRepository $cssRepository
     * @param UnknownFileRepository $unknownFileRepository
     */
    public function __construct(ImageRepository $imageRepository,
                                JsRepository $jsRepository,
                                FontRepository $fontRepository,
                                CssRepository $cssRepository,
                                UnknownFileRepository $unknownFileRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->jsRepository = $jsRepository;
        $this->fontRepository = $fontRepository;
        $this->cssRepository = $cssRepository;
        $this->unknownFileRepository = $unknownFileRepository;
        $this->middleware(['auth', 'admin']);
    }


    public function files()
    {
        $files = $this->imageRepository->getAllFiles();
        return view('admin.files', compact('files'));
    }


    public function uploadCss(Request $request)
    {
        return ($this->cssRepository->uploadCss($request));
    }


    public function uploadJs(Request $request)
    {
        return ($this->jsRepository->uploadJs($request));
    }

    public function uploadFont(Request $request)
    {
        return ($this->fontRepository->uploadFont($request));
    }

    public function uploadTypeFile(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
            'type' => 'required',
        ]);
        $result = false;
        switch ($request->get('type')) {
            case 'js':
                $result = $this->uploadJs($request);
                break;
            case 'css':
                $result = $this->uploadCss($request);
                break;
            case 'font':
                $result = $this->uploadFont($request);
                break;
        }
        if ($result)
            return back()->with('success', '上传成功');
        return back()->withErrors('上传失败');
    }

    public function uploadFile(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
        ]);
        $type = $request->get('type');
        if ($type) {
            return $this->uploadTypeFile($request);
        }

        $this->unknownFileRepository->setTag($this->getTag($request));
        $result = $this->unknownFileRepository->upload($request);

        if ($result)
            return back()->with('success', '上传成功');
        return back()->withErrors('上传失败');
    }


    public function deleteFile(Request $request)
    {
        $key = $request->get('key');
        switch ($request->get('type')) {
            case 'image':
                $result = $this->imageRepository->delete($key);
                break;
            case 'js':
                $result = $this->jsRepository->delete($key);
                break;
            case 'css':
                $result = $this->cssRepository->delete($key);
                break;
            default:
                $type = File::where('key',$key)->first()->type;
                $this->unknownFileRepository->setTag($type);
                $result = $this->unknownFileRepository->delete($key);
                break;
        }
        if ($result) {
            return back()->with('success', '删除成功');
        }
        return back()->with('success', '删除失败');
    }

    private function getTag(Request $request)
    {
        $tag = $request->file('file')->getClientOriginalExtension();
        if (!$tag) {
            $tag = 'unknown';
        }
        return $tag;
    }
}
