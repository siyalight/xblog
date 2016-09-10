<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Repository\CategoryRepository;
use App\Http\Repository\ImageRepository;
use App\Http\Repository\MapRepository;
use App\Http\Repository\PostRepository;
use App\Http\Repository\TagRepository;
use App\Http\Requests;
use App\Map;
use App\Page;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Storage;

class AdminController extends Controller
{
    protected $postRepository;
    protected $tagRepository;
    protected $categoryRepository;
    protected $mapRepository;
    protected $imageRepository;

    /**
     * AdminController constructor.
     * @param PostRepository $postRepository
     * @param CategoryRepository $categoryRepository
     * @param TagRepository $tagRepository
     * @param MapRepository $mapRepository
     * @param ImageRepository $imageRepository
     */
    public function __construct(PostRepository $postRepository,
                                CategoryRepository $categoryRepository,
                                TagRepository $tagRepository,
                                MapRepository $mapRepository,
                                ImageRepository $imageRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
        $this->mapRepository = $mapRepository;
        $this->imageRepository = $imageRepository;
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $info = [];
        $info['post_count'] = Post::withoutGlobalScopes()->count();
        $info['user_count'] = User::count();
        $info['category_count'] = Category::count();
        $info['tag_count'] = Tag::count();
        $info['page_count'] = Page::count();

        return view('admin.index', compact('info'));
    }

    public function settings()
    {
        $settings = $this->mapRepository->getArrayByTag('settings');
        return view('admin.settings', $settings);
    }

    public function saveSettings(Request $request)
    {
        $inputs = $request->except('_token');

        foreach ($inputs as $key => $value) {
            $map = Map::firstOrNew([
                'key' => $key,
            ]);
            $map->tag = 'settings';
            $map->value = $value;
            $map->save();
        }
        $this->mapRepository->clearCache();
        return back()->with('success', '保存成功');
    }

    public function posts()
    {
        $posts = $this->postRepository->pagedPostsWithoutGlobalScopes();
        return view('admin.posts', compact('posts'));
    }

    public function tags()
    {
        $tags = $this->tagRepository->getAll();
        return view('admin.tags', compact('tags'));
    }

    public function categories()
    {
        $categories = $this->categoryRepository->getAll();
        return view('admin.categories', compact('categories'));
    }

    public function users()
    {
        $users = User::paginate(20);
        return view('admin.users', compact('users'));
    }

    public function images()
    {
        $images = $this->imageRepository->getAll();
        return view('admin.images',compact('images'));
    }

    public function uploadImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|max:5000'
        ]);

        if ($this->imageRepository->uploadImage($request))
            return back()->with('success', '上传成功');
        return back()->withErrors('上传失败');
    }

    public function pages()
    {
        $pages = Page::paginate(20);
        return view('admin.pages', compact('pages'));
    }

}
