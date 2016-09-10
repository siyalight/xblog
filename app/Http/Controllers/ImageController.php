<?php

namespace App\Http\Controllers;

use App\Http\Repository\ImageRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Storage;

class ImageController extends Controller
{
    protected $imageRepository;

    /**
     * ImageController constructor.
     * @param $imageRepository
     */
    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->middleware(['auth', 'admin']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function images()
    {
        $images = $this->imageRepository->getAll();
        return view('admin.images', compact('images'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function uploadImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|max:5000'
        ]);

        if ($this->imageRepository->uploadImage($request))
            return back()->with('success', '上传成功');
        return back()->withErrors('上传失败');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function deleteImage(Request $request)
    {
        $key = $request->get('key');
        $result = false;
        if ($this->imageRepository->delete($key)) {
            $result = Storage::delete($key);
        }
        if ($result)
            return back()->with('success', '删除成功');
        return back()->with('success', '删除失败');
    }
}
