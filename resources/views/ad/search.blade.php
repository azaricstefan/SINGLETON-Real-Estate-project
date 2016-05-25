@extends('layouts.bootstrap')

@section('title')
    Oglasi
@endsection

@section('headScript')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <link href="/fileinput/css/button.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/fileinput/css/text.css" media="all" rel="stylesheet" type="text/css" />
@endsection


@section('content')
    <div class="row" id="search-box">
        <div class="col-md-8 col-md-offset-2">
            {!! Form::open(['method' => 'GET', "role" => "form"]) !!}
            <div class="col-md-4 col-md-offset-2 col-md-pull-2 form-group">
                {!! Form::label("Tip oglasa") !!}
                {!! Form::select('ad_type', ['Renting' => 'Samo izdavanje','Selling' =>'Samo prodaja'], null, ["placeholder" => "Izdavanje i Prodaja", "class" => "form-control"]) !!}
            </div>
            <div class="col-md-4 col-md-pull-2 form-group">
                {!! Form::label("Tip nekretnine") !!}
                {!! Form::select('real_estate_type_id', \RealEstate\RealEstateType::helperSelect(), null, ["placeholder" => "Svi tipovi", "class" => "form-control"]) !!}
            </div>
            <div class="col-md-4 form-group">
                {!! Form::label("city" , "Grad:")!!}
                {!! Form::text('city', null, ["placeholder" => "Grad: ", "class" => "form-control"]) !!}
            </div>
            <div class="col-md-4 form-group">
                {!! Form::label("municipality" , "Opština: ")!!}
                {!! Form::text('municipality', null, ["placeholder" => "Deo grada / Opstina" ,"class" => "form-control"]) !!}
            </div>
            <div class="col-md-4 form-group">
                {!! Form::label("municipality" , "Ulica: ")!!}
                {!! Form::text('address', null, ["placeholder" => "Ulica", "class" => "form-control"]) !!}
            </div>
            <div class="col-md-4 col-md-offset-2 col-md-pull-2 form-group">
                {!! Form::label("price_from" , "Cena od: ")!!}
                {!! Form::text('price_from', null, ["placeholder" => "Cena od","class" => "form-control"]) !!}
            </div>
            <div class="col-md-4 col-md-pull-2 form-group">
                {!! Form::label("price_to" , "Cena do: ")!!}
                {!! Form::text('price_to', null, ["placeholder" => "Cena do","class" => "form-control"]) !!}
            </div>
            <div class="col-md-4 col-md-offset-2 col-md-pull-2 form-group">
                {!! Form::label("price_to" , "Kvadratura od: ")!!}
                {!! Form::text('area_from', null, ["placeholder" => "Kvadratura od","class" => "form-control"]) !!}
            </div>
            <div class="col-md-4 col-md-pull-2 form-group">
                {!! Form::label("price_to" , "Kvadratura do: ")!!}
                {!! Form::text('area_to', null, ["placeholder" => "Kvadratura do","class" => "form-control"]) !!}
            </div>
            <div class="col-md-4 form-group">
                {!! Form::label("Uknjizenost")!!}
                {!! Form::select('documentation', ["1" => "Uknjižen", 0 => "Neuknjižen"], null, ["placeholder" => "Sve", "class" => "form-control"]) !!}
            </div>
            <div class="col-md-4 form-group">
                {!! Form::label("Struktura stana")!!}
                {!! Form::select('apartment_type_id', \RealEstate\ApartmentType::helperSelect(), null, ["placeholder" => "Sve strukture", "class" => "form-control"]) !!}</div>
            <div class="col-md-4 form-group" >
                {!! Form::label("Spratovi") !!}
                {!! Form::select('floor_desc[]', \RealEstate\FloorDescription::helperSelect(), null, ["multiple" => "true", "class" => "form-control"]) !!}
            </div>
                <div class="col-md-4">
                    <div class="form-group">
                        @foreach(\RealEstate\HeatingOption::all() as $option)
                            <div class="row">
                            {!!Form::label("heat_$option->heating_option_id", $option->option_name)!!}
                            {!!Form::checkbox('heating_option_id[]', $option->heating_option_id , null,[ 'id' => "heat_$option->heating_option_id" ])!!}
                            </div>
                        @endforeach
                    </div>
                    <hr />
                    <div class="form-group">
                    @foreach(\RealEstate\FurnitureDescription::all() as $furniture_desc)
                        <div class="row">
                        {!!Form::label("fur_$furniture_desc->furniture_desc_id", $furniture_desc->description)!!}
                        {!!Form::checkbox('furniture_desc_id[]', $furniture_desc->furniture_desc_id , null,[ 'id' => "fur_$furniture_desc->furniture_desc_id" ])!!}
                        </div>
                    @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        @foreach(\RealEstate\ParkingOption::all() as $parking_option)
                            <div class="row">
                                {!!Form::label("park_$parking_option->parking_option_id", $parking_option->option_name)!!}
                                {!!Form::checkbox('parking_option_id[]', $parking_option->parking_option_id , null,[ 'id' => "park_$parking_option->parking_option_id" ])!!}
                            </div>
                        @endforeach
                    </div>
                    <hr />
                    <div class="form-group">
                        @foreach(\RealEstate\WoodworkType::all() as $woodwork_type)
                            <div class="row">
                                {!!Form::label("wood_$woodwork_type->woodwork_type_id", $woodwork_type->type_name)!!}
                                {!!Form::checkbox('woodwork_type_id[]', $woodwork_type->woodwork_type_id , null,[ 'id' => "wood_$woodwork_type->woodwork_type_id" ])!!}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        @foreach(\RealEstate\Addition::all() as $addition)
                            <div class="row">
                                {!!Form::label("add_$addition->addition_id", $addition->description)!!}
                                {!!Form::checkbox('addition_id[]', $addition->addition_id , null,[ 'id' => "add_$addition->addition_id" ])!!}
                            </div>
                        @endforeach
                    </div>
                </div>
            <div class="row">
                <div class="col-md-4">
                    {!! Form::submit("Pretraži", ["class" => "btn btn-default"]) !!}
                    <a href="/search" class="btn btn-default">Resetuj</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-2 col-md">
            <a id="hider" href="" class="btn btn-default">Toogle Search</a>
        </div>
    </div>
    <div class="row">
    @foreach($ads as $ad)
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <article>
                    <h3><div class = "naslov">{{$ad->getName()}}</div></h3>
                    <img class="img-responsive slika" style="float:left; width:250px" src="{{$ad->images()->first()==null?'#':$ad->images()->first()->image_path}}" alt="{{$ad->getName()}}" />
                    <div class="body pasus">
                        {{$ad->description}}
                    </div>
                    <a href="/ad/{{$ad->ad_id}}" class = "btn btn-default-reverse-text">Pogledaj oglas</a>
                </article>
                <div style="clear:both"></div>
                <!---<a href="/ad/{{$ad->ad_id}}" class = "btn btn-default-reverse">Pogledaj oglas</a>--->
                <hr>
            </div>
            <div class="col-md-3"></div>
        </div>
    @endforeach
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">{!! $ads->appends(request()->except("page") )->render()!!}</div>
    </div>

@endsection
@section('scriptAfterLoad')
    <script>
        $(document).ready(function(){
            $("#hider").click(function(e){
                e.preventDefault();
                $("#search-box").toggle(300);
            });
            $("#search-box").hide();
        });
    </script>
@endsection