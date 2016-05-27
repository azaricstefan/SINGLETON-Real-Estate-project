@extends('layouts.bootstrap')

@section('title')
    Oglas: {{$ad->ad_id}}
@endsection

@section('headScript')
    <link href="/lightbox/css/lightbox.css" rel="stylesheet"/>
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/button.css" media="all" rel="stylesheet" type="text/css" />
@endsection


@section('nav-bar')
    @if(Auth::guest())
        <ul class="nav navbar-nav">
            <li><a href="{{url('/')}}">Početna strana</a></li>
            <li><a href="{{url('search')}}">Pretraži oglase</a></li>
            <li><a href="{{url('ad/create')}}">Dodaj oglas</a></li>
            <li><a href="#info">Informacija o nama</a></li>
            {{--TODO: DODATI STRANICU SA INFORMACIJAMA O AGENCIJI--}}
        </ul>
    @else
        <ul class="nav navbar-nav">
            <li><a href="{{url('/')}}">Početna strana</a></li>
            <li><a href="{{url('dashboard')}}">Dashboard</a></li>
            <li><a href="{{url('search')}}">Pretraži oglase</a></li>
        </ul>
    @endif
@endsection


@section('content')

    {{--Opcije za oglas--}}
    <div class="row">
        <button type="button" class="btn btn-default" onclick="location.href='{{url('myads')}}'">Nazad na moje oglase</button>
        @if($ad->checkPermissionToEdit())
            <button type="button" class="btn btn-default" onclick="location.href='{{$ad->ad_id}}/edit'">Izmeni</button>
            <button type="button" class="btn btn-default" onclick="location.href='{{url('ad/'.$ad->ad_id.'/delete')}}'">Obriši</button>

            {{--Opcije ako je oglas tek postavljen--}}
            @if((Auth::user()->isAdmin() || Auth::user()->isModerator()) && $ad->approvement_status == "Pending")
                <button type="button" class="btn btn-primary" onclick="location.href='{{$ad->ad_id}}/approve'">Odobri</button>
                <button type="button" class="btn btn-default" onclick="location.href='{{$ad->ad_id}}/deny'">Zabrani</button>
            @endif
        @endif
        <button type="button" class="btn btn-default" onclick="location.href='{{url('appointments/'.$ad->ad_id.'/all')}}'">Zakaži termin</button>
        @if($ad->approvement_status == "Pending")
            <br/><span id="approvement_status_msg">Oglas još nije odobren!</span><br/>
        @elseif($ad->approvement_status == "Denied")
            <br/><span id="approvement_status_msg">Oglas je odbijen!</span><br/>
        @endif
    </div>
    {{--Gotov meni za oglas--}}

    <br/>
    @if($errors->has('body'))
        <strong class="alert-warning">{{$errors->first('body')}}</strong><br/>
    @endif
    <i>
    {{Form::label(null, 'Oglas je postavljen: ')}}
    {{Form::label(null, $ad->post_date)}}
    </i><br/>

    {{--PRIMARNA SLIKA--}}

    <div>
            <a href="{{$ad->images[0]->image_path}}" data-lightbox="galerija">
                <img src="{{$ad->images[0]->image_path}}" class="img-thumbnail" alt="{{$ad->getName()}}" width="250" />
            </a>
    </div>

    {{--KRAJ SLIKE--}}

    {{--tabovi sa tabelama pocinje ovde--}}
    <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Osnovne informacije</a>
            </li>
            <li role="presentation">
                <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Opremljenost</a>
            </li>
            <li role="presentation">
                <a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Adresa nekretnine</a>
            </li>
            <li role="presentation">
                <a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">Detaljnije</a>
            </li>
            <li role="presentation">
                <a href="#tab5" aria-controls="tab5" role="tab" data-toggle="tab">Napomena</a>
            </li>
            <li role="presentation">
                <a href="#tab6" aria-controls="tab6" role="tab" data-toggle="tab">Galerija</a>
            </li>
            <li role="presentation">
                <a href="#tab7" aria-controls="tab7" role="tab" data-toggle="tab">Komentari</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            {{--content za osnovne informacije--}}
            <div role="tabpanel" class="tab-pane active" id="tab1">
                <div class="table-striped">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Tip oglasa</th>
                            <th>Vrsta Nekretnine</th>
                            <th>Struktura stana</th>
                            <th>Površina</th>
                            <th>Nameštenost</th>
                            <th>Cena</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{(($ad->ad_type == 'Renting') ? 'Izdavanje' : 'Prodaja')}}</td>
                            <td>{{$ad->realEstateType->type_name}}</td>
                            <td>{{$ad->apartmentType->type_name}}</td>
                            <td>{{$ad->floor_area}} m<sup>2</sup></td>
                            <td>{{$ad->furnitureDescription->description}}</td>
                            <td>{{$ad->price}} €</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{--content za opremljenost--}}
            <div role="tabpanel" class="tab-pane" id="tab2">
                {{Form::label(null, 'Osnovna opremljenost:')}}<br/>
                @foreach($ad->hasAdditions as $addition)
                    <li>
                        {{Form::label(null, $addition->addition->description)}}
                    </li>
                @endforeach
            </div>

            {{--content za adresu i slicne podatke--}}
            <div role="tabpanel" class="tab-pane" id="tab3">
                {{Form::label(null, 'Ime grada:')}}
                {{Form::label(null, $ad->city)}}<br/>
                {{Form::label(null, 'Opština:')}}
                {{Form::label(null, $ad->municipality)}}<br/>
                {{Form::label(null, 'Adresa:')}}
                {{Form::label(null, $ad->address)}}<br/>
                {{Form::label(null, 'Sprat:')}}
                {{Form::label(null, $ad->floorDescription->description)}}<br/>
            </div>

            {{--content o prostorijama--}}
            <div role="tabpanel" class="tab-pane" id="tab4">
                {{Form::label(null, 'Godina izgradnje:')}}
                {{Form::label(null, $ad->construction_year)}}<br/>
                {{Form::label(null, 'Uknjiženost:')}}
                {{Form::label(null, $ad->documentation)}}<br/>
                {{Form::label(null, 'Opis:')}}
                {{Form::label(null, $ad->description)}}<br/>
                {{Form::label(null, 'Broj soba:')}}
                {{Form::label(null, $ad->num_of_rooms)}}<br/>
                {{Form::label(null, 'Broj kupatila:')}}
                {{Form::label(null, $ad->num_of_bathrooms)}}<br/>
                {{Form::label(null, 'Grejanje:')}}
                {{Form::label(null, $ad->heatingOption->option_name)}}<br/>
                {{Form::label(null, 'Parking:')}}
                {{Form::label(null, $ad->parkingOption->option_name)}}<br/>
                {{Form::label(null, 'Drvenarija:')}}
                {{Form::label(null, $ad->woodWorkType->type_name)}}<br/>
            </div>

            {{--content napomena--}}
            <div role="tabpanel" class="tab-pane" id="tab5">
                {{Form::label(null, 'Napomena:')}}
                {{Form::label(null, $ad->note)}}<br/>
            </div>

            {{--content za slike--}}
            <div role="tabpanel" class="tab-pane" id="tab6">
                <div>
                    @foreach($ad->images as $image)
                        <a href="{{$image->image_path}}" data-lightbox="galerija">
                            <img src="{{$image->image_path}}" class="img-thumbnail" alt="{{$ad->getName()}}" width="250" />
                        </a>
                    @endforeach
                </div>
            </div>

            {{--content za komentare--}}
            <div role="tabpanel" class="tab-pane" id="tab7">
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
                {{Form::open(['method' => 'GET', 'url' => url('comment/add')])}}
                {{Form::hidden('ad_id', $ad->ad_id)}}
                <table width="100%">
                    <tr>
                        <td>
                            {{Form::textarea('body',null,['style' => 'width:100%;','rows' => '5'])}}<br/>
                        </td>
                    </tr>
                </table>
                {{Form::submit('Pošalji Komentar')}}
                {{Form::close()}}
            </div>
        </div>
    </div>


    {{--{{Form::label(null, 'Postavljen: ')}}--}}
    {{--{{Form::label(null, $ad->post_date)}}<br/>--}}
    {{--{{Form::label(null, 'Ime grada:')}}--}}
    {{--{{Form::label(null, $ad->city)}}<br/>--}}
    {{--{{Form::label(null, 'Opština:')}}--}}
    {{--{{Form::label(null, $ad->municipality)}}<br/>--}}
    {{--{{Form::label(null, 'Adresa:')}}--}}
    {{--{{Form::label(null, $ad->address)}}<br/>--}}
    {{--{{Form::label(null, 'Vrsta nekretnine:')}}--}}
    {{--{{Form::label(null, $ad->realEstateType->type_name)}}<br/>--}}
    {{--{{Form::label(null, 'Tip oglasa:')}}--}}
    {{--{{Form::label(null, (($ad->ad_type == 'Renting') ? 'Izdavanje' : 'Prodaja'))}}<br/>--}}
    {{--{{Form::label(null, 'Struktura stana:')}}--}}
    {{--{{Form::label(null, $ad->apartmentType->type_name)}}<br/>--}}
    {{--{{Form::label(null, 'Sprat:')}}--}}
    {{--{{Form::label(null, $ad->floorDescription->description)}}<br/>--}}
    {{--{{Form::label(null, 'Cena nekretnine:')}}--}}
    {{--{{Form::label(null, $ad->price)}}<br/>--}}
    {{--{{Form::label(null, 'Kvadratura:')}}--}}
    {{--{{Form::label(null, $ad->floor_area)}}<br/>--}}
    {{--{{Form::label(null, 'Opis:')}}--}}
    {{--{{Form::label(null, $ad->description)}}<br/>--}}
    {{--{{Form::label(null, 'Broj soba:')}}--}}
    {{--{{Form::label(null, $ad->num_of_rooms)}}<br/>--}}
    {{--{{Form::label(null, 'Broj kupatila:')}}--}}
    {{--{{Form::label(null, $ad->num_of_bathrooms)}}<br/>--}}
    {{--{{Form::label(null, 'Godina izgradnje:')}}--}}
    {{--{{Form::label(null, $ad->construction_year)}}<br/>--}}
    {{--{{Form::label(null, 'Uknjiženost:')}}--}}
    {{--{{Form::label(null, $ad->documentation)}}<br/>--}}
    {{--{{Form::label(null, 'Grejanje:')}}--}}
    {{--{{Form::label(null, $ad->heatingOption->option_name)}}<br/>--}}
    {{--{{Form::label(null, 'Osnovna opremljenost:')}}<br/>--}}
    {{--<ol>--}}
        {{--@foreach($ad->hasAdditions as $addition)--}}
            {{--<li>--}}
                {{--{{Form::label(null, $addition->addition->description)}}--}}
            {{--</li>--}}
        {{--@endforeach--}}
    {{--</ol>--}}
    {{--{{Form::label(null, 'Parking:')}}--}}
    {{--{{Form::label(null, $ad->parkingOption->option_name)}}<br/>--}}
    {{--{{Form::label(null, 'Drvenarija:')}}--}}
    {{--{{Form::label(null, $ad->woodWorkType->type_name)}}<br/>--}}
    {{--{{Form::label(null, 'Namestenost:')}}--}}
    {{--{{Form::label(null, $ad->furnitureDescription->description)}}<br/>--}}
    {{--{{Form::label(null, 'Napomena:')}}--}}
    {{--{{Form::label(null, $ad->note)}}<br/>--}}
    {{--{{Form::label('Slike')}}--}}
    {{--<div>--}}
        {{--@foreach($ad->images as $image)--}}
            {{--<a href="{{$image->image_path}}" data-lightbox="galerija">--}}
                {{--<img src="{{$image->image_path}}" class="img-thumbnail" alt="{{$ad->getName()}}" width="250" />--}}
            {{--</a>--}}
        {{--@endforeach--}}
    {{--</div>--}}
    {{--@foreach($ad->comments as $comment)--}}
        {{--<fieldset>--}}
            {{--<legend>{{$comment->user->username}}--}}
                {{--@if((!Auth::guest()) && (Auth::user()->user_id != $comment->user->user_id) && Auth::user()->isPlebs())--}}
                    {{--| <a href="{{url('comment/'.$comment->comment_id.'/report')}}">Prijavi komentar</a>--}}
                {{--@elseif(!Auth::guest() && (Auth::user()->isAdmin() || Auth::user()->isModerator()))--}}
                    {{--| <a href="{{url('comment/'.$comment->comment_id.'/delete')}}">Obrisi komentar</a>--}}
                {{--@endif--}}
            {{--</legend>--}}
            {{--{{$comment->body}}--}}
        {{--</fieldset>--}}
    {{--@endforeach--}}
    {{--{{Form::open(['method' => 'GET', 'url' => url('comment/add')])}}--}}
    {{--{{Form::hidden('ad_id', $ad->ad_id)}}--}}
    {{--<table width="100%">--}}
        {{--<tr>--}}
            {{--<td>--}}
                {{--{{Form::textarea('body',null,['style' => 'width:100%;','rows' => '5'])}}<br/>--}}
            {{--</td>--}}
        {{--</tr>--}}
    {{--</table>--}}
    {{--{{Form::submit('Posalji Komentar')}}--}}
    {{--{{Form::close()}}--}}
@endsection

@section('scriptAfterLoad')
    <script src="/lightbox/js/lightbox.js"></script>
@endsection