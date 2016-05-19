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
    <a href="/admin/add_moderator">Novi moderatorski nalog</a>
    <a href="/admin/registered_users">Pregled korisnickih naloga</a>
    <hr />
    <a href="/moderator/new_ads">Pregled novih oglasa</a>
    <a href="/moderator/reported_comments">Prijavljeni komentari</a>
@endsection