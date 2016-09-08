@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget widget-default">
                <div class="widget-body">
                    <table class="table table-hover table-bordered table-responsive">
                </div>
            </div>
            {{ $pages->links() }}
        </div>
    </div>
@endsection
