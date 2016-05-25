@extends('layouts.bootstrap')

@section('title')
    Agencija za nekretnine
@endsection

@section('nav-bar')
    @if(Auth::guest())
    <ul class="nav navbar-nav">
        <li><a href="{{url('search')}}">Pretraži oglase</a> </li>
        <li><a href="{{url('ad/create')}}">Dodaj oglas</a></li>
    </ul>
    @else
        <ul class="nav navbar-nav">
            <li><a href="{{url('dashboard')}}">Dashboard</a></li>
            <li><a href="{{url('search')}}">Pretraži oglase</a> </li>
        </ul>
    @endif
@endsection

@section('content')
    {{--Ovde idu oglasi--}}
@endsection