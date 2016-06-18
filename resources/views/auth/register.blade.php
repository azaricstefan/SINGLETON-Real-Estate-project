@extends('layouts.bootstrap')

@section('title')
    Register
@endsection

@section('headScript')
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/button.css" media="all" rel="stylesheet" type="text/css" />
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
            <form method="POST" action="{{url('register')}}" role="form">
                {{csrf_field()}}
                <div class="form-group">
                    <label>Ime i prezime</label>
                    @if($errors->has('fullname'))
                        <strong class="custom-strong-error">{{$errors->first('fullname')}}</strong>
                    @endif
                    <input type="text" name="fullname" value="{{old('fullname')}}" class="form-control"><br/>
                    <label>Telefon</label>
                    @if($errors->has('telefon'))
                        <strong class="custom-strong-error">{{$errors->first('telefon')}}</strong>
                    @endif
                    <input type="text" name="telefon" value="{{old('telefon')}}" class="form-control"><br/>
                    <label>E-pošta</label>
                    @if($errors->has('email'))
                        <strong class="custom-strong-error">{{$errors->first('email')}}</strong>
                    @endif
                    <input type="email" name="email" value="{{old('email')}}" class="form-control"><br/>
                    <label data-toggle="tooltip" title="Maksimalno 20 karaktera!">Korisničko ime</label><sub class="reg-label-sup" data-toggle="tooltip" title="Maksimalno 20 karaktera!">?</sub>
                    @if($errors->has('username'))
                        <strong class="custom-strong-error">{{$errors->first('username')}}</strong>
                    @endif
                    <input type="text" name="username" value="{{old('username')}}" class="form-control"><br/>
                    <label data-toggle="tooltip" title="Minimalno 6 karaktera!">Lozinka</label><sub class="reg-label-sup" data-toggle="tooltip" title="Minimalno 6 karaktera!">?</sub>
                    @if($errors->has('password'))
                        <strong class="custom-strong-error">{{$errors->first('password')}}</strong>
                    @endif
                    <input type="password" name="password" class="form-control"><br/>
                    <label>Potvrda lozinke</label>
                    <input type="password" name="password_confirmation" class="form-control"><hr/>
                    <div class = "btn-group-justified">
                        <input type="submit" value="Registracija" class="form-control btn-default">
                        <input type="button" value="Odustani" href="{{url('')}}" onclick="window.location.href ='/'" class="form-control btn-default">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection