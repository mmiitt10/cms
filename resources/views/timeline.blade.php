@extends('layouts.app')

@section('slot')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    @foreach ($books as $book)
        <div class="w-full sm:max-w-md mt-2 px-6 py-2 bg-white shadow-md overflow-hidden sm:rounded-lg mb-2">
            
            <!--読者情報-->
            <div class="flex items-start space-x-4 mb-2">
                @if (auth()->check() && $book->user_id == auth()->user()->id)
                    <a href="{{ route('mypage') }}">
                        <img src="{{ asset('storage/'.$book->user->uinfo->profile_picture) }}" alt="Profile Picture" class="h-12 w-12 object-cover rounded-full">
                    </a>
                @else
                    <a href="{{ route('user.page', ['id' => $book->user_id]) }}">
                        <img src="{{ asset('storage/'.$book->user->uinfo->profile_picture) }}" alt="Profile Picture" class="h-12 w-12 object-cover rounded-full">
                    </a>
                @endif
                <div>
                    <div class="text-xl font-bold">{{ $book->user->uinfo->profile_name }}</div>
                    <div class="text-sm">{{ $book->user->career[0]->career_company }} / {{ $book->user->career[0]->career_position }}</div>
                </div>
            </div>
            
            <!-- 書籍情報 -->
            <div class="flex items-center bg-gray-50 rounded-lg shadow mb-2 p-2">
                <?php
                    // サムネイル画像
                    $thumbnail = isset($book->googleBookInfo['volumeInfo']['imageLinks']['thumbnail']) ? $book->googleBookInfo['volumeInfo']['imageLinks']['thumbnail'] : '/images/no_image.png';
                ?>
                <img src="{{ $thumbnail }}" alt="{{ $book->googleBookInfo['volumeInfo']['title'] }}" class="w-20 h-30 object-cover rounded">
                <div class="ml-4">
                    <p class="text-lg font-semibold">
                        <a href="{{ route('book.register', ['isbn' => $book->ssbid]) }}" class="hover:underline">
                            {{ isset($book->googleBookInfo['volumeInfo']['title']) ? $book->googleBookInfo['volumeInfo']['title'] : '' }}
                        </a>
                    </p>
                    <p class="text-sm text-gray-600">{{ isset($book->googleBookInfo['volumeInfo']['authors']) ? implode(', ', $book->googleBookInfo['volumeInfo']['authors']) : '著者不明' }}</p>
                    <p class="text-sm text-gray-500">出版日: {{ isset($book->googleBookInfo['volumeInfo']['publishedDate']) ? $book->googleBookInfo['volumeInfo']['publishedDate'] : '不明' }}</p>
                </div>
            </div>
            
            <!--評価・感想-->
            <div>
                <p class="text-sm">評価: {{ $book->assessment }}</p>
                <p class="text-sm">コメント: {{ $book->comment }}</p>
            </div>
            
            <!--返信フォーム-->
            @if(auth()->check() && $book->user_id !== auth()->user()->id)
                <form action="{{ route('replies.store', ['book' => $book->id]) }}" method="POST" class="w-full">
                    @csrf
                    <textarea name="comment" placeholder="返信を入力" class="w-full py-1 px-3 border border-gray-300 bg-white rounded-md mb-2"></textarea>
                    <div class="flex items-center justify-end space-x-2">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-700">返信</button>
                    </div>
                </form>
            @endif

            <!-- この投稿に対する返信を表示 -->
            @foreach ($book->replies as $reply)
                <div class="reply mt-2">
                    <div class="flex items-start space-x-4">
                        @if(auth()->check() && $reply->user_id == auth()->user()->id)
                            <a href="{{ route('mypage') }}">
                        @else
                            <a href="{{ route('user.page', ['id' => $reply->user_id]) }}">
                        @endif
                            <img src="{{ asset('storage/'.$reply->user->uinfo->profile_picture) }}" alt="Profile Picture" class="h-8 w-8 object-cover rounded-full">
                        </a>
                        <div class="flex flex-col">
                            <div class="text-sm font-medium">{{ $reply->user->uinfo->profile_name }}</div>
                            <div class="text-sm">{{ $reply->comment }}</div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    @endforeach
</div>
@endsection
