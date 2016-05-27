@extends('layouts.bootstrap')

@section('title')
    Log in
@endsection

@section('headScript')
    <link href="/css/button.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
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
                    <input type="submit" value="Login" class="form-control btn-default">
                </form>
            </div>
        </div>
    </div>
@endsection