@extends('layouts.auth')

@section('title')
    Log in
@endsection

@section('content')
    <div align="center" style="">
        <form method="POST" action="{{url('login')}}">
            {{csrf_field()}}
            <label>Username</label>
            <input type="text" name="username"><br/>
            <label>Pasword</label>
            <input type="password" name="password"><br/>
            <input type="submit" value="Login">
            <a href="register">Register</a>
        </form>
    </div>
@endsection