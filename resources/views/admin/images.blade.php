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
                        <div class="widget-meta">
                            <button class="btn btn-default"
                                    data-toggle="popover"
                                    data-title="地址"
                                    data-placement="left"
                                    data-content="{{ asset($image->value) }}">
                                <i class="fa fa-copy fa-fw"></i>
                            </button>
                            <button class="btn btn-danger"
                                    data-toggle="modal"
                                    data-target="#delete-image-modal"
                                    data-url="{{ route('admin.delete.image').'?key='.$image->key }}"
                                    data-key="{{ $image->key }}">
                                <i class="fa fa-trash-o fa-fw"></i>
                            </button>
                        </div>
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

    {{-- modal --}}
    <div class="modal fade" id="delete-image-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">删除</h4>
                </div>
                <div class="modal-body">
                    确定删除<strong style="color: red" id="span-title"></strong>吗?
                </div>
                <div class="modal-footer">
                    <form id="delete-form" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        {{ csrf_field() }}
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-danger">确定</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('script')
    <script>
        $('#delete-image-modal').on('show.bs.modal', function (e) {
            var url = $(e.relatedTarget).data('url');
            var key = $(e.relatedTarget).data('key');
            $('#span-title').text(key);
            $('#delete-form').attr('action', url);
        });
    </script>
@endsection