@extends('layouts.auth')

@section('title')
    Termin {{$appointment->appointment_time}} zavrsen
@endsection

@section('content')
    <div align="center">
        <h1>Termin {{$appointment->ad->city.' '.$appointment->ad->address.' '.$appointment->appointment_time}}</h1>
        <div>
            {{Form::open(['method' => 'post', 'url' => url('appointment/'.$appointment->appointment_id.'/complete')])}}
            {{Form::textarea('agent_note', null, ['style' => 'width:60%;'])}}<br/>
            {{Form::submit('Zavrsi termin')}}
            {{Form::close()}}
        </div>
    </div>
@endsection