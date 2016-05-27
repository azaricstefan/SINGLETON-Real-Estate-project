@extends('layouts.dashboard')

@section('title')
    Moderator
@endsection


@section('nav-bar-header')
    @if(Auth::guest())
        <ul class="nav navbar-nav">
            <li><a href="{{url('/')}}">Početna strana</a></li>
            <li><a href="{{url('search')}}">Pretraži oglase</a></li>
        </ul>
    @else
        <ul class="nav navbar-nav">
            <li><a href="{{url('/')}}">Početna strana</a></li>
            <li class="active"><a href="{{url('dashboard/moderator')}}">Dashboard</a></li>
            <li><a href="{{url('search')}}">Pretraži oglase</a></li>
        </ul>
    @endif
@endsection

@section('dash-nav')
    <a href="/moderator/new_ads" class="list-group-item" id="new_ads">Novi oglasi&nbsp;
        @if($modDash['newAdCount'] > 0)
            <span class="badge">{{$modDash['newAdCount']}}</span>
        @endif
    </a>
    <a href="/moderator/reported_comments" class="list-group-item" id="reported_comments">Prijavljeni Komentari&nbsp;
        @if($modDash['reportedCommentCount'] > 0)
            <span class="badge" >{{$modDash['reportedCommentCount']}}</span>
        @endif
    </a>
    <a href="{{url('appointments/pending')}}" class="list-group-item" id="appointments_pending">Novi zakazani termini&nbsp;
        @if($modDash['newAppointmentCount'] > 0)<span class="badge">{{$modDash['newAppointmentCount']}}</span>
        @endif
    </a>
    <a href="{{url('appointments/my_appointments')}}" class="list-group-item" id="appointments_my_appointments">Moji termini&nbsp;
        @if($modDash['myAppointmentCount'] > 0)
            <span class="badge">{{$modDash['myAppointmentCount']}}</span>
        @endif
    </a>
    <a href="/users" class="list-group-item" id="users">Pretraga korisnika</a>
    <a href="{{url('ad/create')}}" class="list-group-item" id="ad_create">Dodaj oglas</a>
    <a href="{{url('myads')}}" class="list-group-item" id="my_ads">Moji oglasi</a>
    <a href="{{url('user/updateProfile')}}" class="list-group-item" id="update_profile">Podešavanje profila</a>
@endsection
