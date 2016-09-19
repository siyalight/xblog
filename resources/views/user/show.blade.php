@extends('layouts.app')
@section('title','博客')
@section('content')
    <div class="widget widget-user" style="overflow: hidden">
        <?php
        if ($user->profile_image)
            $style = "background: url($user->profile_image) center center;";
        else
            $style = "background-color: #1b6d85;";
        ?>
        <div class="widget-user-header" style="{{ $style }}">
            <h3 class="widget-user-username">{{ $user->name }}</h3>
            <h5 class="widget-user-desc">{{ $user->description or 'No description'}}</h5>
        </div>
        <div class="widget-user-image" id="upload-avatar">
            <img style="background-color: #1b6d85" class="img-circle" src="{{ $user->avatar  }}" alt="User Avatar">
        </div>
        <div class="widget-user-body">
            @can('manager',$user)
                @include('user.show_owner',$user)
            @else
                @include('user.show_visiter',$user)
            @endcan
        </div>
    </div>
@endsection
