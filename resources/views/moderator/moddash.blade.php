@extends('layouts.dashboard')

@section('title')
    Moderator
@endsection

@section('dash-nav')
    <a href="/moderator/new_ads" class="list-group-item" id="new_ads">Novi oglasi&nbsp;@if($modDash['newAdCount'] > 0)<span class="badge">{{$modDash['newAdCount']}}</span>@endif</a>
    <a href="/moderator/reported_comments" class="list-group-item" id="reported_comments">Prijavljeni Komentari&nbsp;<span class="badge" >{{$modDash['reportedCommentCount']}}</span></a>
    <a href="{{url('appointments/pending')}}" class="list-group-item" id="appointments_pending">Novi zakazani termini&nbsp;@if($modDash['newAppointmentCount'] > 0)<span class="badge">{{$modDash['newAppointmentCount']}}</span>@endif</a>
    <a href="{{url('appointments/my_appointments')}}" class="list-group-item" id="appointments_my_appointments">Moji termini&nbsp;@if($modDash['myAppointmentCount'] > 0)<span class="badge">{{$modDash['myAppointmentCount']}}</span>@endif</a>
    <a href="/users" class="list-group-item" id="users">Pretraga korisnika</a>
@endsection
