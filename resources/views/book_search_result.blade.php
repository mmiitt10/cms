@extends('layouts.app')

@section('slot')
    <div class="container">
        <p>検索結果: {{ $total_items }} 件</p>
        @foreach ($books as $book)
            <div class="book">
                <?php
                    // サムネイル画像
                    $thumbnail = isset($book->volumeInfo->imageLinks->thumbnail) ? $book->volumeInfo->imageLinks->thumbnail : 'no_image.png';
                ?>
                <img src="{{ $thumbnail }}" alt="{{ $book->volumeInfo->title }}">
                <p><a href="{{ route('book.register', $book->volumeInfo->industryIdentifiers[0]->identifier) }}">{{ isset($book->volumeInfo->title) ? $book->volumeInfo->title : '' }}</a></p>
                <p> {{ isset($book->volumeInfo->authors) ? implode(', ', $book->volumeInfo->authors) : '著者不明' }}</p>
                <p>出版日: {{ isset($book->volumeInfo->publishedDate) ? $book->volumeInfo->publishedDate : '不明' }}</p>
            </div>
        @endforeach
    </div>
@endsection
