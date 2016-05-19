@extends('layouts.auth')

@section('title')
    Pretrazi korisnike
@endsection

@section('content')
    <table align="center">
        <tr>
        {!! Form::open(["method" => 'GET']) !!}
            <td colspan="2">
                {!! Form::label("criteria" , "Filter:") !!}
                {!! Form::select("criteria", ["username" => "Korisničko ime", "fullname" => "Puno ime", "email" => "E-Mail", "telefon" => "Telefon"],null, [
                "placeholder" => 'Bez filtera', "id" =>"criteria_select"]) !!}
            </td>
            <td colspan>
                {!! Form::text("searchString",null, ["id" => "text_like"])!!}
            </td>
            <td>
                {!! Form::submit("Filtriraj") !!}
            </td>
        {!! Form::close() !!}
        </tr>
        <tr>
            <th>Korisničko ime</th>
            <th>Ime i prezime</th>
            <th>E-mail</th>
            <th>Telefon</th>
        </tr>
        @if(count($users) > 0)
            @foreach($users as $user)
                <tr align="center">
                    <td><a href="{{url('users',[$user->user_id])}}">{{$user->username}}</a></td>
                    <td>{{$user->fullname}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->telefon}}</td>
                </tr>
            @endforeach
        @endif
    </table>

@endsection