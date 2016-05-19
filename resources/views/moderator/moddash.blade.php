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
    <a href="/moderator/new_ads">Novi oglasi({{$newAdCount}})</a> <br/>
    <a href="/moderator/reported_comments">Prijavljeni Komentari({{$reportedCommentCount}})</a><br/>
    <a href="{{url('appointments/pending')}}">Novi zakazani termini</a><br/>
    <a href="{{url('appointments/my_appointments')}}">Moji termini</a><br/>
@endsection