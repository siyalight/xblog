@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form role="form" class="form-horizontal" action="{{ route('admin.upload.image') }}"
                  enctype="multipart/form-data" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-md-8">
                        <div class="input-group">
                            <span class="input-group-addon">图片</span>
                            <input class="form-control" type="file" name="image">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                上传
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="row">
        @foreach($images as $image)
            <div class="col-lg-4 col-md-4">
                <div class="widget widget-default">
                    <img src="{{ $image->value }}" style="width: 100%" height="200px">
                    <div class="widget-footer">
                        <pre>{{ asset($image->value) }}</pre>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            {{ $images->links() }}
        </div>
    </div>
@endsection