@extends('layouts.auth')

@section('headScript')
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@if(count($users) > 0)
    @foreach($users as $user)
        <tr>
            <td><a href="{{url('users',[$user->user_id])}}">{{$user->username}}</a></td>
            <td>{{$user->fullname}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->telefon}}</td>
        </tr>
    @endforeach
@endif
