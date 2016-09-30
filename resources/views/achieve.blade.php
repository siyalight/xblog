@extends('layouts.app')
@section('title','项目')
@section('content')
    <div class="container">
        <div id="cd-timeline" class="cd-container">
            @foreach($posts as $post)
                <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-picture">
                    </div>
                    <div class="cd-timeline-content">
                        <a href="{{ route('post.show',$post->slug) }}" target="_blank">
                            <div class="title">{{ $post->title }}</div>
                        </a>
                        <span class="cd-date">{{ $post->created_at->format('Y-m-d') }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection