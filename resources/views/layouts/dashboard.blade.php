@extends('bootstrap')

@section('nav-bar')
    <div class="navbar-header">
        <a class="navbar-brand" href="{{url('dashboard/moderator')}}">Dashboard</a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
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

