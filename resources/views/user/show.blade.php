@extends('layouts.app')
@section('title','博客')
@section('content')
    <div class="widget widget-default">
        <div class="widget-header">
            <h3>{{ $user->name }}</h3>
        </div>
        <div class="widget-body">
            <h3>{{ $user->name }}</h3>
        </div>
    </div>
@endsection
