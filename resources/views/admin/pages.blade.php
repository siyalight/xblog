@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-default">
                <table class="table table-hover table-bordered table-responsive" style="overflow: auto">
                    <thead>
                    <tr>
                        <th>名称</th>
                        <th>url</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td>{{ $page->display_name }}</td>
                            <td>/{{ $page->name }}</td>
                            <td>
                                <div class="btn-group">

                                    <a href="{{ route('page.edit',$page->id) }}"
                                       class="btn btn-default">
                                        编辑
                                    </a>
                                    <a href="{{ route('page.show',$page->name) }}"
                                       class="btn btn-default">
                                        查看
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
