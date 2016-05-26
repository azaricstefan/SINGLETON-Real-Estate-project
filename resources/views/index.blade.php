@extends('layouts.bootstrap')

@section('title')
    Agencija za nekretnine
@endsection

@section('nav-bar')
    @if(Auth::guest())
    <ul class="nav navbar-nav">
        <li class="active"><a href="{{url('/')}}">Početna strana</a></li>
        <li><a href="{{url('search')}}">Pretraži oglase</a></li>
    </ul>
    @else
        <ul class="nav navbar-nav">
            <li class="active"><a href="{{url('/')}}">Početna strana</a></li>
            <li><a href="{{url('dashboard')}}">Dashboard</a></li>
            <li><a href="{{url('search')}}">Pretraži oglase</a></li>
        </ul>
    @endif
@endsection

@section('content')
    {{--TODO: DEFINISATI NEKU POCETNU STRANU--}}
    <p>Ovo je početna strana. Ovde idu neki oglasi i jos neke stvari.</p>
@endsection