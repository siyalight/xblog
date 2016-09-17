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
        <div class="col-md-10 col-md-offset-2">
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
    <div class="widget widget-default">
        <div class="widget-header">
            文件
        </div>
        <div class="widget-body">
            <table class="table table-hover table-bordered table-responsive">
                <tbody>
                @foreach($files as $file)
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
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script src="//cdn.bootcss.com/clipboard.js/1.5.12/clipboard.min.js"></script>
    <script>
        new Clipboard('.btn');
        $('.btn').tooltip({
            trigger:'click',
        });
    </script>
@endsection
