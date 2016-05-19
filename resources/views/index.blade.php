@extends('layouts.auth')

@section('title')
    Agencija poy
@endsection

@section('content')
    @if(Auth::guest())
        <a href="{{url('login')}}">Login</a>
        <a href="{{url('register')}}">Register</a>
    @else
        <h1>Dobro došao {{Auth::user()->fullname}}</h1>
        <ul>
            <li><a href="{{url('dashboard')}}">Dashboard</a></li>
            <li><a href="{{url('user/updateProfile')}}">Izmeni profil</a></li>
            <li><a href="{{url('logout')}}">Logout</a></li>
        </ul>
    @endif
    <a href="{{url('ad/create')}}">Dodaj oglas</a>
@endsection