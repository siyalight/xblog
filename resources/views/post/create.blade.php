@extends('layouts.app')
@section('css')
    <link href="http://cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-default">
                <form role="form" class="form-horizontal" action="{{ route('post.store') }}" method="post">
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="control-label">文章标题*</label>

                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}"
                               autofocus>

                        @if ($errors->has('title'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="control-label">文章描述*</label>

                        <input id="description" type="text" class="form-control" name="description"
                               value="{{ old('description') }}">

                        @if ($errors->has('description'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                        <label for="categories" class="control-label">文章分类*</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $category)
                                @if(old('category_id',-1) == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>

                        @if ($errors->has('description'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('tags[]') ? ' has-error' : '' }}">
                        <label for="tags[]" class="control-label">文章标签*</label>
                        <select id="post-tags" name="tags[]" class="form-control" multiple>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('tags[]'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('tags[]') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                        <label for="content" class="control-label">文章内容*</label>

                        <textarea id="content" type="text" class="form-control" name="content"
                                  rows="26">{{ old('content') }}</textarea>
                        @if ($errors->has('content'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input value="false" type="checkbox" name="published">发布?
                            </label>
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

@section('script')
    <script src="http://cdn.bootcss.com/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $("#post-tags").select2({
            tags: true
        })
    </script>
@endsection