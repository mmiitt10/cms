@extends('layouts.app') <!-- 既存のレイアウトを継承する場合 -->

@section('slot')
    <!--ログインしていない場合-->
    @if( auth()->user()->uinfo ===null)
        <a href="{{route('uinfo.create')}}">会員登録する</a>
        
    @else
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        
        <!--会員情報-->
        <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"> 
            <div class="card-body text-center">
                <img src="{{ asset('storage/'.auth()->user()->uinfo->profile_picture) }}" alt="Profile Picture" class="rounded-full mx-auto w-24 h-24 object-cover">
                <p class="mt-4 font-bold">{{ auth()->user()->uinfo->profile_name }}</p>
                <p>{{ auth()->user()->uinfo->profile_age }}歳</p>
                <p class="mt-2 text-left">{{ auth()->user()->uinfo->profile_intro }}</p>
    
                <div class="flex justify-center mt-4 gap-2">
                    <a href="{{ route('followings', ['user' => Auth::user()]) }}" class="inline-block px-4 py-2 border border-gray-300 rounded hover:bg-gray-100">フォロー中</a>
                    <a href="{{ route('followers', ['user' => Auth::user()]) }}" class="inline-block px-4 py-2 border border-gray-300 rounded hover:bg-gray-100">フォロワー</a>
                </div>
                <a href="{{ route('uinfo.edit', ['uinfo' => auth()->user()->uinfo->id]) }}" class="inline-block mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">編集</a>
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
                @foreach(auth()->user()->career as $career)
                    <p class="mt-4 text-center"> <span class="font-bold">{{ $career->career_company }}</span></p>
                    <p>在籍期間: {{ \Carbon\Carbon::parse($career->career_work_from)->format('Y年n月') }} ～ {{ $career->career_work_to ? \Carbon\Carbon::parse($career->career_work_to)->format('Y年n月') : '現在' }}</p>
                    <p>業界: {{ $career->career_industry }}</p>
                    <p>職種: {{ $career->career_function }}</p>
                    <p>役職: {{ $career->career_position }}</p>
                    <div class="flex justify-center mt-4"> <!-- 編集と削除ボタンを中央揃えに -->
                        <a href="{{ route('career.edit', ['career' => $career->id]) }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">編集</a>
                        <form action="{{ route('career.delete', ['career' => $career->id]) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">削除</button>
                        </form>
                    </div>
                    <hr class="mt-4"> <!-- 区切り線を追加 -->
                @endforeach
                <div class="flex justify-center mt-4">
                    <a href="{{ route('career.create') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">追加</a>
                </div>
            </div>
        </div>
        
        <!--興味がある業界・職種-->
        <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="card-body text-left">
                <p class="mt-4">興味がある業界1: <span class="font-bold">{{ auth()->user()->interest->interest_industry1 }}</span></p>
                <p>興味がある業界2: <span class="font-bold">{{ auth()->user()->interest->interest_industry2 }}</span></p>
                <p>興味がある業界3: <span class="font-bold">{{ auth()->user()->interest->interest_industry3 }}</span></p>
                <p>興味がある職種1: <span class="font-bold">{{ auth()->user()->interest->interest_function1 }}</span></p>
                <p>興味がある職種2: <span class="font-bold">{{ auth()->user()->interest->interest_function2 }}</span></p>
                <p>興味がある職種3: <span class="font-bold">{{ auth()->user()->interest->interest_function3 }}</span></p>
                
                <!-- 編集ボタンを中央に配置するためにFlexboxを使用 -->
                <div class="flex justify-center mt-4">
                    <a href="{{ route('interest.edit', ['interest' => auth()->user()->interest->id]) }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">編集</a>
                </div>
            </div>
        </div>
        
    
    </div>
    @endif
@endsection