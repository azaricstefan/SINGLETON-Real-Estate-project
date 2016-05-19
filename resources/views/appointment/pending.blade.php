@extends('layouts.auth')

@section('title')
    Novi zakazani termini
@endsection

@section('content')
    <h1>Novi zakazani termini</h1><br/>
    <a href="{{url('dashboard')}}">Nazad na dash</a>
    <table align="center">
        @foreach($pendingAppointments as $pendingAppointment)
            <tr>
                <td>{{Form::label(null, $pendingAppointment->ad->city.' '.$pendingAppointment->ad->address)}}</td>
                <td>{{Form::label(null, $pendingAppointment->appointment_time)}}</td>
                <td><a href="{{url('appointment/'.$pendingAppointment->appointment_id.'/schedule')}}">Preuzmi termin</a></td>
            </tr>
        @endforeach
    </table>
@endsection