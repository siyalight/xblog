@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-default">
                <div class="widget-header">
                    <h3><i class="fa fa-file-image-o fa-fw"></i>图片</h3>
                </div>
            </div>
        </div>
        <div class="col-md-10 col-md-offset-2">
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
    <div class="row">
        @foreach($images as $image)
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
                                    data-toggle="modal"
                                    data-target="#delete-image-modal"
                                    data-url="{{ route('delete.image').'?key='.$image->key }}"
                                    data-key="{{ $image->key }}">
                                <i class="fa fa-trash-o fa-fw"></i>
                            </button>
                            {{ formatBytes($image->size) }}
                            -
                            {{ $image->created_at->format('Y-m-d H:m') }}
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
                    确定删除<p id="span-title"></p>吗?
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
    <script src="//cdn.bootcss.com/clipboard.js/1.5.12/clipboard.min.js"></script>
    <script>
        new Clipboard('.btn');
        $('.btn').tooltip({
            trigger:'click',
        });
        $('#delete-image-modal').on('show.bs.modal', function (e) {
            var url = $(e.relatedTarget).data('url');
            var key = $(e.relatedTarget).data('key');
            $('#span-title').text(key);
            $('#delete-form').attr('action', url);
        });
    </script>
@endsection