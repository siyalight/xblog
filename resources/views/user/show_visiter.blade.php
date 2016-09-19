<div>
    <div class="form-group">
        <label>名称：</label>
        <span>{{ $user->name }}</span>
    </div>
    <div class="form-group">
        <label>描述：</label>
        <span>{{ $user->description }}</span>
    </div>
    <div class="form-group">
        <label>个人网站：</label>
        <span>{{ $user->website }}</span>
    </div>
    @if($user->meta)
        @foreach($user->meta as $key=>$value)
            <div class="form-group">
                <label>{{ ucfirst($key) }}：</label>
                <span>{{ $value }}</span>
            </div>
        @endforeach
    @endif
</div>