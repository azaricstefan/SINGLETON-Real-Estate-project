@extends('layouts.auth')

@section('title')
    Dodaj novi oglas za prodaju
@endsection

@section('content')
    <form method="post" action="{{url('ad/create')}}">
        {{csrf_field()}}
        <label>Ime grada:</label><input type="text" name="city"><br/>
        <label>Ime opstine:</label><input type="text" name="municipality"><br/>
        <label>Adresa:</label><input type="text" name="address"><br/>
        <label>Vrsta nekretnine:</label>
        {{ Form::select('real_estate_type_id', \RealEstate\RealEstateType::helperSelect())}}<br/>
        <label>Tip oglasa:</label>
        {{Form::select('ad_type', ['Renting' => 'Izdavanje','Selling' =>'Prodaja'])}}<br/>
        <label>Struktura stana</label>
        {{Form::select('apartment_type_id', \RealEstate\ApartmentType::helperSelect())}}<br/>
        @if(true)
            <label>Sprat</label>
            {{Form::select('floor_desc', \RealEstate\FloorDescription::helperSelect(), '1')}}<br/>
        @endif
        <label>Cena nekretnine:</label>
        {{Form::text('price')}}<br/>
        {{Form::label('floor_area', 'Kvadratura:')}}
        {{Form::text('floor_area')}}<br/>
        <label>Opis:</label>
        {{Form::textarea('description')}}<br/>
        <label>Broj soba</label>
        {{Form::input('text', 'num_of_rooms')}}<br/>
        <label>Broj kupatila</label>
        {{Form::input('text', 'num_of_bathrooms')}}<br/>
        <label>Godina izgradnje</label>
        {{Form::input('text', 'construction_year')}}<br/>
        {{Form::label('documentation', 'Uknjizenost')}}
        {{Form::select('documentation', ['1' => 'Da' , '0' => 'Ne'])}}<br/>
        {{Form::label('heating_option_id', 'Grejanje')}}
        {{Form::select('heating_option_id', \RealEstate\HeatingOption::helperSelect())}}<br/>
        {{Form::label('addition_id', 'Osnovna opremljenost:')}}<br/>
        @foreach(\RealEstate\Addition::all() as $addition)
            {{Form::label($addition->description, $addition->description)}}
            {{Form::checkbox('addition_id[]', $addition->addition_id,false, [ 'id' => $addition->description])}}<br/>
        @endforeach
        {{Form::label('parking_option_id', 'Parking:')}}
        {{Form::select('parking_option_id', \RealEstate\ParkingOption::helperSelect())}}<br/>
        {{Form::label('woodwork_type_id')}}
        {{Form::select('woodwork_type_id', \RealEstate\WoodworkType::helperSelect())}}<br/>
        {{Form::label('furniture_desc_id','Namestenost:')}}
        {{Form::select('furniture_desc_id', \RealEstate\FurnitureDescription::helperSelect())}}<br/>
        {{Form::label('note', 'Napomena')}}
        {{Form::textarea('note')}}<br/>
        {{Form::submit('Posalji')}}
    </form>
@endsection