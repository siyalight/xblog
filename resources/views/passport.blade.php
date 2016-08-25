@extends('layouts.app')
@section('content')
    <passport-clients></passport-clients>
    <passport-authorized-clients></passport-authorized-clients>
    <passport-personal-access-tokens></passport-personal-access-tokens>
@endsection
@section('script')
    <script src="js/app.js"></script>
@endsection