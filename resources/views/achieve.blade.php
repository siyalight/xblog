@extends('layouts.app')
@section('title','项目')
@section('content')
    <style>
        .timeline-item {
            position: relative;
            margin-bottom: 15px;
            padding: 10px;
            list-style: none;
        }

        .timeline-item-title {
            position: relative;
            color: #303030;
            font-size: 1.35em;
            margin-bottom: 15px;
        }

        .timeline-item-time {
            text-align: left;
            font-size: 0.8em;
            margin-right: 15px;
            color: #888;
        }

        .timeline-item-title a {
            color: #303030;
            padding: 30px;
            text-decoration: none;
            transition: all 0.25s ease-in-out;
            -webkit-transition: all 0.25s ease-in-out;
        }

        .timeline-item-title a:hover {
            color: red;
        }
    </style>
    <div class="container">
        <div class="widget widget-default">
            <div class="widget-body">
                <ul class="timeline">
                    @foreach($posts as $post)
                        <li class="timeline-item">
                            <div class="row">
                                <div class="col-xs-2">
                                    <span class="timeline-item-time">
                                        <i class="fa fa-clock-o fa-fw"></i>{{ $post->created_at->format('y/m/d H:i') }}
                                    </span>
                                </div>
                                <div class="col-xs-10">
                                    <div class="timeline-item-title">
                                        <a href="{{ route('post.show',$post->slug) }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    {{ $posts->links() }}
                </ul>
            </div>
        </div>
    </div>
@endsection