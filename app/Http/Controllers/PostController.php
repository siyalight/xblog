<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Repository\CategoryRepository;
use App\Http\Repository\MapRepository;
use App\Http\Repository\PostRepository;
use App\Http\Repository\TagRepository;
use App\Http\Requests;
use App\Post;
use App\Tag;
use Gate;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostController extends Controller
{
    protected $postRepository;
    protected $tagRepository;
    protected $categoryRepository;
    protected $mapRepository;

    /**
     * PostController constructor.
     * @param PostRepository $postRepository
     * @param CategoryRepository $categoryRepository
     * @param TagRepository $tagRepository
     * @param MapRepository $mapRepository
     */
    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository, TagRepository $tagRepository, MapRepository $mapRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
        $this->mapRepository = $mapRepository;

        $this->middleware(['auth', 'admin'], ['except' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_size = 7;
        if ($map = $this->mapRepository->get('page_size')) {
            $page_size = $map->value;
        }
        $posts = $this->postRepository->pagedPosts($page_size);
        return view('post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create',
            [
                'categories' => $this->categoryRepository->getAll(),
                'tags' => $this->tagRepository->getAll(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->validatePostForm($request);

        if ($this->postRepository->create($request))
            return redirect('admin/posts')->with('success', '文章' . $request['name'] . '创建成功');
        else
            return redirect('admin/posts')->withErrors('文章' . $request['name'] . '创建失败');
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     * @internal param $id
     * @internal param Post $post
     * @internal param int $id
     */
    public function show($slug)
    {
        $post = $this->postRepository->get($slug);
        if (!(auth()->check() && auth()->id() == 1)) {
            $post->increment('view_count');
        }
        return view('post.show', compact('post'));
    }

    public function preview($slug)
    {
        $post = Post::withoutGlobalScopes()->where('slug', $slug)->with('tags')->first();
        if (!$post)
            abort(404);
        return view('post.show', compact('post'));
    }

    public function publish($id)
    {
        $post = Post::withoutGlobalScopes()->find($id);
        if ($post->trashed()) {
            return back()->withErrors($post->title . '发布失败，请先恢复删除');
        }
        $this->clearAllCache();
        if ($post->status == 0) {
            $post->status = 1;
            $post->published_at = Carbon::now();
            if ($post->save())
                return back()->with('success', $post->title . '发布成功');
        } else if ($post->status == 1) {
            $post->status = 0;
            if ($post->save())
                return back()->with('success', $post->title . '撤销发布成功');
        }
        return back()->withErrors($post->title . '操作失败');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Post $post
     * @internal param int $id
     */
    public function edit($id)
    {
        $post = Post::withoutGlobalScopes()->find($id);

        if (Gate::denies('update', $post)) {
            abort(403);
        }
        return view('post.edit', [
            'post' => $post,
            'categories' => $this->categoryRepository->getAll(),
            'tags' => $this->tagRepository->getAll(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return mixed
     * @internal param Post $post
     * @internal param int $id
     */
    public function update(Request $request, $id)
    {
        $post = Post::withoutGlobalScopes()->find($id);
        if (Gate::denies('update', $post)) {
            abort(403);
        }

        $this->validatePostForm($request, true);

        if ($this->postRepository->update($request, $post)) {
            return redirect('admin/posts')->with('success', '文章' . $request['name'] . '修改成功');
        } else
            return redirect('admin/posts')->withErrors('文章' . $request['name'] . '修改失败');
    }

    public function restore($id)
    {
        $post = Post::withoutGlobalScopes()->findOrFail($id);
        if ($post->trashed()) {
            $post->restore();
            $this->clearAllCache();
            return redirect()->route('admin.posts')->with('success', '恢复成功');
        }
        return redirect()->route('admin.posts')->withErrors('恢复失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return mixed
     */
    public function destroy($id)
    {

        $post = Post::withoutGlobalScopes()->findOrFail($id);
        $redirect = '/admin/posts';
        if (request()->has('redirect'))
            $redirect = request()->input('redirect');

        if ($post->trashed()) {
            $result = $post->forceDelete();
        } else {
            $result = $post->delete();
        }
        if ($result) {
            $this->clearAllCache();
            return redirect($redirect)->with('success', '删除成功');
        } else
            return redirect($redirect)->withErrors('删除失败');
    }

    private function validatePostForm(Request $request, $update = false)
    {
        $v = [
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'content' => 'required',
        ];
        if (!$update)
            $v = array_merge($v, ['slug' => 'required|unique:posts']);
        $this->validate($request, $v);
    }

    public function clearAllCache()
    {
        cache()->flush();
    }
}
