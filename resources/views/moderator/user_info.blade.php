@extends('layouts.auth')

@section('title')
    Pretrazi korisnike
@endsection

@section('content')

    Korisničko ime:{{$user->username}}<br />
    Puno ime i prezime: {{$user->username}}<br />
    Telefon: {{$user->telefon}}<br/>
    E-mail: {{$user->email}}<br/>
    Oglasi:<br/>
    @foreach($user->ads as $ad)
        <a href="/ad/{{$ad->ad_id}}">{{$ad->getName()}}</a> <br />
    @endforeach

@endsection