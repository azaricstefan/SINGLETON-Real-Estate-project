@extends('layouts.dashboard')

@section('title')
    Dashboard {{Auth::user()->username}}
@endsection

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


@section('dash-nav')
    <a href="{{url('myads')}}" class="list-group-item" id="my_ads">Moji oglasi</a>
    <a href="{{url('ad/create')}}" class="list-group-item" id="ad_create">Dodaj oglas</a>
    <a href="{{url('appointments/my_appointments')}}" class="list-group-item" id="appointments_my_appointments" >Moji termini</a>
    <a href="{{url('user/updateProfile')}}" class="list-group-item" id="update_profile">Podešavanje profila</a>
    <a href="/" class="list-group-item" >Nazad na početnu</a>
@endsection