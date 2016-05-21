@extends('bootstrap')

@section('navbar')
    <div class="navbar-header">
        <a class="navbar-brand" href="{{url('dashboard/moderator')}}">Dashboard</a>
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
                @yield('dash-nav')
            </div>
        </div>
        <div class="col-md-9">
            @yield('dash-content')
        </div>
    </div>
@endsection

