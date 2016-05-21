@extends('moderator.moddash')

@section('title')
    Prijavljeni komentari
@endsection

@section('dash-content')
    <h1 class="page-header">Prijavljeni komentari</h1>
    @if(count($reported)>0)
        @foreach($reported as $comment)
            <div class="well">
                Komentar:<br/>{{$comment->body}} <br/>
                Postavio: <a href="#">{{$comment->user->username}}</a> <br />
                Oglas: <a href="/ad/{{$comment->ad->ad_id}}">{{$comment->ad->getName()}}</a><br />
                <a href="/comment/{{$comment->comment_id}}/approve">Komentar je prikladan</a> |
                <a href="/comment/{{$comment->comment_id}}/delete">Obrisi komentar</a>
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
    </script>
@endsection