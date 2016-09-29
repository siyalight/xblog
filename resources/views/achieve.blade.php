@extends('layouts.app')
@section('title','项目')
@section('content')
    <style>
        .timeline-item {
            position: relative;
            margin-bottom: 15px;
            padding: 5px;
            list-style: none;
            border-bottom: 1px dashed #ccc;
        }

        .timeline-item-title {
            position: relative;
            font-size: 1.35em;
            margin-bottom: 15px;
        }
    </style>
    <div class="container">
        <div class="widget widget-default">
            <div class="widget-body">
                <ul class="timeline">
                    @foreach($posts as $post)
                        <li class="timeline-item">
                            <div class="timeline-item-title">
                                <a href="{{ route('post.show',$post->slug) }}">{{ $post->title }}</a>
                            </div>
                        </li>
                    @endforeach
                    {{ $posts->links() }}
                </ul>
            </div>
        </div>
    </div>
@endsection