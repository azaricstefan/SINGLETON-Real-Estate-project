@extends('layouts.auth')

@section('title')
    Moji termini
@endsection

@section('content')
    <div align="center">
    <h1>Moji termini</h1><br/>
    <a href="{{url('dashboard')}}">Nazad na dash</a><br/>
    <table>
        <tr>
            <th>Oglas</th>
            <th>Vreme</th>
            <th colspan="2">Izbor</th>
        </tr>
        @foreach($appointments as $appointment)
            <tr>
                <td><a href="{{url('ad/'.$appointment->ad->ad_id)}}"> {{$appointment->ad->city.' '.$appointment->ad->address}}</a></td>
                <td>{{$appointment->appointment_time}}</td>
                @if(!Auth::user()->isPlebs())
                    <td><a href="{{url('appointment/'.$appointment->appointment_id.'/complete')}}">Termin završen</a></td>
                @endif
                <td><a href="{{url('appointment/'.$appointment->appointment_id.'/cancel')}}">Otkazi termin</a></td>
            </tr>
        @endforeach
    </table>
    </div>
@endsection