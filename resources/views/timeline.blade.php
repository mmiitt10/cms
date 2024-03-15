@extends('layouts.app')

@section('slot')
    <div class="timeline">
        @foreach ($books as $book)
            <div class="card">
                <!--uinfo-->
                <div class="uinfo">
                    
                    <!--画像-->        
                    <!--<img src="{{ asset('storage/'.$book->user->uinfo->profile_picture) }}" alt="Profile Picture">-->
                    @if (auth()->check() && $book->user_id == auth()->user()->id)
                        <a href="{{ route('mypage') }}">
                            <img src="{{ asset('storage/'.$book->user->uinfo->profile_picture) }}" alt="Profile Picture">
                        </a>
                    @else
                        <a href="{{ route('user.page', ['id' => $book->user_id]) }}">
                            <img src="{{ asset('storage/'.$book->user->uinfo->profile_picture) }}" alt="Profile Picture">
                        </a>
                    @endif
                    
                    <!--名前-->
                    <div class="name"> {{ $book->user->uinfo->profile_name }}</div>
                </div>
                
                <!--career-->
                <div class="uinfo">
                    
                    <!--会社-->
                    <div class="company">{{ $book->user->career[0]->career_company }}</div>
                    
                    <!--役職-->
                    <div class="position">{{ $book->user->career[0]->career_position }}</div>
                </div>
                
                <!--書籍情報-->
                <div class="book">
                    <!--書籍画像-->
                    <a href="{{ route('book.register', ['isbn' => $book->ssbid]) }}">
                        @if (isset($book->googleBookInfo['volumeInfo']['imageLinks']['thumbnail']))
                            <img class="image" src="{{ $book->googleBookInfo['volumeInfo']['imageLinks']['thumbnail'] }}" alt="Book Image">
                        @else
                            <img class="image" src="/images/no_image.png" alt="No Image Available">
                        @endif
                    </a>

                    
                    <!--書籍タイトル-->
                    @if (isset($book->googleBookInfo))
                        <div class="title">書籍タイトル: {{ $book->googleBookInfo['volumeInfo']['title']  ?? 'N/A' }}</div>
                    @endif
                    
                    
                    <!--評価-->
                    <div class="assessment">評価: {{ $book->assessment }}</div>
                    
                    <!--コメント-->
                    <div class="comment">コメント: {{ $book->comment }}</div>
                    
                    <!--返信フォーム-->
                    <form action="{{ route('replies.store', ['book' => $book->id]) }}" method="POST">
                        @csrf
                        <textarea name="comment" placeholder="返信を入力"></textarea>
                        <button type="submit">返信</button>
                    </form>
                    @include('components.likes')
                    
                    <!-- この投稿に対する返信を表示 -->
                    @foreach ($book->replies as $reply)
                        <div class="reply">
                            <!-- 返信表示コード -->
                            <div>{{ $reply->user->uinfo->profile_name }}</div>
                            <div>{{ $reply->comment }}</div>
                            @include('components.likes')
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
