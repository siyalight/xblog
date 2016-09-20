@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-default">
                <div class="widget-header">
                    <h3><i class="fa fa-file fa-fw"></i>文件</h3>
                </div>
                <div class="widget-body">
                    <div class="col-md-12">
                        <div class="col-sm-12">
                            <form role="form" class="form-horizontal" action="{{ route('upload.file') }}"
                                  datatype="image"
                                  enctype="multipart/form-data" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="type" value="js">
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <div class="input-group">
                                            <span class="input-group-addon">Js</span>
                                            <input class="form-control" type="file" name="file">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button type="submit" class="btn btn-primary" style="margin-left: 5px">
                                            上传
                                        </button>
                                    </div>
                                </div>
                            </form>



                            <form role="form" class="form-horizontal" action="{{ route('upload.file') }}"
                                  datatype="image"
                                  enctype="multipart/form-data" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="type" value="css">
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <div class="input-group">
                                            <span class="input-group-addon">Css</span>
                                            <input class="form-control" type="file" name="file">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button type="submit" class="btn btn-primary" style="margin-left: 5px">
                                            上传
                                        </button>
                                    </div>
                                </div>
                            </form>



                            <form role="form" class="form-horizontal" action="{{ route('upload.file') }}"
                                  datatype="image"
                                  enctype="multipart/form-data" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="type" value="font">
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <div class="input-group">
                                            <span class="input-group-addon">Font</span>
                                            <input class="form-control" type="file" name="file">
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
                                            data-method="delete"
                                            data-modal-target="{{ $file->key }}"
                                            data-url="{{ route('delete.file').'?key='.$file->key."&type=".$file->type }}">
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
        </div>
    </div>
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
