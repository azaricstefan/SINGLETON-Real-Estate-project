@extends(Auth::user()->isPlebs() ? 'dashboard.user.userdash' : (Auth::user()->isModerator() ? 'moderator.moddash' : 'admin.admindash'))

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
                    <a href="ad/{{$ad->ad_id}}/delete" id="delete-url">Obrisi</a>
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
            $('#delete-url').on("click", function(e){
               if(!confirm("Da li ste sigurni da želite da obrišete oglas?")){
                    e.preventDefault();
               }
            });
        })
    </script>
@endsection