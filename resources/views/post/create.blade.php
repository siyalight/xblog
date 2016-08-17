@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="widget widget-default">
                <form role="form" class="form-horizontal" action="{{ route('post.store') }}" method="post">
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-4 control-label">文章标题*</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}"
                                   autofocus>

                            @if ($errors->has('title'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-md-4 control-label">文章描述*</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}">

                            @if ($errors->has('description'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                        <label for="content" class="col-md-4 control-label">文章内容*</label>

                        <div class="col-md-6">
                            <textarea id="content" type="text" class="form-control" name="content">
                                {{ old('content') }}
                            </textarea>
                            @if ($errors->has('content'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="published">发布?
                                </label>
                            </div>
                        </div>
                    </div>

                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                创建
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection