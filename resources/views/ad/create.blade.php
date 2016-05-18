@extends('layouts.auth')

@section('title')
    Dodaj novi oglas
@endsection

@section('content')
    <form method="post" action="{{url('ad/create')}}">
        {{csrf_field()}}
        <label>Ime grada:</label><input type="text" name="city"><br/>
        <label>Ime opstine:</label><input type="text" name="municipality"><br/>
        <label>Adresa:</label><input type="text" name="address"><br/>
        <label>Vrsta nekretnine:</label>
        {{ Form::select('real_estate_type', \SingletonApp\RealEstateType::helperSelect())}}<br/>
        <label>Tip oglasa:</label>
        {{Form::select('ad_type', ['Renting' => 'Izdavanje','Selling' =>'Prodaja'])}}<br/>
        <label>Struktura stana</label>
        {{Form::select('apartment_type', \SingletonApp\ApartmentType::helperSelect())}}<br/>
        @if(true)
            <label>Sprat</label>
            {{Form::select('floor_desc', \SingletonApp\FloorDescription::helperSelect())}}<br/>
        @endif
        @if(true)
            <label>Cena nekretnine:</label>
            {{Form::text('price')}}<br/>
        @else
            <label>Cena mesecno:</label>
            {{Form::text('price')}}<br/>
        @endif
        <label>Opis:</label>
        {{Form::textarea('description')}}<br/>


    </form>
@endsection