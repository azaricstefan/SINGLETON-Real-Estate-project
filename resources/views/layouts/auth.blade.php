<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="{{url('favicon.ico')}}"/>
    <title>@yield('title')</title>
</head>
<body>
    @if(session()->has('flash_message'))
    <div style='width:200px; background-color: #00b3ee; text-align: center'>
           {{session('flash_message')}}
    </div>
    @endif
    <div align="=center">
    @yield('content')
    </div>
</body>
</html>