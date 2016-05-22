@extends(Auth::user()->isPlebs() ? 'dashboard.user.userdash' :
    (Auth::user()->isModerator() ? 'moderator.moddash' : 'admin.admindash'))

@section('title')
    Dodaj novi oglas za prodaju
@endsection

@section('headScript')
    <link href="/fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/fileinput/js/fileinput.min.js"></script>
@endsection

@section('dash-content')
        {{Form::open(['url' => url('ad/create') , 'method' => 'post', 'files'=>true])}}
        {{Form::label('city', 'Ime grada:')}}
        {{Form::text('city', $value = old('city'))}}
        @if($errors->has('city'))
            <strong class="alert-warning">{{$errors->first('city')}}</strong>
        @endif
        <br/>
        {{Form::label('municipality', 'Ime opstine:')}}
        {{Form::text('municipality', $value = old('municipality'))}}
        @if($errors->has('municipality'))
            <strong class="alert-warning">{{$errors->first('municipality')}}</strong>
        @endif
        <br/>
        {{Form::label('address', 'Adresa:')}}
        {{Form::text('address', $value = old('address'))}}
        @if($errors->has('address'))
            <strong class="alert-warning">{{$errors->first('address')}}</strong>
        @endif<br/>
        {{Form::label('real_estate_type_id', 'Vrsta nekretnine:')}}
        {{Form::select('real_estate_type_id', \RealEstate\RealEstateType::helperSelect())}}<br/>
        {{Form::label('ad_type', 'Tip oglasa:')}}
        {{Form::select('ad_type', ['Renting' => 'Izdavanje','Selling' =>'Prodaja'])}}<br/>
        {{Form::label('apartment_type_id', 'Struktura stana:')}}
        {{Form::select('apartment_type_id', \RealEstate\ApartmentType::helperSelect(), old('apartment_type_id'))}}<br/>
        @if(true)
            {{Form::label('floor_desc', 'Sprat:')}}
            {{Form::select('floor_desc', \RealEstate\FloorDescription::helperSelect(), '1')}}<br/>
        @endif
        {{Form::label('price', 'Cena nekretnine:')}}
        {{Form::text('price', $value = old('price'))}}
        @if($errors->has('price'))
            <strong class="alert-warning">{{$errors->first('price')}}</strong>
        @endif
        <br/>
        {{Form::label('floor_area', 'Kvadratura:')}}
        {{Form::text('floor_area', $value = old('floor_area'))}}
        @if($errors->has('floor_area'))
            <strong class="alert-warning">{{$errors->first('floor_area')}}</strong>
        @endif
        <br/>
        {{Form::label('description', 'Opis:')}}
        {{Form::textarea('description')}}
        @if($errors->has('description'))
            <strong class="alert-warning">{{$errors->first('description')}}</strong>
        @endif
        <br/>
        {{Form::label('num_of_rooms', 'Broj soba:')}}
        {{Form::input('text', 'num_of_rooms')}}
        @if($errors->has('num_of_rooms'))
            <strong class="alert-warning">{{$errors->first('num_of_rooms')}}</strong>
        @endif
        <br/>
        {{Form::label('text', 'Broj kupatila')}}
        {{Form::input('text', 'num_of_bathrooms')}}
        @if($errors->has('num_of_bathrooms'))
            <strong class="alert-warning">{{$errors->first('num_of_bathrooms')}}</strong>
        @endif
        <br/>
        {{Form::label('construction_year',' Godina izgradnje:')}}
        {{Form::input('text', 'construction_year')}}
        @if($errors->has('construction_year'))
            <strong class="alert-warning">{{$errors->first('construction_year')}}</strong>
        @endif
        <br/>
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
        {{Form::label('woodwork_type_id','Drvenarija')}}
        {{Form::select('woodwork_type_id', \RealEstate\WoodworkType::helperSelect())}}<br/>
        {{Form::label('furniture_desc_id','Namestenost:')}}
        {{Form::select('furniture_desc_id', \RealEstate\FurnitureDescription::helperSelect())}}<br/>
        {{Form::label('note', 'Napomena')}}
        {{Form::textarea('note')}}
        <div class="form-group">
            {{Form::label('images','Slike:',['data-toggle'=>'tooltip' ,'title' => 'Shift-Click za vise slika'])}}<sup>?</sup>
            {!! Form::file('images[]',['id' => 'input-images', 'multiple']) !!}
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            <strong class="alert-warning"></strong>
        </div>
        @if($errors->has('note'))
            <strong class="alert-warning">{{$errors->first('note')}}</strong>
        @endif
        <br/>
        {{Form::submit('Posalji')}}
        {{Form::close()}}
@endsection

@section('scriptAfterLoad')
    <script>
        $(function () {
            $('#ad_create').addClass('active');
            $("#input-images").fileinput({'showUpload':false});
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
@endsection