@extends('layouts.app')
@section('title','博客')
@section('content')
    <div class="row">
        <div class="col-md-8">
            {{ $user->name }}
        </div>
        <div class="col-md-4">
            <div class="slide">
                @include('layouts.widgets')
            </div>
        </div>
    </div>
@endsection
