<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
        ]);

        $category = Category::create(['name' => $request['name']]);
        if ($category)
            return redirect('/')->with('success', '分类' . $request['name'] . '创建成功');
        else
            return redirect('/')->with('error', '分类' . $request['name'] . '创建失败');
    }

    /**
     * Display the specified resource.
     *
     * @param $name
     * @return \Illuminate\Http\Response
     * @internal param Category $category
     * @internal param int $id
     */
    public function show($name)
    {
        $category = Category::where('name',$name)->first();
        if(!$category)
            abort(404);

        $posts = $category->posts()->paginate(7);
        return view('category.show',compact('posts','name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
        ]);
        if ($category->update($request->all())) {
            return redirect()->route('admin.index')->with('success', '分类' . $request['name'] . '修改成功');
        }
        return redirect()->back()->withInput()->withErrors('分类' . $request['name'] . '修改失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Category $category)
    {
        if ($category->posts()->count() > 0) {
            return redirect()->route('admin.categories')->withErrors($category->name . '下面有文章，不能刪除');
        }
        if ($category->delete())
            return redirect()->route('admin.categories')->with('success', $category->name . '刪除成功');
        return redirect()->route('admin.categories')->withErrors($category->name . '刪除失败');
    }
}
