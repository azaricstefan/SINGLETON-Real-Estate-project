@extends('layouts.bootstrap')

@section('content')
    {{Form::open(['method' => 'post', 'url' => url('password/email/reset')])}}
    <div class="row">
        <div class="col-sm-4">
            {{--Mesto za reklamu sa leve strane--}}
        </div>
        <div class="col-sm-3 col-sm-offset-1">
            {{Form::label(null, 'Nova lozinka')}}
            {{Form::input('password', 'password', null, ['class' => 'form-control'])}}
            @if($errors->has('password'))
                <strong class="alert-warning">{{$errors->first('password')}}</strong><br/>
            @else
                <br/>
            @endif
            {{Form::label(null, 'Potvrda lozinke')}}
            {{Form::input('password', 'password_confirmation', null, ['class' => 'form-control'])}}
            {{Form::hidden('email', null, ['id' => 'email_id'])}}
            {{Form::hidden('password_token', null, ['id' => 'password_token_id'])}}
            {{Form::submit('Promeni', ['class' => 'btn btn-default'])}}
        </div>
        <div class="col-sm-4 col-sm-offset-1">
            {{--Mesto za reklamu sa desne strane--}}
        </div>
    </div>
    {{Form::close()}}
@endsection

@section('scriptAfterLoad')
    <script>
        $(function () {
            var url_path = location.pathname;
            var last_index = url_path.lastIndexOf('&email=');
            var my_email = url_path.substr(last_index + 7);
            var token_left_bound = url_path.lastIndexOf('/');
            var my_token = url_path.substr(token_left_bound + 1, (last_index - token_left_bound -1));
            $('#email_id').val(my_email);
            $('#password_token_id').val(my_token);
        })
    </script>
@endsection