@extends('layouts.bootstrap')

@section('content')
    <form method="post" action="{{url('/password/email')}}">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-5">
                    {{--Za reklamu sa leve strane--}}
                </div>
                <div class="col-sm-2">
                    {{csrf_field()}}
                    <label for="email">Email: </label>
                    <input type="email" placeholder="Vaš email" name="email" class="form-control"><br/>
                    <input type="submit" value="Pošalji" class="btn btn-default">
                </div>
                <div class="col-sm-5">
                    {{--Za reklamu sa desne strane--}}
                </div>
            </div>
        </div>
    </form>
@endsection