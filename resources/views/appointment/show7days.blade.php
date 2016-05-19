@extends('layouts.auth')

@section('title')
    Termini u narednih 7 dana
@endsection

@section('content')
    <h1 align="center">Termini u narednih 7 dana za oglas {{$ad->city.' '.$ad->address}}</h1><br/>
    <a href="{{url('/')}}">Na pocetnu</a>
    {{Form::open(['method' => 'post', 'url' => url('appointment/'.$ad->ad_id)])}}
    <table width="60%" align="center" border="1">
        <tr>
            <th>Datum/Vreme</th>
            @for($i=0; $i<12; $i++)
                <th>{{($i+8).':00'}}</th>
            @endfor
        </tr>
        @for($i=0; $i<7; $i++)
            <tr>
                <td>{{\Carbon\Carbon::today()->addDay($i + 1)->toDateString()}}</td>
                @for($j = 0; $j<12; $j++)
                    <td>
                        @if(!in_array(\Carbon\Carbon::today()->addDay($i+1)->addHour($j+8)->minute(0)->second(0), $app))
                            @if(Auth::user()->isPlebs() && Auth::user()->user_id != $ad->user_id)
                                {{Form::radio('appointment_time',\Carbon\Carbon::today()->addDay($i+1)->addHour($j+8)->minute(0)->second(0))}}
                            @endif
                        @else
                            Termin rezervisan
                        @endif
                    </td>
                @endfor
            </tr>
        @endfor
    </table>
    <br/>
    @if(Auth::user()->isPlebs() && Auth::user()->user_id != $ad->user_id)
    <div align="center">
        <div width="60%">
            {{Form::label(null,'Poruka:')}}<br>
            {{Form::textarea('user_note',null,['style' => 'width:60%;'])}}
        </div>
        {{Form::submit('Rezervisi termin')}}
    </div>
    @endif
    {{Form::close()}}
@endsection