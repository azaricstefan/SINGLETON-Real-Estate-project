@extends('layouts.auth')

@section('title')
    Prijavljeni komentari
@endsection

@section('content')
    @if(count($reported)>0)
        @foreach($reported as $comment)
            <div style="padding: 5px; margin:5px; border: 1px solid; width:400px">
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