@extends(Auth::user()->isPlebs() ? 'dashboard.user.userdash' : (Auth::user()->isModerator() ? 'moderator.moddash' : 'admin.admindash'))

@section('title')
	Izmena podataka na profilu
@endsection

@section('headScript')
	<link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
	<link href="/css/button.css" media="all" rel="stylesheet" type="text/css" />
	<script lang="javascript">
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('the_submit_button').addEventListener('click',function () {
                submit()
            })
        });
		function submit() {
            document.getElementById('my_form').submit();
        }
	</script>
@endsection

@section('dash-content')

	{{--VERZIJA 1--}}

	{{--{{Form::model($user, ['action' => ['UserDashboardController@updateProfile', $request] ] )}}--}}
	{{--TODO: MODEL BINDING https://laravelcollective.com/docs/5.2/html#form-model-binding--}}
	{{--{!! Form::close() !!}--}}


	{{--VERZIJA 2--}}
	<div class="col-md-4 col-md-offset-3">
		<div class="form-group">
			{!!Form::open( ['url' => 'user/updateProfile', 'method' => 'post', 'id' => 'my_form'] ) !!}


				{{Form::label('fullname', 'Ime i prezime:')}}
				{{ Form::text('fullname', Auth::user()->fullname , [ 'class' => 'form-control'])}}
				@if($errors->has('fullname'))
					<strong class="alert-warning">{{$errors->first('fullname')}}</strong>
					<br/>
				@endif


				{{Form::label('email', 'Email:')}}
				{{ Form::email('email', Auth::user()->email , [ 'class' => 'form-control'])}}
				@if($errors->has('email'))
					<strong class="alert-warning">{{$errors->first('email')}}</strong>
					<br/>
				@endif


				{{Form::label('telefon', 'Telefon:')}}
				{{ Form::text('telefon', Auth::user()->telefon , [ 'class' => 'form-control'])}}
				@if($errors->has('telefon'))
					<strong class="alert-warning">{{$errors->first('telefon')}}</strong>
					<br/>
				@endif


				{{Form::label('username', 'Korisničko ime:')}}
				{{ Form::text('username', Auth::user()->username , [ 'class' => 'form-control'])}}
				@if($errors->has('username'))
					<strong class="alert-warning">{{$errors->first('username')}}</strong>
					<br/>
				@endif

				<div class="btn-group btn-group-justified">
					<a href="javascript:{}" id="the_submit_button" class="btn btn-default">Izmeni</a>
                    <a href="{{url('dashboard')}}" class="btn btn-default">Odustani</a>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection

@section('scriptAfterLoad')
    <script>
        $(function () {
            $('#update_profile').addClass('active');
        })
    </script>
@endsection