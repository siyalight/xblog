<div class="widget widget-default">
    <div class="widget-header">分类</div>
    <ul class="list-group">
        @foreach($categories as $category)
            @if(str_contains(request()->getPathInfo(),'category/'.$category->name))
                <li href="{{ route('category.show',$category->name) }}"
                   class="list-group-item active">
                    {{ $category->name }}
                    <span class="badge">{{ $category->posts()->count() }}</span>
                </li>
            @else
                <a href="{{ route('category.show',$category->name) }}"
                   class="list-group-item">
                    {{ $category->name }}
                    <span class="badge">{{ $category->posts()->count() }}</span>
                </a>
            @endif

        @endforeach
    </ul>
</div>