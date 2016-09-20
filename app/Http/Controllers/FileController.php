<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CssRepository;
use App\Http\Repositories\FileRepository;
use App\Http\Repositories\FontRepository;
use App\Http\Repositories\ImageRepository;
use App\Http\Repositories\JsRepository;
use Illuminate\Http\Request;

class FileController extends Controller
{
    protected $imageRepository;
    protected $cssRepository;
    protected $jsRepository;
    protected $fontRepository;

    /**
     * ImageController constructor.
     * @param ImageRepository $imageRepository
     * @param JsRepository $jsRepository
     * @param FontRepository $fontRepository
     * @param CssRepository $cssRepository
     */
    public function __construct(ImageRepository $imageRepository,
                                JsRepository $jsRepository,
                                FontRepository $fontRepository,
                                CssRepository $cssRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->jsRepository = $jsRepository;
        $this->fontRepository = $fontRepository;
        $this->cssRepository = $cssRepository;
        $this->middleware(['auth', 'admin']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function files()
    {
        $files = $this->imageRepository->getAllFiles();
        return view('admin.files', compact('files'));
    }


    public function uploadCss(Request $request)
    {
        return ($this->cssRepository->uploadCss($request));
    }

    /**
     * @param Request $request
     * @return mixed
     */

    public function uploadJs(Request $request)
    {
        return ($this->jsRepository->uploadJs($request));
    }

    public function uploadFont(Request $request)
    {
        return ($this->fontRepository->uploadFont($request));
    }

    public function uploadFile(Request $request)
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
                $result = $this->uploadJs($request);
                break;
            case 'font':
                $result = $this->uploadFont($request);
                break;
        }
        if ($result)
            return back()->with('success', '上传成功');
        return back()->withErrors('上传失败');
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function deleteFile(Request $request)
    {
        $result = false;
        switch ($request->get('type')) {
            case 'image':
                $result = $this->imageRepository->delete($request->get('key'));
                break;
            case 'js':
                $result = $this->jsRepository->delete($request->get('key'));
                break;
            case 'css':
                $result = $this->cssRepository->delete($request->get('key'));
                break;
        }
        if ($result) {
            return back()->with('success', '删除成功');
        }
        return back()->with('success', '删除失败');
    }
}
