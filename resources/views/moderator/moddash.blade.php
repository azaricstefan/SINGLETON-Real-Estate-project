@extends('bootstrap')

@section('title')
    Moderator
@endsection

@section('navbar')
    @if(session()->has('flash_message'))
        <div style='width:200px; background-color: #00b3ee; text-align: center'>
            {{session('flash_message')}}
        </div>
    @endif
    <div class="navbar-header">
        <a class="navbar-brand" href="{{url('dashboard')}}">Dashboard</a>
    </div>{{--
    <ul class="nav navbar-nav">
        <li class="active"><a href="/moderator/new_ads" class="">Novi oglasi&nbsp;@if($newAdCount > 0)<span class="badge">{{$newAdCount}}</span>@endif</a></li>
        <li><a href="/moderator/reported_comments" class="">Prijavljeni Komentari&nbsp;<span class="badge" >{{$$modDash['reportedCommentCount']}}</span></a></li>
        <li><a href="{{url('appointments/pending')}}">Novi zakazani termini&nbsp;@if($newAppointmentCount > 0)<span class="badge">{{$newAppointmentCount}}</span>@endif</a></li>
        <li><a href="{{url('appointments/my_appointments')}}">Moji termini&nbsp;@if($['myAppointmentCount'] > 0)<span class="badge">{{$['myAppointmentCount']}}</span>@endif</a></li>
        <li><a href="/users">Pretraga korisnika</a></li>
    </ul>--}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="/moderator/new_ads" class="list-group-item">Novi oglasi&nbsp;@if($modDash['newAdCount'] > 0)<span class="badge">{{$modDash['newAdCount']}}</span>@endif</a>
                <a href="/moderator/reported_comments" class="list-group-item">Prijavljeni Komentari&nbsp;<span class="badge" >{{$modDash['reportedCommentCount']}}</span></a>
                <a href="{{url('appointments/pending')}}" class="list-group-item">Novi zakazani termini&nbsp;@if($modDash['newAppointmentCount'] > 0)<span class="badge">{{$modDash['newAppointmentCount']}}</span>@endif</a>
                <a href="{{url('appointments/my_appointments')}}" class="list-group-item">Moji termini&nbsp;@if($modDash['myAppointmentCount'] > 0)<span class="badge">{{$modDash['myAppointmentCount']}}</span>@endif</a>
                <a href="/users" class="list-group-item">Pretraga korisnika</a>
            </div>
        </div>
        <div class="col-md-9">
            @yield('content-mod-dash')
        </div>
    </div>
@endsection
