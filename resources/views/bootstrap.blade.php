<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{--Putem elixir-a dodato @Stefan--}}
        {!! Html::style('css/app.css') !!}

        <title>@yield('title')</title>

        @yield('headScript')
    </head>
    <body>
    <nav class="navbar navbar-default">
        <div class="container">
            @yield('navbar')
            @if(Auth::guest())
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{url('register')}}"><span class="glyphicon glyphicon-user"></span> Registracija</a></li>
                    <li><a href="{{url('login')}}"><span class="glyphicon glyphicon-log-in"></span> Prijava</a></li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{url('/')}}"><span class="glyphicon glyphicon-user"></span> {{Auth::user()->username}}</a></li>
                    <li><a href="{{url('logout')}}"><span class="glyphicon glyphicon-log-in"></span> Odjava</a></li>
                </ul>
            @endif
        </div>
    </nav>
        <div class="container-fluid">
            @yield('content')
        </div>
    </nav>

    {{--Putem elixir-a dodato sve(bootstrap,jquery za sad) @Stefan--}}
    {{Html::script('js/merged/app.min.js')}}

    </body>
</html>