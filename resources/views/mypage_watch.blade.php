@extends('layouts.app') <!-- 既存のレイアウトを継承する場合 -->

@section('slot')
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        
        <!--会員情報-->
        <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"> 
            <div class="card-body text-center">
                <img src="{{ asset('storage/'. $user->uinfo->profile_picture) }}" alt="Profile Picture" class="rounded-full mx-auto w-24 h-24 object-cover">
                <p class="mt-4 font-bold"> {{ $user->uinfo->profile_name }}</p>
                <p> {{ $user->uinfo->profile_age }}歳</p>
                <p class="mt-2 text-left"> {{ $user->uinfo->profile_intro }}</p>
                
                <!--フォロー中・フォロワー-->
                <div class="flex justify-center mt-4 gap-2">
                    <a href="{{ route('followings', ['user' => $user->id]) }}" class="inline-block px-4 py-2 border border-gray-300 rounded hover:bg-gray-100">フォロー中</a>
                    <a href="{{ route('followers', ['user' => $user->id]) }}" class="inline-block px-4 py-2 border border-gray-300 rounded hover:bg-gray-100">フォロワー</a>
                </div>
                
                <!--フォロー・フォロー解除ボタン-->
                @if(Auth::check()) <!-- ユーザーがログインしているか確認 -->
                    @if(Auth::user()->isFollowing($user->id)) <!-- ログインユーザーがこのユーザーをフォローしているか確認 -->
                        <!-- フォロー解除ボタン -->
                        <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-block mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">フォロー解除</button>
                        </form>
                    @else
                        <!-- フォローボタン -->
                        <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-block mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">フォローする</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
        
        <!--キャリア情報サマリ-->
        <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="card-body">
                <h3 class="text-center font-bold mb-4">業種ごとの経験年数</h3>
                <ul>
                    @foreach ($industrySummaries as $summary)
                        <li>{{ $summary->name }}: {{ $summary->total_years }}年</li>
                    @endforeach
                </ul>
                
                <h3 class="text-center font-bold mt-6 mb-4">職種ごとの経験年数</h3>
                <ul>
                    @foreach ($functionSummaries as $summary)
                        <li>{{ $summary->name }}: {{ $summary->total_years }}年</li>
                    @endforeach
                </ul>
            </div>
        </div>
        
        <!--職歴-->
        <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="card-body text-left"> <!-- text-center を text-left に変更 -->
                @foreach($user->career as $career)
                    <p class="mt-4 text-center"> <span class="font-bold">{{ $career->career_company }}</span></p>
                    <p>在籍期間: {{ \Carbon\Carbon::parse($career->career_work_from)->format('Y年n月') }} ～ {{ $career->career_work_to ? \Carbon\Carbon::parse($career->career_work_to)->format('Y年n月') : '現在' }}</p>
                    <p>業界: {{ $career->career_industry }}</p>
                    <p>職種: {{ $career->career_function }}</p>
                    <p>役職: {{ $career->career_position }}</p>
                    <hr class="mt-4"> <!-- 区切り線を追加 -->
                @endforeach
            </div>
        </div>
        
        <!--興味がある業界・職種-->
        <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="card-body text-left">
                <p class="mt-4">興味がある業界1: <span class="font-bold">{{ $user->interest->interest_industry1  }}</span></p>
                <p>興味がある業界2: <span class="font-bold">{{ $user->interest->interest_industry2 }}</span></p>
                <p>興味がある業界3: <span class="font-bold">{{ $user->interest->interest_industry3 }}</span></p>
                <p>興味がある職種1: <span class="font-bold">{{ $user->interest->interest_function1 }}</span></p>
                <p>興味がある職種2: <span class="font-bold">{{ $user->interest->interest_function2 }}</span></p>
                <p>興味がある職種3: <span class="font-bold">{{ $user->interest->interest_function3 }}</span></p>
            </div>
        </div>
        
        <!--本棚-->
        
            <!--積読-->
            <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="card-body text-left">
                    <h2 class="text-center text-lg font-semibold bg-gray-200 py-2">積読中の書籍</h2>
                    <div class="flex flex-wrap justify-center p-4">
                        @foreach ($books as $book)
                            @if ($book->status == 'yet')
                                <div class="book mb-4 mx-2" style="flex: 0 0 auto; max-width: calc(33.333% - 1rem);">
                                    <a href="{{ route('book.register', ['isbn' => $book->ssbid]) }}">
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
        
            <!--読書中-->
            <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="card-body text-left">
                    <h2 class="text-center text-lg font-semibold bg-gray-200 py-2">読書中の書籍</h2>
                    <div class="flex flex-wrap justify-center p-4">
                        @foreach ($books as $book)
                            @if ($book->status == 'now')
                                <div class="book mb-4 mx-2" style="flex: 0 0 auto; max-width: calc(33.333% - 1rem);">
                                    <a href="{{ route('book.register', ['isbn' => $book->ssbid]) }}">
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
        
            <!--読了-->
            <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="card-body text-left">
                    <h2 class="text-center text-lg font-semibold bg-gray-200 py-2">読み終わった書籍</h2>
                    <div class="flex flex-wrap justify-center p-4">
                        @foreach ($books as $book)
                            @if ($book->status == 'done')
                                <div class="book mb-4 mx-2" style="flex: 0 0 auto; max-width: calc(33.333% - 1rem);">
                                    <a href="{{ route('book.register', ['isbn' => $book->ssbid]) }}">
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