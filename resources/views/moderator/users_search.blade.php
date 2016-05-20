@extends('moderator.moddash')

@section('title')
    Pretrazi korisnike
@endsection

@section('content-mod-dash')
    <div class="table-responsive">
        {!! Form::open(["method" => 'GET']) !!}
        <table class="table">
            <tr>
                <td colspan="2">
                    {!! Form::label("criteria" , "Filter:") !!}
                    {!! Form::select("criteria", ["username" => "Korisničko ime", "fullname" => "Puno ime", "email" => "E-Mail", "telefon" => "Telefon"],null, [
                    "placeholder" => 'Bez filtera', "id" =>"criteria_select"]) !!}
                </td>
                <td colspan>
                    {!! Form::text("searchString",null, ["id" => "text_like"])!!}
                </td>
                <td>
                    {!! Form::submit("Filtriraj") !!}
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
                            <td><a href="{{url('users',[$user->user_id])}}">{{$user->username}}</a></td>
                            <td>{{$user->fullname}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->telefon}}</td>
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