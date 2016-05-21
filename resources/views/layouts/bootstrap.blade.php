<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <title>@yield('title')</title>

        @yield('headScript')
    </head>
    <body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <img src="{{URL::asset('logo.jpg')}}" class="navbar-brand img-rounded">
                @yield('nav-bar-header')
            </div>
                @yield('nav-bar')
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
    @yield('scriptAfterLoad')
    </body>
</html>