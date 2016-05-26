@extends('layouts.bootstrap')


@yield('nav-bar-header')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="list-group" style="text-align: center;">
                @yield('dash-nav')
            </div>
            @if(session()->has('flash_message'))
                <div class="alert alert-success">
                    {{session('flash_message')}}
                </div>
            @endif
        </div>
        <div class="col-md-9">
            @yield('dash-content')
        </div>
    </div>
@endsection

