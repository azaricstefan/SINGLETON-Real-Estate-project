@extends('layouts.auth')

@section('title')
    Administrator
@endsection

@section('content')
    @if(session()->has('flash_message'))
        <div style='width:200px; background-color: #00b3ee; text-align: center'>
            {{session('flash_message')}}
        </div>
    @endif
    <a href="/moderator/new_ads">Novi oglasi({{$newAdCount}})</a>

@endsection