<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	{{--Putem elixir-a dodato @Stefan--}}
	{!! Html::style('css/app.css') !!}

    <title>@yield('title')</title>
    @yield('header')
</head>
<body>
    <div class="container">
        @yield('content')
    </div>

    @yield('footer')

    {{Html::script('js/merged/app.min.js')}}
    {{--elixir strpa sve zajedno--}}
    {{--{!! Html::script('js/jquery.min.js') !!}--}}
    {{--{!! Html::script('js/bootstrap.min.js') !!}--}}
</body>
</html>