@extends('auth.login')

@section('title')
    Register
@endsection

@section('content')
    <form method="POST" action="{{url('register')}}">
        {{csrf_field()}}
        <label>Fullname</label>
        <input type="text" name="fullname" value="{{old('fullname')}}">
        @if($errors->has('fullname'))
            <strong>{{$errors->first('fullname')}}</strong>
        @endif
        <br/>
        <label>Telefon</label>
        <input type="text" name="telefon" value="{{old('telefon')}}">
        @if($errors->has('telefon'))
            <strong>{{$errors->first('telefon')}}</strong>
        @endif
        <br/>
        <label>Email</label>
        <input type="email" name="email" value="{{old('email')}}">
        @if($errors->has('email'))
            <strong>{{$errors->first('email')}}</strong>
        @endif
        <br/>
        <label>Username</label>
        <input type="text" name="username" value="{{old('username')}}">
        @if($errors->has('username'))
            <strong>{{$errors->first('username')}}</strong>
        @endif
        <br/>
        <label>Pasword</label>
        <input type="password" name="password">
        @if($errors->has('password'))
            <strong>{{$errors->first('password')}}</strong>
        @endif
        <br/>
        <label>Confirm pasword</label>
        <input type="password" name="password_confirmation"><br/>
        <input type="submit" value="Register">
    </form>
@endsection