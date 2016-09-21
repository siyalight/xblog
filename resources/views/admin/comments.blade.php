@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-default">
                <div class="widget-header">
                    <h3><i class="fa fa-comments fa-fw"></i>评论</h3>
                </div>
                <div class="widget-body">
                    <table class="table table-hover table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>用户</th>
                            <th>commentable_id</th>
                            <th>类型</th>
                            <th>内容</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr class="{{ $comment->trashed() ? 'danger':'' }}">
                                <td>
                                    @if($comment->user_id)
                                        <a href="{{ route('user.show',$comment->username) }}">{{ $comment->username }}</a>
                                    @else
                                        {{ $comment->username }}
                                    @endif
                                </td>
                                <td>{{ $comment->commentable_id }}</td>
                                <td>{{ $comment->commentable_type }}</td>
                                <td data-toggle="tooltip" data-placement="top"
                                    title="{{ $comment->content }}">{!! $comment->html_content !!}</td>
                                <td>
                                    <button type="submit"
                                            class="btn btn-danger"
                                            data-modal-target="这条评论"
                                            data-url="{{ route('comment.destroy',$comment->id) }}"
                                            data-method="delete"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="删除">
                                        <i class="fa fa-trash-o fa-fw"></i>
                                    </button>
                                    <a class="btn btn-info"
                                       href="{{ route('comment.edit',[$comment->id,'redirect'=>request()->fullUrl()]) }}">
                                        <i class="fa fa-pencil fa-fw"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
