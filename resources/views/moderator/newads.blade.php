@extends('moderator.moddash')

@section('content-mod-dash')
    <h1 class="page-header">Novi oglasi: {{Auth::user()->username}}</h1><br/>
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Oglas</th>
                <th></th>
            </tr>
        <?php $id = 1 ?>
        @foreach($newAds as $ad)
            <tr>
                <td scope="row">{{$id++}}</td>
                <td>
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
    </div>
@endsection

@section('scriptAfterLoad')
    <script>
        $(function(){
            $("#new_ads").addClass("active");
        });
    </script>
@endsection