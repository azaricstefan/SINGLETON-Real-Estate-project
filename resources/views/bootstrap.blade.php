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

        <script>@yield('headScript')</script>
    </head>
    <body>
    <nav class="navbar navbar-default">
        <div class="container">
            @yield('navbar')
            @if(Auth::guest())
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{url('register')}}"><span class="glyphicon glyphicon-user"></span> Registracija</a></li>
                    <li><a href="{{urL('login')}}"><span class="glyphicon glyphicon-log-in"></span> Prijava</a></li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{url('/')}}"><span class="glyphicon glyphicon-user"></span> {{Auth::user()->username}}</a></li>
                    <li><a href="{{urL('logout')}}"><span class="glyphicon glyphicon-log-in"></span> Odjava</a></li>
                </ul>
            @endif
        </div>
    </nav>
        <div class="container-fluid">
            @yield('content')
{{--
            <h1>My First Ш добро шљака Page</h1>
            <span class="glyphicon glyphicon-envelope"></span>
            <p>This is some text. <span class="glyphicon glyphicon-folder-open"></span></p>
            <blockquote style="text-align: justify">
                Ovo je neki tekst u nekom bloku.
                Ovo je neki tekst u nekom bloku.Ovo je neki tekst u nekom bloku.
                Ovo je neki tekst u nekom bloku.Ovo je neki tekst u nekom bloku.Ovo je neki tekst u nekom bloku.
                Ovo je neki tekst u nekom bloku.Ovo je neki tekst u nekom bloku.Ovo je neki tekst u nekom bloku.
                Ovo je neki tekst u nekom bloku.Ovo je neki tekst u nekom bloku.Ovo je neki tekst u nekom bloku.
                <footer class="blockquote-reverse">Zavsen spam -> hehe</footer>
            </blockquote>
            <p> Uvek koristite <code>middleware</code> tamo gde je to moguce</p>
            <p> Uvek koristite <kbd>middleware</kbd> tamo gde je to moguce</p>
            <pre class="bg-danger">
Route::get('user/updateProfile', 'UserDashboardController@updateProfile')
Route::post('user/updateProfile', 'UserDashboardController@updateProfile')
            </pre>
            <pre class="bg-success">
Route::get('user/updateProfile', 'UserDashboardController@updateProfile')->middleware('ifNotLoggedInGoLogIn');
Route::post('user/updateProfile', 'UserDashboardController@updateProfile')->middleware('ifNotLoggedInGoLogIn');
            </pre>
            <div class="row">
                <div class="col-sm-4">.col-sm-4</div>
                <div class="col-sm-4">.col-sm-4</div>
                <div class="col-sm-4">.col-sm-4</div>
            </div>
            <table class="table table-striped">
                <tr>
                    <th>
                        helo
                    </th>
                    <th>helo2</th>
                </tr>
                <tr>
                    <td>if</td>
                    <td>else</td>
                </tr>
            </table>
            <div class="alert alert-success fade in">
                <div class="row">
                    <div class="col-sm-4">.col-sm-4</div>
                    <div class="col-sm-4">.col-sm-4</div>
                    <div class="col-sm-4">.col-sm-4</div>
                </div>
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Indicates a successful or positive action.

            </div>--}}
        </div>
    </nav>
    @yield('scriptAfterLoad')
    </body>
</html>