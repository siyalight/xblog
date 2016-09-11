@extends('layouts.app')
@section('title','标签')
@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li class="active">Tag</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            @include('widget.tags')
        </div>
    </div>
@endsection
