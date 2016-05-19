@extends('layouts.auth')

@section('title')
	Izmena podataka na profilu
@endsection

@section('content')
	<form method="post" action="{{url('user/updateProfile')}}">
		{{csrf_field()}}

		<label>Ime i prezime:</label>
		{{ Form::text('fullname', Auth::user()->fullname )}}<br/>

		<label>Email:</label>
		{{ Form::text('email', Auth::user()->email )}}<br/>

		<label>Telefon:</label>
		{{ Form::text('telefon', Auth::user()->telefon )}}<br/>

		<label>Username:</label>
		{{ Form::text('username', Auth::user()->username )}}<br/>

		{{Form::submit('Izmeni')}}
	</form>
@endsection