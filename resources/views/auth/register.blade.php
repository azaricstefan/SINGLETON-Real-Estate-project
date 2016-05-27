@extends('layouts.bootstrap')

@section('title')
    Register
@endsection

@section('headScript')
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/button.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3 col-md-offset-3">
            <form method="POST" action="{{url('register')}}" role="form">
                {{csrf_field()}}
                <div class="form-group">
                    <label>Ime i prezime</label>
                    <input type="text" name="fullname" value="{{old('fullname')}}" class="form-control"><br/>
                    @if($errors->has('fullname'))
                        <strong>{{$errors->first('fullname')}}</strong>
                    @endif
                    <label>Telefon</label>
                    <input type="text" name="telefon" value="{{old('telefon')}}" class="form-control"><br/>
                    @if($errors->has('telefon'))
                        <strong>{{$errors->first('telefon')}}</strong>
                    @endif
                    <label>E-pošta</label>
                    <input type="email" name="email" value="{{old('email')}}" class="form-control"><br/>
                    @if($errors->has('email'))
                        <strong>{{$errors->first('email')}}</strong>
                    @endif
                    <label>Korisničko ime</label>
                    <input type="text" name="username" value="{{old('username')}}" class="form-control"><br/>
                    @if($errors->has('username'))
                        <strong>{{$errors->first('username')}}</strong>
                    @endif
                    <label>Lozinka</label>
                    <input type="password" name="password" class="form-control"><br/>
                    @if($errors->has('password'))
                        <strong>{{$errors->first('password')}}</strong>
                    @endif
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