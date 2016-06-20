@extends('layouts.bootstrap')

@section('title')
    Agencija za nekretnine
@endsection

@section('headScript')
    <link href="/css/button.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
@endsection

@section('nav-bar')
    @if(Auth::guest())
    <ul class="nav navbar-nav">
        <li class="active"><a href="{{url('/')}}">Početna strana</a></li>
        <li><a href="{{url('search')}}">Pretraži oglase</a></li>
        <li><a href="{{url('ad/create')}}">Dodaj oglas</a></li>
        <li><a href="{{url('about')}}">Informacija o nama</a></li>
        {{--TODO: DODATI STRANICU SA INFORMACIJAMA O AGENCIJI--}}
    </ul>
    @else
        <ul class="nav navbar-nav">
            <li class="active"><a href="{{url('/')}}">Početna strana</a></li>
            <li><a href="{{url('dashboard')}}">Dashboard</a></li>
            <li><a href="{{url('search')}}">Pretraži oglase</a></li>
            <li><a href="{{url('ad/create')}}">Dodaj oglas</a></li>
            <li><a href="{{url('about')}}">Informacija o nama</a></li>
        </ul>
    @endif
@endsection

@section('content')
    {{--TODO: DEFINISATI NEKU POCETNU STRANU--}}

    @if($ads->count() != 0)
        <div class="container">
            <br>
            <div id="myCarousel2" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel2" data-slide-to="1"></li>
                    <li data-target="#myCarousel2" data-slide-to="2"></li>
                    <li data-target="#myCarousel2" data-slide-to="3"></li>
                    <li data-target="#myCarousel2" data-slide-to="4"></li>
                </ol>

                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <a href="{{'/ad/'.$ads[0]->ad_id}}" ><img src="{{$ads[0]->images()->first()->image_path}}" /></a>
                        <div class="carousel-caption">
                            <h3><a href="{{'/ad/'.$ads[0]->ad_id}}" style="color: inherit;">{{$ads[0]->getName()}}</a></h3>
                            <p>{{$ads[0]->description}}</p>
                        </div>
                    </div>
                    @for($i=1; $i<count($ads); $i++)
                        <div class="item">
                            <a href="/ad/{{$ads[$i]->ad_id}}"><img src="{{$ads[$i]->images()->first()->image_path}}" alt="{{$ads[$i]->getName()}}"></a>
                            <div class="carousel-caption">
                                <h3><a href="{{'ad/'.$ads[$i]->ad_id}}" style="color: inherit">{{$ads[$i]->getName()}}</a></h3>
                                <p>{{$ads[$i]->description}}</p>
                            </div>
                        </div>
                    @endfor
                </div>

                <a class="left carousel-control strelica" href="#myCarousel2" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control strelica" href="#myCarousel2" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    @else
        <img src="logo.jpg"/>
        <p>Nema oglasa</p>
    @endif

@endsection