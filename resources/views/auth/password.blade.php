@extends('layouts.auth')

@section('content')
    <form method="post" action="{{url('/password/email')}}">
        {{csrf_field()}}
        Email: <input type="email" name="email"><br/>
        <input type="submit" value="Posalji mejl">
    </form>
@endsection