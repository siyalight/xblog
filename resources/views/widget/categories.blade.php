<div class="widget widget-default">
    <div class="widget-header"><h4>分类</h4></div>
    <ul class="widget-body list-group">
        @foreach($categories as $category)
            @if(str_contains(urldecode(request()->getPathInfo()),'category/'.$category->name))
                <li href="{{ route('category.show',$category->name) }}"
                    class="list-group-item active">
                    {{ $category->name }}
                    <span class="badge">{{ $category->posts_count }}</span>
                </li>
            @else
                <a href="{{ route('category.show',$category->name) }}"
                   class="list-group-item">
                    {{ $category->name }}
                    <span class="badge">{{ $category->posts_count }}</span>
                </a>
            @endif

        @endforeach
    </ul>
</div>