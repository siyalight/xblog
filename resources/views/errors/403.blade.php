@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="widget widget-default">
                <h1>403,Unauthorized</h1>
            </div>
        </div>
        <div class="col-md-4">
            @include('widget.user')
        </div>
    </div>
@endsection
