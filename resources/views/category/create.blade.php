@extends('layouts.app')
@section('content')
    <div class="widget widget-default">
        <div class="container">
            <div class="box box-primary box-solid">
                <div class="box-header">创建一个新的分类</div>
                <div class="box-body">
                    <form class="form-vertical" action="{{ route('category.store') }}" method="post">
                        <div class="input-group">
                            <span class="input-group-addon">名字*</span>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">描述*</span>
                            <input type="text" name="description" class="form-control" id="description"/>
                        </div>
                        <br>
                        {{ csrf_field() }}
                        <div class="input-group">
                            <button type="submit" class="btn btn-success">创建</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection