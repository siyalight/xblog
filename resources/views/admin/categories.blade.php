@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-default">
                <table class="table table-hover table-bordered table-responsive" style="overflow: auto">
                    <thead>
                    <tr>
                        <th>名称</th>
                        <th>日期</th>
                        <th>文章</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at->format('Y-m-d') }}</td>
                            <td>{{ $category->posts_count }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('category.edit',$category->id) }}" class="btn btn-default">
                                        编辑
                                    </a>
                                    <button class="btn btn-default" data-toggle="modal"
                                            data-title="{{ $category->name }}"
                                            data-url="{{ route('category.destroy',$category->id) }}"
                                            data-target="#delete-category-modal">
                                        删除
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="delete-category-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                        <button type="submit" class="btn btn-primary">确定</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('script')
    <script>
        $('#delete-category-modal').on('show.bs.modal', function (e) {
            var url = $(e.relatedTarget).data('url');
            var title = $(e.relatedTarget).data('title');
            $('#span-title').text(title);
            $('#delete-form').attr('action', url);
        });
    </script>
@endsection