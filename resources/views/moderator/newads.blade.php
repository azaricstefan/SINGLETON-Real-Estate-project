@extends('moderator.moddash')

@section('content-mod-dash')
    <h1>Novi oglasi: {{Auth::user()->username}}</h1><br/>
    <a href="{{url('dashboard')}}">Nazad na dashboard</a>
    <table>
    <?php $id = 1 ?>
    @foreach($newAds as $ad)
        <tr>
            <td>
             {{$id++}}.
            {{Form::label(null, (($ad->ad_type == 'Renting') ? 'Izdavanje' : 'Prodaja'))}}
            {{Form::label(null, $ad->city)}}
            {{Form::label(null, $ad->address)}}

            </td>
            <td>
            <a href="/ad/{{$ad->ad_id}}">Pogledaj</a>
            </td>
        </tr>
    @endforeach
    </table>

    @section('scriptAfterLoad')
        <script>
            $(function(){
                $()
            });
        </script>
    @endsection

@endsection