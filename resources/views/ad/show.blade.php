@extends('layouts.bootstrap')

@section('title')
    Oglas: {{$ad->ad_id}}
@endsection

@section('headScript')
    <link href="/lightbox/css/lightbox.css" rel="stylesheet"/>
@endsection

@section('content')
    <a href="{{url('myads')}}">Nazad na moje oglase</a>
    @if($ad->checkPermissionToEdit())
        |<a href="{{$ad->ad_id}}/edit">Izmeni</a> | <a href="{{url('ad/'.$ad->ad_id.'/delete')}}">Obrisi</a>
        @if((Auth::user()->isAdmin() || Auth::user()->isModerator()) && $ad->approvement_status == "Pending")
            |<a href="{{$ad->ad_id}}/approve">Odobri</a>| <a href="{{$ad->ad_id}}/deny">Zabrani</a>
        @endif
    @endif
    | <a href="{{url('appointments/'.$ad->ad_id.'/all7days')}}">Zakazi termin</a>
    @if($ad->approvement_status == "Pending")
        <br/><span id="approvement_status_msg">Oglas jos nije odobren!</span><br/>
    @elseif($ad->approvement_status == "Denied")
        <br/><span id="approvement_status_msg">Oglas je odbijen!</span><br/>
    @endif
    <br/>
    @if($errors->has('body'))
        <strong class="alert-warning">{{$errors->first('body')}}</strong><br/>
    @endif
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
    {{Form::label('Slike')}}
    <div>
        @foreach($ad->images as $image)
            <a href="{{$image->image_path}}" data-lightbox="galerija">
                <img src="{{$image->image_path}}" class="img-thumbnail" alt="{{$ad->getName()}}" width="250" />
            </a>
        @endforeach
    </div>
    @foreach($ad->comments as $comment)
        <fieldset>
            <legend>{{$comment->user->username}}
                @if((!Auth::guest()) && (Auth::user()->user_id != $comment->user->user_id) && Auth::user()->isPlebs())
                    | <a href="{{url('comment/'.$comment->comment_id.'/report')}}">Prijavi komentar</a>
                @elseif(!Auth::guest() && (Auth::user()->isAdmin() || Auth::user()->isModerator()))
                    | <a href="{{url('comment/'.$comment->comment_id.'/delete')}}">Obrisi komentar</a>
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

@section('scriptAfterLoad')
    <script src="/lightbox/js/lightbox.js"></script>
@endsection