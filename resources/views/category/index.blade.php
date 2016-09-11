@extends('layouts.app')
@section('title','分类')
@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li class="active">Category</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            @include('widget.categories')
        </div>
    </div>
@endsection
