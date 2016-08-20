<?php

namespace App\Http\Controllers;

use App\Http\Repository\TagRepository;
use App\Tag;
use Illuminate\Http\Request;
class TagController extends Controller
{
    public $tagRepository;

    /**
     * TagController constructor.
     * @param $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags',
        ]);

        if ($this->tagRepository->create($request))
            return redirect()->back()->with('success', 'Tag' . $request['name'] . '创建成功');
        else
            return redirect()->back()->with('error', 'Tag' . $request['name'] . '创建失败');
    }

    public function destroy(Tag $tag)
    {
        if ($tag->posts()->withoutGlobalScopes()->count() > 0) {
            return redirect()->route('admin.tags')->withErrors($tag->name . '下面有文章，不能刪除');
        }
        $this->tagRepository->clearCache();

        if ($tag->delete())
            return redirect()->back()->with('success', $tag->name . '刪除成功');
        return redirect()->back()->withErrors($tag->name . '刪除失败');
    }
}
