@extends('layouts.bootstrap')

@section('title')
    Log in
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
                    <input type="submit" value="Login" class="form-control">
                </form>
            </div>
        </div>
    </div>
@endsection