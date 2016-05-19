@extends('layouts.auth')

@section('title')
    Agencija poy
@endsection

@section('content')
    <div align="center">
    @if(Auth::guest())
        <a href="{{url('login')}}">Login</a>
        <a href="{{url('register')}}">Register</a>
    @else
        <h1>Dobro dosao {{Auth::user()->username}}</h1>
        <a href="{{url('dashboard')}}">Dashboard</a>
        <a href="{{url('logout')}}">Logout</a>
    @endif
    <a href="{{url('ad/create')}}">Dodaj oglas</a>
    </div>
@endsection