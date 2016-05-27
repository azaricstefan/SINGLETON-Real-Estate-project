@extends(Auth::user()->isModerator() ? 'moderator.moddash' : 'admin.admindash')

@section('title')
    Prijavljeni komentari
@endsection

@section('headScript')
    <link href="/css/global.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/css/footer.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('dash-content')
    <h1 class="page-header">Prijavljeni komentari</h1>
    @if(count($reported)>0)
        @foreach($reported as $comment)
            <div class="well">
                Komentar:<br/>{{$comment->body}} <br/>
                Postavio: <a href="/users/{{$comment->user_id}}">{{$comment->user->username}}</a> <br />
                Oglas: <a href="/ad/{{$comment->ad->ad_id}}">{{$comment->ad->getName()}}</a><br />
                <a href="/comment/{{$comment->comment_id}}/approve">Komentar je prikladan</a> |
                {{--<a onclick="confirmDelete()">Obrisi komentar</a>--}}
                <a href="" onclick="confirmDelete({{$comment->comment_id}})" value="obrisi">Obrisi</a>
            </div>
        @endforeach
    @else
        Nema nista ovde
    @endif
@endsection

@section('scriptAfterLoad')
    <script>
        $(function(){
            $('#reported_comments').addClass('active');
        });
        function confirmDelete(id) {
            if(confirm('Da li ste sigurni?')){
                location.href='/comment/' + id + '/delete';
            }
        }
    </script>
@endsection