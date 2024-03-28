@extends('layouts.app')

@section('slot')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <!-- 書籍情報表示 -->
        <div class="text-center">
            <img src="{{ $thumbnail }}" alt="{{ $title }}" class="rounded mx-auto w-24 h-auto">
            <h2 class="mt-4 font-bold">{{ $title }}</h2>
            <p>{{ is_array($authors) ? implode(', ', $authors) : $authors }} 著</p>
            <p>出版日: {{ $publishedDate }}</p>
            <div class="mt-2 text-left">{{ $description }}</div>
        </div>
        
        <!-- 登録箇所 -->
        <div class="mt-6">
            <form action="{{ route('book.store') }}" method="POST">
                @csrf
                <input type="hidden" name="ssbid" value="{{ $isbn }}">

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">ステータス:</label>
                    <select id="status" name="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm">
                        <option value="yet">積読</option>
                        <option value="now">読書中</option>
                        <option value="done">読了</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="assessment" class="block text-sm font-medium text-gray-700">評価:</label>
                    <input type="number" id="assessment" name="assessment" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm" min="0" max="5">
                </div>

                <div class="mb-4">
                    <label for="comment" class="block text-sm font-medium text-gray-700">コメント:</label>
                    <textarea id="comment" name="comment" rows="2" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm"></textarea>
                </div>

                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-700">
                    登録
                </button>
            </form>
        </div>
    </div>
    
   <!--コメント表示欄-->
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h3 class="text-xl font-semibold mb-4">コメント</h3>
        @foreach ($dbBooks as $dbBook)
        <div class="mb-4 border-b border-gray-200 pb-4">
            <div class="flex items-start space-x-4 mb-2">
                @if (auth()->check() && $dbBook->user_id == auth()->user()->id)
                    <a href="{{ route('mypage') }}">
                        <img src="{{ asset('storage/'.$dbBook->user->uinfo->profile_picture) }}" alt="Profile Picture" class="h-8 w-8 object-cover rounded-full">
                    </a>
                @else
                    <a href="{{ route('user.page', ['id' => $dbBook->user_id]) }}">
                        <img src="{{ asset('storage/'.$dbBook->user->uinfo->profile_picture) }}" alt="Profile Picture" class="h-8 w-8 object-cover rounded-full">
                    </a>
                @endif
                <div class="flex flex-col">
                    <div class="text-sm font-medium">{{ $dbBook->user->uinfo->profile_name }}</div>
                    <div class="text-sm text-gray-500">会社: {{ $dbBook->user->career[0]->career_company }}</div>
                    <div class="text-sm text-gray-500">役職: {{ $dbBook->user->career[0]->career_position }}</div>
                </div>
            </div>
            <div class="ml-14">
                <div class="text-sm text-gray-700 mt-2">評価: {{ $dbBook->assessment }}</div>
                <div class="text-sm text-gray-700">コメント: {{ $dbBook->comment }}</div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection