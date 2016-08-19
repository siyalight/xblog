<?php

namespace App\Http\Controllers;

use Gate;
use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;

class PostController extends Controller
{
    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin'], ['except' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/');
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
                'categories' => Category::all(),
                'tags' => Tag::all(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validatePostForm($request);


        $ids = [];
        $tags = $request['tags'];
        if (!empty($tags)) {
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                array_push($ids, $tag->id);
            }
        }

        $published = $request->has('published');
        if ($published)
            $request['published_at'] = Carbon::now();
        $post = auth()->user()->posts()->create(
            $request->all()
        );
        $post->tags()->sync($ids);

        if ($post)
            return redirect('/')->with('success', '文章' . $request['name'] . '创建成功');
        else
            return redirect('/')->withErrors('文章' . $request['name'] . '创建失败');

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
        $post = Post::where('slug', $slug)->first();
        if (!$post)
            abort(404);
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Post $post)
    {
        if (Gate::denies('update', $post)) {
            abort(403);
        }
        return view('post.edit', [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Post $post)
    {
        if (Gate::denies('update', $post)) {
            abort(403);
        }

        $this->validatePostForm($request, true);

        $ids = [];
        $tags = $request['tags'];
        if (!empty($tags)) {
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                array_push($ids, $tag->id);
            }
        }

        $post->tags()->sync($ids);

        $published = $request->has('published');
        if ($published)
            $request['published_at'] = Carbon::now();


        if ($post->update($request->all()))
            return redirect('/')->with('success', '文章' . $request['name'] . '修改成功');
        else
            return redirect('/')->withErrors('文章' . $request['name'] . '修改失败');
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        if($post->trashed()) {
            $post->restore();
            return redirect()->route('admin.posts')->with('success', '恢复成功');
        }
        return redirect()->route('admin.posts')->withErrors('恢复失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $redirect = '/';
        if (request()->has('redirect'))
            $redirect = request()->input('redirect');

        if($post->trashed()) {
            $result = $post->forceDelete();
        }
        else{
            $result = $post->delete();
        }
        if ($result)
            return redirect($redirect)->with('success', '删除成功');
        else
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
}
