@extends(Auth::user()->isPlebs() ? 'dashboard.user.userdash' : (Auth::user()->isModerator() ? 'moderator.moddash' : 'admin.admindash'))

@section('headScript')
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('dash-content')

    <h1>Oglasi korisnika: {{Auth::user()->username}}</h1><br/>
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>Oglas</th>
                    <th>Izbor</th>
                </tr>
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
                    <a href="ad/{{$ad->ad_id}}">Pogledaj</a> |
                    <a href="ad/{{$ad->ad_id}}/edit">Izmeni</a> |
                    <a href="#">Obrisi</a>
                    </td>
                </tr>
            @endforeach

            </table>
        </div>
@endsection

@section('scriptAfterLoad')
    <script>
        $(function () {
            $('#my_ads').addClass('active');
        })
    </script>
@endsection