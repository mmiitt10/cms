@extends('layouts.app')

@section('content')
    <div class="timeline">
        @foreach ($books as $book)
            <div class="postcard">
                <div class="postcard-content">
                    <p>評価: {{ $book->assessment }}</p>
                    <p>コメント: {{ $book->comment }}</p>
                    <p>投稿日時: {{ $book->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
