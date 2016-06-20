@extends('layouts.bootstrap')

@section('title')
    Log in
@endsection

@section('headScript')
    <link href="/css/button.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('nav-bar')
    <ul class="nav navbar-nav">
        <li><a href="{{url('/')}}">Početna strana</a></li>
        <li><a href="{{url('search')}}">Pretraži oglase</a></li>
        <li><a href="{{url('ad/create')}}">Dodaj oglas</a></li>
        <li><a href="{{url('about')}}">Informacija o nama</a></li>
        {{--TODO: DODATI STRANICU SA INFORMACIJAMA O AGENCIJI--}}
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3 col-md-offset-3">
            <div class="form-group">
                <form method="POST" action="{{url('login')}}">
                    {{csrf_field()}}
                    <label >Username</label>
                    <input type="text" name="username" class="form-control"><br/>
                    <label>Pasword</label>
                    <input type="password" name="password" class="form-control"> <br/>
                    @if(session()->has('flash_message'))
                        <div class="alert alert-danger" style="text-align: center">
                            {{session('flash_message')}}
                        </div><br/>
                    @endif
                    <input type="submit" value="Login" class="form-control btn-default">
                    <a href="/password/email">Zaboravio pass?</a>
                </form>
            </div>
        </div>
    </div>
@endsection