@extends('layouts.dashboard')

@section('title')
    Dashboard {{Auth::user()->username}}
@endsection

@section('headScript')
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
@endsection


@section('nav-bar')
        <ul class="nav navbar-nav">
                <li><a href="{{url('/')}}">Početna strana</a></li>
                <li class="active"><a href="{{url('dashboard/admin')}}">Dashboard</a></li>
                <li><a href="{{url('search')}}">Pretraži oglase</a></li>
                <li><a href="{{url('about')}}">Informacija o nama</a></li>
        </ul>
@endsection

@section('dash-nav')
    <a href="{{url('myads')}}" class="list-group-item" id="my_ads">Moji oglasi</a>
    <a href="{{url('ad/create')}}" class="list-group-item" id="ad_create">Dodaj oglas</a>
    <a href="{{url('appointments/my_appointments')}}" class="list-group-item" id="appointments_my_appointments" >Moji termini</a>
    <a href="{{url('user/updateProfile')}}" class="list-group-item" id="update_profile">Podešavanje profila</a>
    <a href="/" class="list-group-item" >Nazad na početnu</a>
@endsection