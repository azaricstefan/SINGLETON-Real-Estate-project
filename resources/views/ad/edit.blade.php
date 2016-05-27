@extends('layouts.bootstrap')

@section('title')
    Dodaj novi oglas za prodaju
@endsection

@section('headScript')
    <link href="/fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/fileinput/js/fileinput.min.js"></script>
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')
        {{Form::open(['method' => 'post'])}}
        {{ method_field('PATCH') }}
        {{Form::label('city', 'Ime grada:')}}
        {{Form::text('city', $value = $ad->city, ["class" => "form-control"])}}
        @if($errors->has('city'))
            <strong class="alert-warning">{{$errors->first('city')}}</strong>
        @endif
        <br/>
        {{Form::label('municipality', 'Ime opstine:')}}
        {{Form::text('municipality', $value = $ad->municipality, ["class" => "form-control"])}}
        @if($errors->has('municipality'))
            <strong class="alert-warning">{{$errors->first('municipality')}}</strong>
        @endif
        <br/>

        {{Form::label('address', 'Adresa:')}}
        {{Form::text('address', $value = $ad->address, ["class" => "form-control"])}}
        @if($errors->has('address'))
            <strong class="alert-warning">{{$errors->first('address')}}</strong>
        @endif<br/>
        {{Form::label('real_estate_type_id', 'Vrsta nekretnine:')}}
        {{ Form::select('real_estate_type_id', \RealEstate\RealEstateType::helperSelect(), $ad->real_estate_type_id, array('class'=>'form-control'))}}<br/>
        {{Form::label('ad_type', 'Tip oglasa:')}}
        {{Form::select('ad_type', ['Renting' => 'Izdavanje','Selling' =>'Prodaja'], $ad->ad_type, array('class'=>'form-control'))}}<br/>
        {{Form::label('apartment_type_id', 'Struktura stana:')}}
        {{Form::select('apartment_type_id', \RealEstate\ApartmentType::helperSelect(), $ad->apartment_type_id, array('class'=>'form-control'))}}<br/>
        @if(true)
            {{Form::label('floor_desc', 'Sprat:')}}
            {{Form::select('floor_desc', \RealEstate\FloorDescription::helperSelect(), $ad->floor_desc, array('class'=>'form-control'))}}<br/>
        @endif
        {{Form::label('price', 'Cena nekretnine:')}}
        {{Form::text('price', $value = $ad->price), ["class" => "form-control"]}}
        @if($errors->has('price'))
            <strong class="alert-warning">{{$errors->first('price')}}</strong>
        @endif
        <br/>
        {{Form::label('floor_area', 'Kvadratura:')}}
        {{Form::number('floor_area', $value = old('floor_area'), ["class" => "form-control"])}}
        @if($errors->has('floor_area'))
            <strong class="alert-warning">{{$errors->first('floor_area')}}</strong>
        @endif
        <br/>
        {{Form::label('description', 'Opis:')}}
        {{Form::textarea('description', $ad->description, array('class'=>'form-control'))}}
        @if($errors->has('description'))
            <strong class="alert-warning">{{$errors->first('description')}}</strong>
        @endif
        <br/>
        {{Form::label('num_of_rooms', 'Broj soba:')}}
        {{Form::input('number', 'num_of_rooms', $value = $ad->num_of_rooms, ["class" => "form-control"])}}
        @if($errors->has('num_of_rooms'))
            <strong class="alert-warning">{{$errors->first('num_of_rooms')}}</strong>
        @endif
        <br/>
        {{Form::label('text', 'Broj kupatila')}}
        {{Form::input('number', 'num_of_bathrooms', $value = $ad->num_of_bathrooms, ["class" => "form-control"])}}
        @if($errors->has('num_of_bathrooms'))
            <strong class="alert-warning">{{$errors->first('num_of_bathrooms')}}</strong>
        @endif
        <br/>
        {{Form::label('construction_year',' Godina izgradnje:')}}
        {{Form::input('number', 'construction_year', $value = $ad->construction_year, ["class" => "form-control"])}}
        @if($errors->has('construction_year'))
            <strong class="alert-warning">{{$errors->first('construction_year')}}</strong>
        @endif
        <br/>
        {{Form::label('documentation', 'Uknjizenost')}}
        {{Form::select('documentation', ['1' => 'Da' , '0' => 'Ne'], $ad->documentation, array('class'=>'form-control'))}}<br/>
        {{Form::label('heating_option_id', 'Grejanje')}}
        {{Form::select('heating_option_id', \RealEstate\HeatingOption::helperSelect(), $ad->heating_option_id, array('class'=>'form-control'))}}<br/>
        {{Form::label('addition_id', 'Osnovna opremljenost:')}}<br/>
        <?php $check = false; ?>
        @foreach(\RealEstate\Addition::all() as $addition)
            {{Form::label($addition->description, $addition->description)}}
            @foreach($ad->hasAdditions as $oneAddition)
                <?php
                        $check = false;
                        if ($oneAddition->addition_id == $addition->addition_id){
                            $check = true;
                            break; //javlja gresku zato sto se koristi blejdov @foreach a ne php kod i misli da zelim da brejkujem iz 1 if a ne petlje
                        }
                ?>
            @endforeach
            {{Form::checkbox('addition_id[]', $addition->addition_id, $check , [ 'id' => $addition->description])}}<br/>
        @endforeach
        {{Form::label('parking_option_id', 'Parking:')}}
        {{Form::select('parking_option_id', \RealEstate\ParkingOption::helperSelect(), $ad->parking_option, array('class'=>'form-control'))}}<br/>
        {{Form::label('woodwork_type_id', 'Drvenarija')}}
        {{Form::select('woodwork_type_id', \RealEstate\WoodworkType::helperSelect(), $ad->woodwork_type_id, array('class'=>'form-control'))}}<br/>
        {{Form::label('furniture_desc_id','Namestenost:')}}
        {{Form::select('furniture_desc_id', \RealEstate\FurnitureDescription::helperSelect(), $ad->furniture_desc_id, array('class'=>'form-control'))}}<br/>
        {{Form::label('note', 'Napomena')}}
        {{Form::textarea('note', $ad->note), array('class'=>'form-control')}}
        @if($errors->has('note'))
            <strong class="alert-warning">{{$errors->first('note')}}</strong>
        @endif
        <br/>
        {{Form::submit('Posalji', ["class" => "btn btn-default"])}}
        {{Form::close()}}
        <hr>
        <div class="form-group">
            {{Form::label('Slike')}}
            {!! Form::file('images[]',['id' => 'input-images', 'multiple', 'class'=>'file-loading']) !!}
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>

@endsection

@section('scriptAfterLoad')
    <script>
        $("#input-images").fileinput({
            uploadUrl: "/ad/{{$ad->ad_id}}/images/upload",
            deleteUrl: "/ad/{{$ad->ad_id}}/images/delete",
            minFileCount: 1,
            initialPreview:[
                @foreach($ad->images as $image)
                        "{{ url($image->image_path)}}",
                @endforeach
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            overwriteInitial: false,
            initialPreviewConfig:[
                    @foreach($ad->images as $image)
                {
                    key:{{$image->image_id}},//ignorisi gresku sve je ok kada se stranica renederuje
                },
                @endforeach
            ],
            uploadExtraData: {_token: "{{csrf_token()}}"},
            deleteExtraData: {_token: "{{csrf_token()}}"}
        }).on("filepredelete", function(jqXHR) {
            var abort = true;
            if (confirm("Da li ste sigurni da zelite da obrisete sliku?")) {
                abort = false;
            }
            return abort; // you can also send any data/object that you can receive on `filecustomerror` event
        });
    </script>
@endsection

