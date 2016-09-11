@extends('layouts.app')
@section('title','分类')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('widget.categories')
        </div>
    </div>
@endsection
