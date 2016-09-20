@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-default">
                <div class="widget-header">
                    <h3><i class="fa fa-file-image-o fa-fw"></i>图片({{ $image_count }})</h3>
                </div>
                <div class="widget-body">
                    <div class="col-md-12">
                        <form role="form" class="form-horizontal" action="{{ route('upload.image') }}"
                              datatype="image"
                              enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-group col-md-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-file-image-o  fa-fw"></i></span>
                                        <input class="form-control" accept="image/*" type="file" name="image">
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" class="btn btn-primary" style="margin-left: 5px">
                                        上传
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($images->chunk(3) as $chunk)
        <div class="row">
            @foreach ($chunk as $image)
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="widget widget-default">
                        <img src="{{ getUrlByFileName($image->key) }}" style="width: 100% ;height: 200px">
                        <div class="widget-footer">
                            <div class="widget-meta">
                                <button id="clipboard-btn" class="btn btn-default"
                                        type="button"
                                        data-clipboard-text="{{ getUrlByFileName($image->key) }}"
                                        data-toggle="tooltip"
                                        data-placement="left"
                                        title="Copied">
                                    <i class="fa fa-copy fa-fw"></i>
                                </button>
                                <button class="btn btn-danger"
                                        data-method="delete"
                                        data-modal-target="确定删除{{ $image->key }}吗?"
                                        data-url="{{ route('delete.file').'?key='.$image->key.'&type=image' }}"
                                        data-key="{{ $image->key }}">
                                    <i class="fa fa-trash-o fa-fw"></i>
                                </button>
                                {{ formatBytes($image->size) }}
                                <i class="fa fa-clock-o fa-fw"></i>
                                {{ $image->created_at->format('Y-m-d H:m') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
    @if($images->lastPage() > 1)
        <div class="row">
            <div class="col-md-12">
                {{ $images->links() }}
            </div>
        </div>
    @endif
@endsection
@section('script')
    <script src="//cdn.bootcss.com/clipboard.js/1.5.12/clipboard.min.js"></script>
    <script>
        new Clipboard('.btn');
        $('.btn').tooltip({
            trigger: 'click',
        });
    </script>
@endsection