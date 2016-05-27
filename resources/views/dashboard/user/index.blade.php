@extends('dashboard.user.userdash')

@section('nav-bar-header')
    @if(Auth::guest())
        <ul class="nav navbar-nav">
            <li><a href="{{url('/')}}">Početna strana</a></li>
            <li><a href="{{url('search')}}">Pretraži oglase</a></li>
        </ul>
    @else
        <ul class="nav navbar-nav">
            <li><a href="{{url('/')}}">Početna strana</a></li>
            <li class="active"><a href="{{url('dashboard/admin')}}">Dashboard</a></li>
            <li><a href="{{url('search')}}">Pretraži oglase</a></li>
        </ul>
    @endif
@endsection

@section('headScript')
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('dash-content')
    {{--TODO neki oglasi--}}
@endsection