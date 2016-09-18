@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-default">
                <div class="widget-header">
                    <h3><i class="fa fa-file fa-fw"></i>文件</h3>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-sm-12">
                <form role="form" class="form-horizontal" action="{{ route('upload.js') }}"
                      datatype="image"
                      enctype="multipart/form-data" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-md-10">
                            <div class="input-group">
                                <span class="input-group-addon">Js</span>
                                <input class="form-control" type="file" name="js">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <button type="submit" class="btn btn-primary" style="margin-left: 5px">
                                上传
                            </button>
                        </div>
                    </div>
                </form>
                <form role="form" class="form-horizontal" action="{{ route('upload.css') }}"
                      datatype="image"
                      enctype="multipart/form-data" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group col-md-10">
                            <div class="input-group">
                                <span class="input-group-addon">Css</span>
                                <input class="form-control" type="file" name="css">
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
    <div class="widget widget-default">
        <div class="widget-header">
            文件
        </div>
        <div class="widget-body">
            <table class="table table-hover table-bordered table-responsive">
                <tbody>
                @forelse($files as $file)
                    <tr>
                        <td>{{ $file->type }}</td>
                        <td>{{ getUrlByFileName($file->key) }}</td>
                        <td>
                            <button id="clipboard-btn" class="btn btn-default"
                                    type="button"
                                    data-clipboard-text="{{ getUrlByFileName($file->key) }}"
                                    data-toggle="tooltip"
                                    data-placement="left"
                                    title="Copied">
                                <i class="fa fa-copy fa-fw"></i>
                            </button>
                            <button class="btn btn-danger"
                                    data-toggle="modal"
                                    data-target="#delete-file-modal"
                                    data-url="{{ route('delete.file').'?key='.$file->key."&type=".$file->type }}"
                                    data-key="{{ $file->key }}">
                                <i class="fa fa-trash-o fa-fw"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
    </div>


    {{-- modal --}}
    <div class="modal fade" id="delete-file-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">删除</h4>
                </div>
                <div class="modal-body">
                    确定删除<span id="span-title"></span>吗?
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
            trigger: 'click',
        });
        $('#delete-file-modal').on('show.bs.modal', function (e) {
            var url = $(e.relatedTarget).data('url');
            var key = $(e.relatedTarget).data('key');
            $('#span-title').text(key);
            $('#delete-form').attr('action', url);
        });
    </script>
@endsection
