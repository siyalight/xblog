<div class="widget widget-default">
    <div class="widget-header"><h4><i class="fa fa-tags fa-fw"></i>标签</h4></div>
    <ul class="widget-body">
        <div class="tag-list">
            @foreach($tags as $tag)
                @if(str_contains(urldecode(request()->getPathInfo()),'tag/'.$tag->name))
                    <span class="tag tag-active">
                        {{ $tag->name }}
                        <span class="badge badge-active">{{ $tag->posts_count }}</span>
                    </span>
                @else
                    <a href="{{ route('tag.show',$tag->name) }}" class="tag">
                        {{ $tag->name }}
                        <span class="badge">{{ $tag->posts_count }}</span>
                    </a>
                @endif
            @endforeach
        </div>
    </ul>
</div>