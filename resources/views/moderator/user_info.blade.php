@extends('layouts.bootstrap')

@section('title')
    Pretraži korisnike
@endsection

@section('headScript')
    <link href="/css/forma.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/button.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="col-sm-offset-2">
        <p><button type="button" class="btn btn-default" onclick="location.href='{{url('users')}}'">Nazad na pregled korisnika</button></p>
    </div>
    <div class="col-sm-offset-4">
        <p>Korisničko ime:{{$user->username}}</p>
        <p>Puno ime i prezime: {{$user->username}}</p>
        <p>Telefon: {{$user->telefon}}</p>
        <p>E-mail: {{$user->email}}</p>
        <p>Oglasi:</p>
            @foreach($user->ads as $ad)
                <p>
                <a href="{{$ad->images[0]->image_path}}" data-lightbox="galerija">
                    <img src="{{$ad->images[0]->image_path}}" class="img-thumbnail" alt="{{$ad->getName()}}" width="250" />
                </a>
                </p>
            <p><a href="/ad/{{$ad->ad_id}}">{{$ad->getName()}}</a> <br /></p>
            @endforeach
    </div>
@endsection