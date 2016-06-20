@extends('layouts.bootstrap')

@section('title')
    Termini u narednih 7 dana
@endsection

@section('headScript')
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/button.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/forma.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    {{Form::open(['method' => 'post', 'url' => url('appointment/'.$ad->ad_id), 'class' => 'form-group'])}}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1 align="center">Termini u narednih 7 dana za oglas {{$ad->city.' '.$ad->address}}</h1><br/>
        </div>
    </div>
    <div class="row">
{{--        <div class="col-md-2">
            --}}{{--Za reklamu sa leve strane--}}{{--
        </div>
        <div class="col-md-8">--}}
        <div class="table">
            <table align="center" class="table table-bordered" style="width:70%;">
            <tr style="vertical-align: middle;">
                <th style="text-align: center;width: 100px">Datum/Vreme</th>
                @for($i=0; $i<12; $i++)
                    <th style="text-align: center; width: 80px">{{($i+8).':00'}}</th>
                @endfor
            </tr>
            @for($i=0; $i<7; $i++)
                <tr style="text-align: center;vertical-align: middle;height: 60px;">
                    <td style="text-align: center;vertical-align: middle">{{\Carbon\Carbon::today()->addDay($i + 1)->toDateString()}}</td>
                    @for($j = 0; $j<12; $j++)
                            @if(!in_array(\Carbon\Carbon::today()->addDay($i+1)->addHour($j+8)->minute(0)->second(0), $app))
                                @if(Auth::user()->isPlebs() && Auth::user()->user_id != $ad->user_id)
                                <td style="text-align: center;vertical-align:middle; max-height: 20px;" class="success">
                                    {{Form::radio('appointment_time',\Carbon\Carbon::today()->addDay($i+1)->addHour($j+8)->minute(0)->second(0),
                                        false,['class' => 'optradio'])}}
                                    </td>
                                @else
                                    <td></td>
                                @endif
                            @else
                                <td style="text-align: center;vertical-align: middle" class="danger">Termin rezervisan</td>
                            @endif
                    @endfor
                </tr>
            @endfor
        </table>
        </div>
{{--        </div>
        <div class="col-md-2">
            --}}{{--Za reklamu sa desne strane--}}{{--
        </div>--}}
    </div>
    <div class="row">
        @if(Auth::user()->isPlebs() && Auth::user()->user_id != $ad->user_id)
        <div align="center">
            <div>
                {{Form::label(null,'Poruka:')}}
                {{Form::textarea('user_note',null,['style' => 'width:70%', 'class' => 'form-control', 'rows' => '3'])}}
            </div>
            {{Form::submit('Rezervisi termin',['class' => 'btn btn-default'])}}
        </div>
        @endif
    </div>
    {{Form::close()}}
@endsection