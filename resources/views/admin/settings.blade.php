@extends('admin.layouts.app')
@section('title','文章')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-default">
                <div class="widget-header">
                    <h3>设置</h3>
                </div>
                <div class="widget-body">
                    <form role="form" class="form-horizontal" action="{{ route('admin.save-settings') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">标题</div>
                                <input class="form-control" type="text" name="title" value="{{ $title or ''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">描述</div>
                                <input class="form-control" type="text" name="description" value="{{ $description or ''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">头像</div>
                                <input class="form-control" type="text" name="avatar" value="{{ $avatar or ''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">简介图片</div>
                                <input class="form-control" type="text" name="profile_image" value="{{ $profile_image or ''}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    保存
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
