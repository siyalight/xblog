@extends('admin.layouts.app')
@section('title','评论')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-default">
                <div class="widget-header">
                    <h6><i class="fa fa-comments fa-fw"></i>评论</h6>
                </div>
                <div class="widget-body">
                    @if($comments->isEmpty())
                        <h3 class="center-block meta-item">No Comments</h3>
                    @else
                        <table class="table table-striped table-hover table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th>用户</th>
                                <th>Email</th>
                                <th>地址</th>
                                <th>内容</th>
                                <th>IP</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)

                                <?php $commentableData = $comment->getCommentableData();?>

                                <tr class="{{ $comment->trashed() ? 'danger':'' }}">
                                    <td>
                                        @if($comment->user_id)
                                            <a href="{{ route('user.show',$comment->username) }}">{{ $comment->username }}</a>
                                        @else
                                            {{ $comment->username }}
                                        @endif
                                    </td>
                                    <td><a href="mailto:{{ $comment->email }}">{{ $comment->email }}</a></td>
                                    <td>
                                        @if($commentableData['deleted'])
                                            {{ $commentableData['type'] }} Deleted
                                        @else
                                            @if($comment->trashed())
                                                {{ $commentableData['title'] }}
                                            @else
                                                <a target="_blank"
                                                   href="{{ $commentableData['url'] }}">{{$commentableData['title'] }}
                                                </a>
                                            @endif
                                        @endif
                                    </td>
                                    <td data-toggle="tooltip" data-placement="top"
                                        title="{{ $comment->content }}">{!! $comment->html_content !!}</td>
                                    <td>{{ $comment->ip_id?$comment->ip_id:'NONE' }}</td>
                                    <td>
                                        @if($comment->trashed())
                                            <button type="submit"
                                                    class="btn btn-danger swal-dialog-target"
                                                    data-dialog-msg="永久删除这条评论？"
                                                    data-url="{{ route('comment.destroy',[$comment->id,'force'=>'true']) }}"
                                                    data-method="delete"
                                                    data-placement="top"
                                                    title="永久删除">
                                                <i class="fa fa-trash-o fa-fw"></i>
                                            </button>
                                            <form style="display: inline-block" method="post"
                                                  action="{{ route('comment.restore',$comment->id) }}">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-primary"
                                                        data-toggle="tooltip" data-placement="top" title="恢复">
                                                    <i class="fa fa-repeat fa-fw"></i>
                                                </button>
                                            </form>

                                        @else
                                            <button type="submit"
                                                    class="btn btn-danger swal-dialog-target"
                                                    data-dialog-msg="确定删除此评论？"
                                                    data-url="{{ route('comment.destroy',$comment->id) }}"
                                                    title="删除">
                                                <i class="fa fa-trash-o fa-fw"></i>
                                            </button>
                                            <a class="btn btn-info"
                                               href="{{ route('comment.edit',[$comment->id,'redirect'=>request()->fullUrl()]) }}">
                                                <i class="fa fa-pencil fa-fw"></i>
                                            </a>
                                        @endif
                                        @if($comment->ip == null)
                                            <button disabled
                                                    class="btn btn-default"
                                                    title="NO IP">
                                                <i class="fa fa-close fa-fw"></i>
                                            </button>
                                        @else
                                            <button class="btn swal-dialog-target {{ $comment->ip->blocked?' btn-danger':' btn-default' }}"
                                                    data-dialog-msg="{{ $comment->ip->blocked?'取消阻塞':'阻塞' }} IP {{ $comment->ip->id }} ?{{ $comment->ip->blocked?'':' 阻塞后此IP将不能访问你的网站' }}"
                                                    data-url="{{ route('ip.block',$comment->ip->id) }}"
                                                    title="{{ $comment->ip->blocked?'Un Block':'Block' }}">
                                                <i class="fa {{ $comment->ip->blocked?'fa-check':'fa-close' }} fa-fw"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if($comments->lastPage() > 1)
                            {{ $comments->links() }}
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
