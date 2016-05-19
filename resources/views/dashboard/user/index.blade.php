@extends('dashboard.layout')

@section('content')
    <div align="center">
    <h1>Dashboard {{Auth::user()->username}}</h1>
    <a href="{{url('myads')}}">Moji oglasi</a>
    <a href="/">Nazad na pocetnu</a>
    <a href="{{url('appointments/my_appointments')}}">Moji termini</a>
    </div>
@endsection