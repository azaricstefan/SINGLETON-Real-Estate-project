@extends('layouts.dashboard')

@section('title')
    Administrator
@endsection

@section('dash-nav')
    <a href="/admin/add_moderator" class="list-group-item">Novi moderatorski nalog</a>
    <a href="/admin/registered_users" class="list-group-item">Pregled korisnickih naloga</a>

    <a href="/moderator/new_ads" class="list-group-item" id="new_ads">Novi oglasi&nbsp;@if($modDash['newAdCount'] > 0)<span class="badge">{{$modDash['newAdCount']}}</span>@endif</a>
    <a href="/moderator/reported_comments" class="list-group-item" id="reported_comments">Prijavljeni Komentari&nbsp;<span class="badge" >{{$modDash['reportedCommentCount']}}</span></a>
    <a href="{{url('appointments/pending')}}" class="list-group-item" id="appointments_pending">Novi zakazani termini&nbsp;@if($modDash['newAppointmentCount'] > 0)<span class="badge">{{$modDash['newAppointmentCount']}}</span>@endif</a>
    <a href="{{url('appointments/my_appointments')}}" class="list-group-item" id="appointments_my_appointments">Moji termini&nbsp;@if($modDash['myAppointmentCount'] > 0)<span class="badge">{{$modDash['myAppointmentCount']}}</span>@endif</a>
    <a href="/users" class="list-group-item" id="users">Pretraga korisnika</a>
    <a href="{{url('ad/create')}}" class="list-group-item">Dodaj oglas</a>
@endsection

