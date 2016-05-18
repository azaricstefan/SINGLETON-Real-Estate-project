@extends('layouts.auth')

@section('title')
    Stranica za admine
@endsection

@section('content')
    <h1>Ovo je stranica za admine, dobrodosao {{Auth::user()->username}}</h1>
@endsection