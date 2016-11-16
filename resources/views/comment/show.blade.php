@forelse($comments as $comment)
    <div class="comment-wrap">
        <div class="pull-left">
            <?php
            $href = $comment->user_id ? route('user.show', $comment->username) : 'javascript:void(0);';
            $imgSrc = $comment->user ? $comment->user->avatar : config('app.avatar');
            $imgSrc = processImageViewUrl($imgSrc, 40, 40);
            ?>
            <a name="comment{{ $loop->index + 1 }}" href="{{ $href }}">
                <img width="40px" height="40px" class="img-circle"
                     src="{{ $imgSrc }}">
            </a>
        </div>
        <div class="comment-info">
            <div class="comment-head">
                <span class="name">
                    <a href="{{ $href }}">{{ $comment->username }}</a>
                    @if(isAdminById($comment->user_id))
                        <label class="role-label">博主</label>
                    @endif
                </span>
                <span class="comment-operation pull-right">
                    @can('manager',$comment)
                        <a href="javascript:void (0)" data-method="delete" data-modal-target="这条评论"
                           data-url="{{ route('comment.destroy',$comment->id) }}">
                            <i class="fa fa-trash-o fa-fw"></i>
                        </a>
                        <a style="text-decoration: none"
                           href="{{ route('comment.edit',[$comment->id,'redirect'=>(isset($redirect) && $redirect.'#'.$loop->index ? $redirect : '')]) }}">
                            <i class="fa fa-pencil fa-fw"></i>
                        </a>
                    @endcan
                    <a href="javascript:void (0);" onclick="replySomeone('{{ $comment->username }}')">
                        <i class="fa fa-reply fa-fw"></i>
                    </a>
            </span>
            </div>
            <div class="comment-time">
                <span>{{ $comment->created_at->format('Y/m/d H:i') }}</span>
            </div>
            <div class="markdown-content">
                {!! $comment->html_content !!}
            </div>
        </div>
    </div>
@empty
    <p class="meta-item center-block">暂无评论~~</p>
@endforelse
