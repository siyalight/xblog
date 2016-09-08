@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="widget widget-default">
                <div class="widget-body">
                    <a class="btn pull-right" role="button" data-toggle="modal" data-target="#add-tag-modal">
                        <i class="fa fa-tag"></i>
                    </a>
                    <table class="table table-hover table-bordered table-responsive" style="overflow: auto">
                        <thead>
                        <tr>
                            <th>名称</th>
                            <th>文章</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td>{{ $tag->name }}</td>
                                <td>{{ $tag->posts_count }}</td>
                                <td>
                                    <form style="display: inline" method="post"
                                          action="{{ route('tag.destroy',$tag->id) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <button type="submit" class="btn btn-default">
                                            刪除
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- modal --}}
    <div class="modal fade" id="add-tag-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <form role="form" class="form-horizontal" action="{{ route('tag.store') }}" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">新的Tag</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Tag名称</label>
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control" name="name" autofocus>
                            </div>
                        </div>
                        {{ csrf_field() }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button id="confirm-btn" type="submit" class="btn btn-primary">确定</button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
