@extends('layouts.auth')

@section('title')
	Izmena podataka na profilu
@endsection

@section('content')

	{{--VERZIJA 1--}}

	{{--{{Form::model($user, ['action' => ['UserDashboardController@updateProfile', $request] ] )}}--}}
	{{--TODO: MODEL BINDING https://laravelcollective.com/docs/5.2/html#form-model-binding--}}
	{{--{!! Form::close() !!}--}}


	{{--VERZIJA 2--}}

	{!!Form::open( ['url' => 'user/updateProfile', 'method' => 'post'] ) !!}

		<div class="form-group">
			{{Form::label('fullname', 'Ime i prezime:')}}
			{{ Form::text('fullname', Auth::user()->fullname )}}
		</div>

		<div class="form-group">
			{{Form::label('email', 'Email:')}}
			{{ Form::email('email', Auth::user()->email )}}
		</div>

		<div class="form-group">
			{{Form::label('telefon', 'Telefon:')}}
			{{ Form::text('telefon', Auth::user()->telefon )}}
		</div>

		<div class="form-group">
			{{Form::label('username', 'Korisničko ime:')}}
			{{ Form::text('username', Auth::user()->username )}}
		</div>

		<div class="form-group">
			{{Form::submit('Izmeni')}}
			{{Form::button('Odustani',[ 'href' => url()->previous(), 'type' => 'link' ] )}}
		</div>

	{!! Form::close() !!}
@endsection