@extends('dashboard.layout')

@section('content')
    <h1>Oglasi korisnika: {{Auth::user()->username}}</h1><br/>
    <a href="{{url('dashboard')}}">Nazad na dashboard</a>

    <table>
    <?php $id = 1 ?>
    @foreach($myads as $ad)
        <tr>

            <td>
             {{$id++}}.
            {{Form::label(null, (($ad->ad_type == 'Renting') ? 'Izdavanje' : 'Prodaja'))}}
            {{Form::label(null, $ad->city)}}
            {{Form::label(null, $ad->address)}}

            </td>
            <td>
            <a href="ad/{{$ad->ad_id}}">Pogledaj</a>
            <a href="ad/{{$ad->ad_id}}/edit">Izmeni</a>
            <a href="#">Obrisi</a>
            </td>

        </tr>
    @endforeach

    </table>


@endsection