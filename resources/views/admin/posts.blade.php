@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-default">
                <table class="table table-hover table-bordered table-responsive" style="overflow: auto">
                    <thead>
                    <tr>
                        <th>标题</th>
                        <th>状态</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <?php
                        $class = '';
                        $status = 'Un published';
                        if ($post->trashed()) {
                            $class = 'danger';
                            $status = 'deleted';
                        } else if ($post->isPublished()) {
                            $class = 'success';
                            $status = 'published';
                        }
                        ?>


                        <tr class="{{ $class }}">
                            <td>{{ $post->title }}</td>
                            <td>{{ $status }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-default" data-toggle="modal" data-title="{{ $post->title }}"
                                            data-url="{{ route('post.destroy',$post->id) }}"
                                            data-target="#delete-post-modal">
                                        删除
                                    </button>
                                    <a {{ $post->trashed()?'disabled':'' }} href="{{ $post->trashed()?'#':route('post.edit',$post->id) }}"
                                       class="btn btn-default">
                                        编辑
                                    </a>
                                    @if($post->trashed())
                                        <a href="{{ route('post.restore',$post->id) }}"
                                           class="btn btn-default">
                                            恢复
                                        </a>
                                    @elseif($post->isPublished())
                                        <a href="{{ route('post.show',$post->slug) }}"
                                           class="btn btn-default">
                                            查看
                                        </a>
                                    @else
                                        <a href="{{ route('post.preview',$post->slug) }}"
                                           class="btn btn-default">
                                            预览
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $posts->links() }}
            </div>
        </div>
    </div>


    {{-- modal --}}
    <div class="modal fade" id="delete-post-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="redirect" value="/admin/posts">
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
        $('#delete-post-modal').on('show.bs.modal', function (e) {
            var url = $(e.relatedTarget).data('url');
            var title = $(e.relatedTarget).data('title');
            $('#span-title').text(title);
            $('#delete-form').attr('action', url);
        });
    </script>
@endsection