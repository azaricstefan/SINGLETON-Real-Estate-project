@extends(Auth::user()->isPlebs() ? 'dashboard.user.userdash' :
    (Auth::user()->isModerator() ? 'moderator.moddash' : 'admin.admindash'))

@section('title')
    Moji termini
@endsection

@section('headScript')
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('dash-content')
    <div class="page-header" align="center"><h1>Moji termini</h1></div>
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>Oglas</th>
                <th>Vreme</th>
                @if(!Auth::user()->isPlebs())
                    <th colspan="2" >Izbor</th>
                @else
                    <th>Izbor</th>
                    <th title="Ukoliko je status potvrđen, agent će vas uskoro kontaktirati">Status</th>
                @endif
            </tr>
                @foreach($appointments as $appointment)
                    <tr>
                        <td><a href="{{url('ad/'.$appointment->ad->ad_id)}}"> {{$appointment->ad->city.' '.$appointment->ad->address}}</a></td>
                        <td>{{$appointment->appointment_time}}</td>
                        @if(!Auth::user()->isPlebs())
                            <td><a href="{{url('appointment/'.$appointment->appointment_id.'/complete')}}">Termin završen</a></td>
                        @endif
                        <td><a id="appointment_cancel" href="/appointment/{{$appointment->appointment_id}}/cancel" class="confirmation">Otkazi termin</a></td>
                        {{--namerno su razdvojeni ifovi zbog redosleda u tabeli--}}
                        @if(Auth::user()->isPlebs())
                            <td>
                                @if($appointment->status == 'Pending')
                                    Nije potvrđen
                                @else
                                    Potvrđen
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
        </table>
    </div>
@endsection

@section('scriptAfterLoad')
    <script>
        $(function () {
            $('#appointments_my_appointments').addClass('active');
            $('.confirmation').click(confirmIt);
        })
        var confirmIt = function (e) {
            if (!confirm('Da li ste sigurni?')) e.preventDefault();
        };
    </script>
@endsection