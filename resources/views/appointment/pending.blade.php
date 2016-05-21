@extends('moderator.moddash')

@section('title')
    Novi zakazani termini
@endsection

@section('dash-content')
    <h1 class="page-header">Novi zakazani termini</h1><br/>
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Oglas</th>
                <th>Vreme</th>
                <th></th>
            </tr>
            @foreach($pendingAppointments as $pendingAppointment)
                <tr>
                    <td>{{Form::label(null, $pendingAppointment->ad->city.' '.$pendingAppointment->ad->address)}}</td>
                    <td>{{Form::label(null, $pendingAppointment->appointment_time)}}</td>
                    <td><a href="{{url('appointment/'.$pendingAppointment->appointment_id.'/schedule')}}">Preuzmi termin</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

@section('scriptAfterLoad')
    <script>
        $(function () {
            $('#appointments_pending').addClass('active');
        })
    </script>
@endsection