@extends('bootstrap')

@section('title')
    Agencija poy
@endsection

@section('navbar')
    @if(Auth::guest())
    <ul class="nav navbar-nav">
        <li><a href="{{url('#')}}">Pretrazi oglase</a> </li>
        <li><a href="{{url('ad/create')}}">Dodaj oglas</a></li>
        <li><a href="/search">Još oglasa</a></li>
    </ul>
    @else
        <ul class="nav navbar-nav">
            <li><a href="{{url('dashboard')}}">Dashboard</a></li>
        </ul>
    @endif
@endsection

@section('content')
    {{--Ovde idu oglasi--}}
@endsection