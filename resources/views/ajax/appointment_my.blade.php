AJAX
<div class="table-responsive">
    <table class="table table-hover">
        <tr>
            <th>Oglas</th>
            <th>Vreme</th>
            <th colspan="2" >Izbor</th>

        </tr>
        @foreach($appointments as $appointment)
            <tr>
                <td><a href="{{url('ad/'.$appointment->ad->ad_id)}}"> {{$appointment->ad->city.' '.$appointment->ad->address}}</a></td>
                <td>{{$appointment->appointment_time}}</td>
                @if(!Auth::user()->isPlebs())
                    <td><a href="{{url('appointment/'.$appointment->appointment_id.'/complete')}}">Termin završen</a></td>
                @endif
                <td><a id="appointment_cancel" href="{{url('appointment/'.$appointment->appointment_id.'/cancel')}}">Otkazi termin</a></td>
            </tr>
        @endforeach
    </table>
</div>