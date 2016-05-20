@extends('bootstrap')

@section('content')
    <div align="center">
    <h1>Dashboard {{Auth::user()->username}}</h1>
        <div class="btn-group">
            <a href="{{url('myads')}}" class="btn btn-primary" role="button">Moji oglasi</a>
            <a href="/" class="btn btn-primary" role="button">Nazad na pocetnu</a>
            <a href="{{url('appointments/my_appointments')}}" class="btn btn-primary" role="button">Moji termini</a>
        </div>
    </div>
@endsection