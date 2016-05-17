@extends('layouts.auth')

@section('title')
    Agencija poy
@endsection

@section('content')
    @if(Auth::guest())
        <a href="{{url('login')}}">Login</a>
        <a href="{{url('register')}}">Register</a>
    @else
        <h1>Dobro dosao {{Auth::user()->username}}</h1>
        <a href="{{url('dashboard')}}">Dashboard</a>
        <a href="{{url('logout')}}">Logout</a>
    @endif
@endsection