@extends('layouts.auth')

@section('title')
    Dodaj moderatora
@endsection

@section('content')
    {!! Form::open(['url' => '/admin/add_moderator']) !!}
    <table style="margin:auto">
        <tr>
            <td>{!! Form::label('fullname','Puno ime i prezime:') !!}</td>
            <td>{!! Form::text('fullname') !!}  </td>
        </tr>
        <tr>
            <td>{!! Form::label('telefon','Telefon:') !!} </td>
             <td>{!! Form::text('telefon') !!}       </td>
        </tr>
        <tr>
             <td>{!! Form::label('email','E-mail:') !!}  </td>
             <td>{!! Form::text('email') !!} </td>
        </tr>
        <tr>
             <td>{!! Form::label('username','Korisnicko ime:') !!} </td>
             <td>{!! Form::text('username') !!}</td>
        </tr>
        <tr>
             <td>{!! Form::label('password','Lozinka:') !!}     </td>
             <td>{!! Form::password('password') !!}  </td>
        </tr>
        <tr>
             <td>{!! Form::label('password_confirmation','Potvrda lozinke:') !!}   </td>
             <td>{!! Form::password('password_confirmation') !!}</td>
        </tr>
        <tr>
            <td colspan="2" align="right">{!! Form::submit("Dodaj moderatora")!!}    </td>
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