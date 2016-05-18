@extends('dashboard.layout')

@section('title')
    Oglas: {{$ad->ad_id}}
@endsection

@section('content')
    <a href="../myads">Nazad</a>
    @if($ad->checkPermissionToEdit())
        |<a href="{{$ad->ad_id}}/edit">Izmeni</a>
    @endif
    <br/>
    {{Form::label(null, 'Postavljen: ')}}
    {{Form::label(null, $ad->post_date)}}<br/>
    {{Form::label(null, 'Ime grada:')}}
    {{Form::label(null, $ad->city)}}<br/>
    {{Form::label(null, 'Opstina:')}}
    {{Form::label(null, $ad->municipality)}}<br/>
    {{Form::label(null, 'Adresa:')}}
    {{Form::label(null, $ad->address)}}<br/>
    {{Form::label(null, 'Vrsta nekretnine:')}}
    {{Form::label(null, $ad->realEstateType->type_name)}}<br/>
    {{Form::label(null, 'Tip oglasa:')}}
    {{Form::label(null, (($ad->ad_type == 'Renting') ? 'Izdavanje' : 'Prodaja'))}}<br/>
    {{Form::label(null, 'Struktura stana:')}}
    {{Form::label(null, $ad->apartmentType->type_name)}}<br/>
    {{Form::label(null, 'Sprat:')}}
    {{Form::label(null, $ad->floorDescription->description)}}<br/>
    {{Form::label(null, 'Cena nekretnine:')}}
    {{Form::label(null, $ad->price)}}<br/>
    {{Form::label(null, 'Kvadratura:')}}
    {{Form::label(null, $ad->floor_area)}}<br/>
    {{Form::label(null, 'Opis:')}}
    {{Form::label(null, $ad->description)}}<br/>
    {{Form::label(null, 'Broj soba:')}}
    {{Form::label(null, $ad->num_of_rooms)}}<br/>
    {{Form::label(null, 'Broj kupatila:')}}
    {{Form::label(null, $ad->num_of_bathrooms)}}<br/>
    {{Form::label(null, 'Godina izgradnje:')}}
    {{Form::label(null, $ad->construction_year)}}<br/>
    {{Form::label(null, 'Uknjiženost:')}}
    {{Form::label(null, $ad->documentation)}}<br/>
    {{Form::label(null, 'Grejanje:')}}
    {{Form::label(null, $ad->heatingOption->option_name)}}<br/>
    {{Form::label(null, 'Osnovna opremljenost:')}}<br/>
    <ol>
        @foreach($ad->hasAdditions as $addition)
            <li>
                {{Form::label(null, $addition->addition->description)}}
            </li>
        @endforeach
    </ol>
    {{Form::label(null, 'Parking:')}}
    {{Form::label(null, $ad->parkingOption->option_name)}}<br/>
    {{Form::label(null, 'Drvenarija:')}}
    {{Form::label(null, $ad->woodWorkType->type_name)}}<br/>
    {{Form::label(null, 'Namestenost:')}}
    {{Form::label(null, $ad->furnitureDescription->description)}}<br/>
    {{Form::label(null, 'Napomena:')}}
    {{Form::label(null, $ad->note)}}<br/>
    @foreach($ad->comments as $comment)
        <fieldset>
            <legend>{{$comment->user->username}}
                @if((!Auth::guest()) && ($ad->user_id != $comment->user->user_id))
                    | <a href="{{url('comment/'.$comment->comment_id).'/report'}}">Prijavi komentar</a>
                @endif
            </legend>
            {{$comment->body}}
        </fieldset>
    @endforeach
    {{Form::open(['method' => 'POST', 'url' => url('comment/add')])}}
    {{Form::hidden('ad_id', $ad->ad_id)}}
    <table width="100%">
        <tr>
            <td>
                {{Form::textarea('body',null,['style' => 'width:100%;','rows' => '5'])}}<br/>
            </td>
        </tr>
    </table>
    {{Form::submit('Posalji Komentar')}}
    {{Form::close()}}
@endsection