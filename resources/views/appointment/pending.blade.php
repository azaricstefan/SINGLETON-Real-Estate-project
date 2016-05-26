@extends(Auth::user()->isModerator() ? 'moderator.moddash' : 'admin.admindash')

@section('title')
    Novi zakazani termini
@endsection

@section('headScript')
    <link href="/css/button.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
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
                    <td>{{Form::label(null, $pendingAppointment->ad->city)}}<br/> {{Form::label(null, $pendingAppointment->ad->address)}}</td>
                    <td style="vertical-align: middle">{{Form::label(null, $pendingAppointment->appointment_time)}}</td>
                    <td><a href="{{url('appointment/'.$pendingAppointment->appointment_id.'/schedule')}}" class = "btn btn-default-reverse">Preuzmi termin</a></td>
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