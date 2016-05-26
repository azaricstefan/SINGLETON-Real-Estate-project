@extends(Auth::user()->isModerator() ? 'moderator.moddash' : 'admin.admindash')

@section('title')
    Pretrazi korisnike
@endsection

@section('headScript')
    <link href="/css/forma.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/button.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/confirm.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('dash-content')
    <div class="table-responsive">
        {!! Form::open(["method" => 'GET']) !!}
        <table class="table">
            <tr>
                <td colspan="1">
                    {!! Form::label("criteria" , "Filter:") !!}
                    {!! Form::select("criteria", ["username" => "Korisničko ime", "fullname" => "Puno ime", "email" => "E-Mail", "telefon" => "Telefon"],null, [
                    "placeholder" => 'Bez filtera', "id" =>"criteria_select", "class" => "form-control"] )!!}
                </td>
                <td colspan="1">
                    {!! Form::label("criteria" , "Trazi:") !!}
                    {!! Form::text("searchString",null, ["id" => "text_like", "class" => "form-control"])!!}
                </td>
                <td colspan="4" style="vertical-align: bottom; position: relative; top: 9px;text-align: left;">
                    {!! Form::submit("Filtriraj",array('class'=>'btn btn-default')) !!}
                </td>

            </tr>
            <tr>
                <th>Korisničko ime</th>
                <th>Ime i prezime</th>
                <th>E-mail</th>
                <th>Telefon</th>
            </tr>
            <tbody id="ajax-results">
                @if(count($users) > 0)
                    @foreach($users as $user)
                        <tr>
                            <div class="nesto">
                            <td><a href="{{url('users',[$user->user_id])}}">{{$user->username}}</a></td>
                            <td>{{$user->fullname}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->telefon}}</td>
                            </div>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        {!! Form::close() !!}
    </div>
@endsection

@section('scriptAfterLoad')
    <script>
        function ajaxSearch(){
            $.get("#",
                    {
                        criteria:$('#criteria_select').val(),
                        searchString:$('#text_like').val()
                    }
            ).done(function(response){
                $('#ajax-results').html(response);
            })
        }
        $(function () {
            $('#users').addClass('active');
            $('#text_like').on('keyup',ajaxSearch);
            $('#criteria_select').on('change',ajaxSearch);
        })
    </script>
@endsection