@extends('layouts.bootstrap')

@section('headScript')
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="list-group" style="text-align: center;">
                @yield('dash-nav')
            </div>
            @if(session()->has('flash_message'))
                <div class="alert alert-success" style="text-align: center">
                    {{session('flash_message')}}
                </div>
            @endif
        </div>
        <div class="col-md-9">
            @yield('dash-content')
        </div>
    </div>
@endsection

