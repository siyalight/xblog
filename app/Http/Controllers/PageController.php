<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:pages',
            'display_name'=>'required',
            'content'=>'required',
        ]);

        $page = Page::create($request->all());
        if($page) {
            return redirect()->route('admin.index')->with('success', '页面' . $request['name'] . '创建成功');
        }
        return redirect()->back()->withInput()->with('error', '页面' . $request['name'] . '创建失败');
    }

    /**
     * Display the specified resource.
     *
     * @param $name
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show($name)
    {

        $page  = Page::where('name',$name)->first();
        if(!$page)
            abort(404);
        return view('page.show',compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Page $page
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Page $page)
    {
        return view('page.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Page $page
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Page $page)
    {
        $this->validate($request,[
            'name'=>'required',
            'display_name'=>'required',
            'content'=>'required',
        ]);
        if($page->update($request->all())) {
            return redirect()->route('admin.index')->with('success', '页面' . $request['name'] . '修改成功');
        }
        return redirect()->back()->withInput()->with('error', '页面' . $request['name'] . '修改失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
