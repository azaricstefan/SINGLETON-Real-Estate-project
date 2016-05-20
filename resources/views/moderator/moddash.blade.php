@extends('bootstrap')

@section('title')
    Administrator
@endsection

@section('content')
    @if(session()->has('flash_message'))
        <div style='width:200px; background-color: #00b3ee; text-align: center'>
            {{session('flash_message')}}
        </div>
    @endif
    <div class="navbar-header">
        <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <div class="nav navbar-nav">
        <a href="/moderator/new_ads" class="">Novi oglasi <span class="badge"> {{$newAdCount}}</span></a>
        <a href="/moderator/reported_comments" class="">Prijavljeni Komentari<span class="badge" >{{$reportedCommentCount}}</span></a><br/>
        <a href="{{url('appointments/pending')}}">Novi zakazani termini</a><br/>
        <a href="{{url('appointments/my_appointments')}}">Moji termini</a><br/>
        <a href="/users">Pretraga korisnika</a>
    </div>
@endsection