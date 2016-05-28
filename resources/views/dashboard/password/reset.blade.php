@extends(Auth::user()->isPlebs() ? 'dashboard.user.userdash' : (Auth::user()->isModerator() ? 'moderator.moddash' : 'admin.admindash' ))

@section('dash-content')
    <div class="row">
        <div class="col-sm-3">
            {{--Za reklamu sa leve strane--}}
            @if($errors->count() > 0)
                {{--{{dd($errors)}}--}}
            @endif
        </div>
        <div class="col-sm-3">
            {{Form::open(['mehtod' => 'post', 'url' => 'password/reset'])}}
            <div class="form-group">
                {{Form::label(null, 'Trenutna lozinka')}}
                {{Form::input('password', 'old_password', null, ['class' => 'form-control'])}}
                @if($errors->has('old_password'))
                    <strong class="alert-warning">Pogrešna lozinka</strong><br/>
                @else
                    <br/>
                @endif
                {{Form::label(null, 'Nova lozinka')}}
                {{Form::input('password', 'password', null, ['class' => 'form-control'])}}
                @if($errors->has('password'))
                    <strong class="alert-warning">{{$errors->first('password')}}</strong><br/>
                @else
                    <br/>
                @endif
                {{Form::label(null, 'Potvrda nove lozinke')}}
                {{Form::input('password', 'password_confirmation', null, ['class' => 'form-control'])}}
                {{Form::submit('Promeni', ['class' => 'btn btn-default'])}}
            </div>
            {{Form::close()}}
        </div>
        <div class="col-sm-6">
            {{--Za reklamu sa desne strane--}}
        </div>
    </div>
@endsection

@section('scriptAfterLoad')
    <script>
        $(function () {
            $('#password_reset').addClass('active');
        })
    </script>
@endsection