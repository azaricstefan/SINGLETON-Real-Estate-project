@extends('dashboard.layout')

@section('content')
    <h1>Oglasi korisnika: {{Auth::user()->username}}</h1><br/>
    <a href="{{url('dashboard')}}">Nazad na dashboard</a>
    <ol>
    @foreach($myads as $ad)
        <li>
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
            {{Form::label(null, $ad->add_type)}}<br/>
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
            {{Form::label(null, $ad->woodWorkType->option_name)}}<br/>
            {{Form::label(null, 'Namestenost:')}}
            {{Form::label(null, $ad->furnitureDescription->description)}}<br/>
            {{Form::label(null, 'Napomena:')}}
            {{Form::label(null, $ad->note)}}<br/>

        </li>
    @endforeach
    </ol>
@endsection