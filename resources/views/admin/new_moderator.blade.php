@extends('admin.admindash')

@section('title')
    Dodaj moderatora
@endsection

@section('headScript')
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/button.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/forma.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('dash-content')
    <h1>Forma za kreiranje moderatorskog naloga</h1>
    <br>
    {!! Form::open(['url' => '/admin/add_moderator']) !!}
    <table class="table table-hover">
        <tr>
            <td>{!! Form::label('fullname','Puno ime i prezime:') !!}</td>
            <td>{!! Form::text('fullname', null, ["class" => "form-control"]) !!}  </td>
        </tr>
        <tr>
            <td>{!! Form::label('telefon','Telefon:') !!} </td>
             <td>{!! Form::text('telefon', null, ["class" => "form-control"]) !!}       </td>
        </tr>
        <tr>
             <td>{!! Form::label('email','E-mail:') !!}  </td>
             <td>{!! Form::text('email', null, ["class" => "form-control"]) !!} </td>
        </tr>
        <tr>
             <td>{!! Form::label('username','Korisničko ime:') !!} </td>
             <td>{!! Form::text('username', null, ["class" => "form-control"]) !!}</td>
        </tr>
        <tr>
             <td>{!! Form::label('password','Lozinka:') !!}     </td>
             <td>{!! Form::password('password', array('class'=>'form-control')) !!}  </td>
        </tr>
        <tr>
             <td>{!! Form::label('password_confirmation','Potvrda lozinke:') !!}   </td>
             <td>{!! Form::password('password_confirmation', array('class'=>'form-control')) !!}</td>
        </tr>
        <tr>
            <td colspan="2" align="right">{!! Form::submit("Dodaj moderatora",['class' => 'btn btn-default'])!!}    </td>
        </tr>


    </table>

    {!! Form::close() !!}

    @if(count($errors))
    <div style="margin:auto;text-align: center;background-color: #2aabd2;border: solid 2px grey;width: 50%">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
@endsection

@section('scriptAfterLoad')
    <script>
        $(function () {
            $('#add_moderator').addClass('active');
        })
    </script>
@endsection