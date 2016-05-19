@extends('dashboard.layout')

@section('content')
    <h1>Dashboard {{Auth::user()->username}}</h1>
    <a href="{{url('myads')}}">Moji oglasi</a>
    <a href="/">Nazad na pocetnu</a>
    <a href="{{url('appointments/all7days')}}">Zakaži Termin</a>
@endsection