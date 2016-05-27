@extends(Auth::user()->isPlebs() ? 'dashboard.user.userdash' :
    (Auth::user()->isModerator() ? 'moderator.moddash' : 'admin.admindash'))

@section('title')
    Dodaj novi oglas za prodaju
@endsection

@section('headScript')
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/button.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/forma.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/fileinput/js/fileinput.min.js"></script>
@endsection

@section('dash-content')
    <div class = "forma col-md-6">
        {{Form::open(['url' => url('ad/create') , 'method' => 'post', 'files'=>true])}}
        {{Form::label('city', 'Ime grada:')}}
        {{Form::text('city', $value = old('city'), ["class" => "form-control"])}}
        @if($errors->has('city'))
                <strong class="alert-warning">{{$errors->first('city')}}</strong>
        @endif
        <br/>
        {{Form::label('municipality', 'Ime opstine:')}}
        {{Form::text('municipality', $value = old('municipality'), ["class" => "form-control"])}}
        @if($errors->has('municipality'))
            <strong class="alert-warning">{{$errors->first('municipality')}}</strong>
        @endif
        <br/>
        {{Form::label('address', 'Adresa:')}}
        {{Form::text('address', $value = old('address'), ["class" => "form-control"])}}
        @if($errors->has('address'))
            <strong class="alert-warning">{{$errors->first('address')}}</strong>
        @endif<br/>
        {{Form::label('real_estate_type_id', 'Vrsta nekretnine:')}}
        {{Form::select('real_estate_type_id', \RealEstate\RealEstateType::helperSelect(),old('real_estate_type_id'), array('class'=>'form-control'))}}<br/>
        {{Form::label('ad_type', 'Tip oglasa:')}}
        {{Form::select('ad_type', ['Renting' => 'Izdavanje','Selling' =>'Prodaja'], old('ad_type'), array('class'=>'form-control'))}}<br/>
        {{Form::label('apartment_type_id', 'Struktura stana:')}}
        {{Form::select('apartment_type_id', \RealEstate\ApartmentType::helperSelect(), old('appartment_type_id'), array('class'=>'form-control'))}}<br/>
        @if(true)
            {{Form::label('floor_desc', 'Sprat:')}}
            {{Form::select('floor_desc', \RealEstate\FloorDescription::helperSelect(), '1', array('class'=>'form-control'))}}<br/>
        @endif
        {{Form::label('price', 'Cena nekretnine:')}}
        {{Form::number('price', $value = old('price'), ["class" => "form-control"])}}
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
        {{Form::textarea('description', $value = old('description'), array('class'=>'form-control'))}}
        @if($errors->has('description'))
            <strong class="alert-warning">{{$errors->first('description')}}</strong>
        @endif
        <br/>
        {{Form::label('num_of_rooms', 'Broj soba:')}}
        {{Form::input('number', 'num_of_rooms',$value = old('num_of_rooms'), ["class" => "form-control"])}}
        @if($errors->has('num_of_rooms'))
            <strong class="alert-warning">{{$errors->first('num_of_rooms')}}</strong>
        @endif
        <br/>
        {{Form::label('text', 'Broj kupatila')}}
        {{Form::input('number', 'num_of_bathrooms',$value = old('num_of_bathrooms'), ["class" => "form-control"])}}
        @if($errors->has('num_of_bathrooms'))
            <strong class="alert-warning">{{$errors->first('num_of_bathrooms')}}</strong>
        @endif
        <br/>
        {{Form::label('construction_year',' Godina izgradnje:')}}
        {{Form::input('number', 'construction_year',$value = old('construction_year'), ["class" => "form-control"])}}
        @if($errors->has('construction_year'))
            <strong class="alert-warning">{{$errors->first('construction_year')}}</strong>
        @endif
        <br/>
        {{Form::label('documentation', 'Uknjizenost')}}
        {{Form::select('documentation', ['1' => 'Da' , '0' => 'Ne'], old('documentation'), array('class'=>'form-control'))}}<br/>
        {{Form::label('heating_option_id', 'Grejanje')}}
        {{Form::select('heating_option_id', \RealEstate\HeatingOption::helperSelect(), old('heating_option_id'), array('class'=>'form-control'))}}<br/>
        {{Form::label('addition_id', 'Osnovna opremljenost:')}}<br/>
        @foreach(\RealEstate\Addition::all() as $addition)
            <div class = "check">
                {{Form::checkbox('addition_id[]', $addition->addition_id,false, [ 'id' => $addition->description])}}
                {{Form::label($addition->description, $addition->description)}}
            </div>
        @endforeach
        <br>
        {{Form::label('parking_option_id', 'Parking:')}}
        {{Form::select('parking_option_id', \RealEstate\ParkingOption::helperSelect(), old('parking_option_id'), array('class'=>'form-control'))}}<br/>
        {{Form::label('woodwork_type_id','Drvenarija')}}
        {{Form::select('woodwork_type_id', \RealEstate\WoodworkType::helperSelect(), old('woodwork_type_id'), array('class'=>'form-control'))}}<br/>
        {{Form::label('furniture_desc_id','Namestenost:')}}
        {{Form::select('furniture_desc_id', \RealEstate\FurnitureDescription::helperSelect(), old('furniture_desc_id'), array('class'=>'form-control'))}}<br/>
        {{Form::label('note', 'Napomena')}}
        {{Form::textarea('note', $value = old('note'), array('class'=>'form-control'))}}
        <div class="form-group">
            {{Form::label('images','Slike:',['data-toggle'=>'tooltip' ,'title' => 'Shift-Click za više slika'])}}<sup>?</sup>
            {!! Form::file('images[]',['id' => 'input-images', 'multiple', 'accept' => 'image/x-png, image/gif, image/jpeg']) !!}
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            <strong class="alert-warning"></strong>
        </div>
        @if($errors->has('note'))
            <strong class="alert-warning">{{$errors->first('note')}}</strong>
        @endif
        <br/>
        {{Form::submit('Pošalji', ["class" => "btn btn-default"])}}
        {{Form::close()}}
    </div>
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