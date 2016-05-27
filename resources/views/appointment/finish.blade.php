@extends('layouts.bootstrap')

@section('title')
    Termin {{$appointment->appointment_time}} zavrsen
@endsection

@section('headScript')
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('nav-bar-header')
        <a class="navbar-brand" href="{{url('appointments/my_appointments')}}">Moji termini</a>
@endsection

@section('content')
    <div align="center">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h3>Termin {{$appointment->ad->city.' '.$appointment->ad->address.' '.$appointment->appointment_time}}</h3>
                <div class="form-group">
                    {{Form::open(['method' => 'post', 'url' => url('appointment/'.$appointment->appointment_id.'/complete')])}}
                    {{Form::textarea('agent_note', null, ['class' => 'form-control'])}}<br/>
                    {{Form::submit('Zavrsi termin', ['class' => 'form-control'])}}
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection