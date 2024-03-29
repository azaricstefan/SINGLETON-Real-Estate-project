@extends('admin.admindash')

@section('title')
    Pregled korisničkih naloga
@endsection

@section('headScript')
    <link href="/css/forma.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/button.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/confirm.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('dash-content')


    <h1>Pregled korisničkih naloga</h1> <br>

    <table class="table table-hover">

        <tr>
        {!! Form::open(["method" => 'GET']) !!}
            <td colspan="2">
                {!! Form::label("criteria" , "Filter:") !!}
                {!! Form::select("criteria", ["username" => "Korisničko ime", "fullname" => "Puno ime", "user_type_id" => "Kategorija"],null, [
                "placeholder" => 'Bez filtera', "id" =>"criteria_select", "class" => "form-control"]) !!}
            </td>
            <td colspan="2">
                {!! Form::label("criteria" , "Trazi:") !!}
                {!! Form::text("searchString", null , ["id" => "text_like", "class" => "form-control"])!!}
                {!! Form::select("searchOptionRoleType", ["1" => 'Administrator' ,'2' =>"Moderator" , '3' => "Klijent"], null ,
                ["placeholder" => 'Izaberite kategoriju', "id" =>"select_role_type"]) !!}
            </td>
            <td colspan="4" style="vertical-align: bottom; position: relative; top: 9px;text-align: left;">
                {!! Form::submit("Filtriraj", ["class" => "btn btn-default"]) !!}
            </td>

        {!! Form::close() !!}
        </tr>
        <tr>
            <th>Id</th>
            <th>Korisničko ime</th>
            <th>Ime i prezime</th>
            <th>E-mail</th>
            <th>Kategorija</th>
            <th>Datum registracije</th>
            <th>Poslednji login</th>
            <td></td>
        </tr>
        @if(count($users) > 0)
            @foreach($users as $user)
                <tr align="left">
                    <td>{{$user->user_id}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->fullname}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->type->role_name}}</td>
                    <td>{{$user->registration_date}}</td>
                    <td>{{$user->last_login}}</td>
                    @if($user->user_type_id != 1)
                        <td><a href="/admin/delete_user/{{$user->user_id}}" class='btn btn-default-reverse confirmation'>Obriši</a></td>
                    @else
                        <td></td>
                    @endif
                </tr>
            @endforeach
        @endif
        <tr>
            <td colspan="8">{!! $users->render() !!}</td>
        </tr>
    </table>
@endsection

@section('scriptAfterLoad')
    <script>
        $(function () {
            $('#registered_users').addClass('active');
            var s = document.getElementById("criteria_select");
            if(s.options[s.selectedIndex].value != "user_type_id")
            {
                document.getElementById('select_role_type').style.display = 'none';
            }

            document.getElementById("criteria_select").onchange = function()
            {
                var s = document.getElementById("criteria_select");
                if(s.options[s.selectedIndex].value != "user_type_id")
                {
                    document.getElementById('select_role_type').style.display = 'none';
                    document.getElementById('text_like').style.display = 'block';
                }
                else {
                    document.getElementById('select_role_type').style.display = 'block';
                    document.getElementById('text_like').style.display = 'none';
                }
            };
            $('.confirmation').click(confirmIt);
        });

        var confirmIt = function (e) {
            if (!confirm('Da li ste sigurni? Ova akcija će obrisati korisnički nalog i sve informacije vezane za njega. Akcija je nepovratna!')) e.preventDefault();
        };
    </script>
@endsection