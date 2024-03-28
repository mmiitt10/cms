@extends('layouts.app')

@section('slot')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-2xl px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <p class="text-lg font-semibold">検索結果: {{ $total_items }} 件</p>
        @foreach ($books as $book)
            <div class="flex items-center bg-gray-50 rounded-lg shadow mb-4 p-4">
                <?php
                    // サムネイル画像
                    $thumbnail = isset($book->volumeInfo->imageLinks->thumbnail) ? $book->volumeInfo->imageLinks->thumbnail : 'no_image.png';
                ?>
                <img src="{{ $thumbnail }}" alt="{{ $book->volumeInfo->title }}" class="w-20 h-30 object-cover rounded">
                <div class="ml-4">
                    <p class="text-lg font-semibold">
                        <a href="{{ route('book.register', $book->volumeInfo->industryIdentifiers[0]->identifier) }}" class="hover:underline">
                            {{ isset($book->volumeInfo->title) ? $book->volumeInfo->title : '' }}
                        </a>
                    </p>
                    <p class="text-sm text-gray-600">{{ isset($book->volumeInfo->authors) ? implode(', ', $book->volumeInfo->authors) : '著者不明' }}</p>
                    <p class="text-sm text-gray-500">出版日: {{ isset($book->volumeInfo->publishedDate) ? $book->volumeInfo->publishedDate : '不明' }}</p>
                </div>
            </div>
        @endforeach
        
        {{-- ページネーションリンク --}}
        <div class="mt-4">
            @if ($startIndex > 0)
                <a href="{{ route('book.search.result', ['search' => $search_query, 'start' => max(0, $startIndex - $maxResults)]) }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-black">前へ</a>
            @endif
            @if (count($books) == $maxResults)
                <a href="{{ route('book.search.result', ['search' => $search_query, 'start' => $startIndex + $maxResults]) }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-black">次へ</a>
            @endif
        </div>
    </div>
</div>
@endsection