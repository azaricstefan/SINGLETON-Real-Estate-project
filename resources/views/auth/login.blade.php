@extends('layouts.auth')

@section('title')
    Log in
@endsection

@section('content')
        <form method="POST" action="{{url('login')}}">
            {{csrf_field()}}
            <label>Username</label>
            <input type="text" name="username"><br/>
            <label>Pasword</label>
            <input type="password" name="password">
            <input type="submit" value="Login"><br/>
            <a href="register">Register</a>
        </form>
@endsection