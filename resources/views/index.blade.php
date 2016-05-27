@extends('layouts.bootstrap')

@section('title')
    Agencija za nekretnine
@endsection

@section('nav-bar')
    @if(Auth::guest())
    <ul class="nav navbar-nav">
        <li class="active"><a href="{{url('/')}}">Početna strana</a></li>
        <li><a href="{{url('search')}}">Pretraži oglase</a></li>
        <li><a href="{{url('ad/create')}}">Dodaj oglas</a></li>
        <li><a href="{{url('about')}}">Informacija o nama</a></li>
        {{--TODO: DODATI STRANICU SA INFORMACIJAMA O AGENCIJI--}}
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
    @if($ads->count() != 0)
        @foreach($ads as $ad)
            <a href="/ads/{{$ad->ad_id}}"><img src="{{$ad->images()->first()->image_path}}" alt=""></a>
            <h3>{{$ad->getName()}}</h3>
            <p>{{$ad->description}}</p>
        @endforeach
    @else
        <img src="logo.jpg"/>
        <p>Nema oglasa</p>
    @endif
@endsection