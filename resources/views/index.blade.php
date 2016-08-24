@extends('layouts.app')
@section('title','文章')
@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('widget.user')
            {{--@include('widget.categories')--}}
            <categories>
            </categories>
        </div>
        <div class="col-md-8">
            <posts :category="post_list" :page="page">
            </posts>
        </div>
    </div>
@endsection
@section('script')
    <script src="js/app.js"></script>
@endsection