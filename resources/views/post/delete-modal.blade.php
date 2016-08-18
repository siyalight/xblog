<div class="modal fade" id="delete-post-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">删除</h4>
            </div>
            <div class="modal-body">
                确定删除{{ $post->title }}吗?
            </div>
            <div class="modal-footer">
                <form method="post" action="{{ route('post.destroy',$post->id) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="delete">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">确定</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->