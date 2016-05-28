@extends('layouts.bootstrap')

@section('title')
    Agencija za nekretnine
@endsection

@section('nav-bar')
    @if(Auth::guest())
        <ul class="nav navbar-nav">
            <li><a href="{{url('/')}}">Početna strana</a></li>
            <li><a href="{{url('search')}}">Pretraži oglase</a></li>
            <li><a href="{{url('ad/create')}}">Dodaj oglas</a></li>
            <li class="active"><a href="{{url('about')}}">Informacija o nama</a></li>
            {{--TODO: DODATI STRANICU SA INFORMACIJAMA O AGENCIJI--}}
        </ul>
    @else
        <ul class="nav navbar-nav">
            <li><a href="{{url('/')}}">Početna strana</a></li>
            <li><a href="{{url('dashboard')}}">Dashboard</a></li>
            <li><a href="{{url('search')}}">Pretraži oglase</a></li>
            <li class="active"><a href="{{url('about')}}">Informacija o nama</a></li>
        </ul>
    @endif
@endsection

@section('content')
    {{--TODO: DEFINISATI NEKU POCETNU STRANU--}}
    <div align="center">
        <img src="/us/ja.png" alt="Mihailo" class="img-rounded" width="300px">
        <img src="/us/nenad.jpg" alt="Nenad" class="img-rounded" width="300px">
        <img src="/us/smiljan.jpg" alt="Smiljan" class="img-rounded" width="300px">
        <img src="/us/stefan.jpg" alt="Stefan" class="img-rounded" width="300px">
    </div>
@endsection