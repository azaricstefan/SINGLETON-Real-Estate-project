@if(count($users) > 0)
    @foreach($users as $user)
        <tr>
            <td><a href="{{url('users',[$user->user_id])}}">{{$user->username}}</a></td>
            <td>{{$user->fullname}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->telefon}}</td>
        </tr>
    @endforeach
@endif
