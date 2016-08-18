@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-default">
                <table class="table table-striped table-bordered table-responsive" style="overflow: auto">
                    <thead>
                    <tr>
                        <th>标题</th>
                        <th>Slug</th>
                        <th>日期</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn">
                                        删除
                                    </button>
                                    <button class="btn">
                                        编辑
                                    </button>
                                    <a  href="{{ route('post.show',$post->slug) }}" class="btn btn-default">
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