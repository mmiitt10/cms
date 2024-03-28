@extends('layouts.app')

@section('slot')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    
    <!-- 積読 -->
    <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <div class="card-body text-left">
        <h2 class="text-center text-lg font-semibold bg-gray-200 py-2">積読中の書籍</h2>
        <div class="flex flex-wrap justify-center p-4">
            @foreach ($books as $book)
                @if ($book->status == 'yet')
                    <div class="book mb-4 mx-2" style="flex: 0 0 auto; max-width: calc(33.333% - 1rem);">
                        <a href="{{ route('book.edit', ['id' => $book->id]) }}">
                            <?php
                                $thumbnail = isset($book->googleBookInfo['volumeInfo']['imageLinks']['thumbnail']) ? $book->googleBookInfo['volumeInfo']['imageLinks']['thumbnail'] : '/images/no_image.png';
                            ?>
                            <img src="{{ $thumbnail }}" alt="{{ $book->googleBookInfo['volumeInfo']['title'] }}" class="w-full h-auto object-cover rounded mb-2">
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    </div>

    <!-- 読書中 -->
    <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <div class="card-body text-left">
        <h2 class="text-center text-lg font-semibold bg-gray-200 py-2">読書中の書籍</h2>
        <div class="flex flex-wrap justify-center p-4">
            @foreach ($books as $book)
                @if ($book->status == 'now')
                    <div class="book mb-4 mx-2" style="flex: 0 0 auto; max-width: calc(33.333% - 1rem);">
                        <a href="{{ route('book.edit', ['id' => $book->id]) }}">
                            <?php
                                $thumbnail = isset($book->googleBookInfo['volumeInfo']['imageLinks']['thumbnail']) ? $book->googleBookInfo['volumeInfo']['imageLinks']['thumbnail'] : '/images/no_image.png';
                            ?>
                            <img src="{{ $thumbnail }}" alt="{{ $book->googleBookInfo['volumeInfo']['title'] }}" class="w-full h-auto object-cover rounded mb-2">
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    </div>
    
    <!-- 読了 -->
    <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <div class="card-body text-left">
        <h2 class="text-center text-lg font-semibold bg-gray-200 py-2">読み終わった書籍</h2>
        <div class="flex flex-wrap justify-center p-4">
            @foreach ($books as $book)
                @if ($book->status == 'done')
                    <div class="book mb-4 mx-2" style="flex: 0 0 auto; max-width: calc(33.333% - 1rem);">
                        <a href="{{ route('book.edit', ['id' => $book->id]) }}">
                            <?php
                                $thumbnail = isset($book->googleBookInfo['volumeInfo']['imageLinks']['thumbnail']) ? $book->googleBookInfo['volumeInfo']['imageLinks']['thumbnail'] : '/images/no_image.png';
                            ?>
                            <img src="{{ $thumbnail }}" alt="{{ $book->googleBookInfo['volumeInfo']['title'] }}" class="w-full h-auto object-cover rounded mb-2">
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    </div>

</div>
@endsection
