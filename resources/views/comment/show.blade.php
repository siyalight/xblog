@forelse($comments as $comment)
    <div class="" style="margin: 5px 0 25px 0">
        <div class="pull-left">
            <?php
            $href = $comment->user ? route('user.show', $comment->username) : 'javascript:void(0);';
            ?>
            <a name="{{$loop->index}}" href="{{ $href }}">
                <img width="48px" height="48px" class="img-circle"
                     src="{{ $comment->user ? $comment->user->avatar :'https://static.lufficc.com/image/default_avatar.png' }}">
            </a>
        </div>
        <div class="comment-info" style="margin-left: 66px">
            <div style="font-size: 1.2em">
                <a href="{{ $href }}">{{ $comment->username }}</a>
                <span class="pull-right" style="color: #d0d0d0">
                    @can('manager',$comment)
                        <a href="javascript:void (0)" data-method="delete" data-modal-target="这条评论"
                           data-url="{{ route('comment.destroy',$comment->id) }}">
                            <i class="fa fa-trash-o fa-fw"></i>
                        </a>
                        <a style="text-decoration: none" href="{{ route('comment.edit',[$comment->id,'redirect'=>(isset($redirect) && $redirect.'#'.$loop->index ? $redirect : '')]) }}">
                            <i class="fa fa-pencil fa-fw"></i>
                        </a>
                    @endcan
                    <a href="javascript:void (0);" onclick="replySomeone('{{ $comment->username }}')">
                        <i class="fa fa-reply fa-fw"></i>
                    </a>
            </span>
            </div>
            <div style="font-size: 0.9em;color: #d0d0d0">
                <span>{{ $comment->created_at->format('Y/m/d H:m') }}</span>
            </div>

            <div class="markdown-content">
                <p>{!! $comment->html_content !!}</p>
            </div>
        </div>
        <div class="alone-divider"></div>
    </div>
@empty
    <p class="meta-item center-block">暂无评论~~</p>
@endforelse