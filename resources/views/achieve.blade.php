@extends('layouts.app')
@section('title','项目')
@section('content')
    <style>
        .timeline-item {
            position: relative;
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px dashed #ccc;
            border-left: 2px solid #ccc;
        }
        .timeline-item-title {
            position: relative;
            margin-left: 60px;
            margin-bottom: 15px;
            padding: 10px;
        }
    </style>
    <div class="container">
        <div class="timeline">
            @foreach($posts as $post)
                <div class="timeline-item">
                    <i class="" style="width: 48px;height: 48px;background-color: #2b542c;border-radius: 50%">
                    </i>
                    <div class="timeline-item-title">
                        <a href="{{ route('post.show',$post->slug) }}">{{ $post->title }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection