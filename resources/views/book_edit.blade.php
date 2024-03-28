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

        <!-- 登録箇所（編集用） -->
        <div class="mt-6">
            <form action="{{ route('book.update', ['id' => $book->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="ssbid" value="{{ $book->ssbid }}">

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">ステータス:</label>
                    <select id="status" name="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm">
                        <option value="yet" @if($book->status == 'yet') selected @endif>積読</option>
                        <option value="now" @if($book->status == 'now') selected @endif>読書中</option>
                        <option value="done" @if($book->status == 'done') selected @endif>読了</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="assessment" class="block text-sm font-medium text-gray-700">評価:</label>
                    <input type="number" id="assessment" name="assessment" value="{{ $book->assessment }}" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm" min="0" max="5">
                </div>

                <div class="mb-4">
                    <label for="comment" class="block text-sm font-medium text-gray-700">コメント:</label>
                    <textarea id="comment" name="comment" rows="2" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm">{{ $book->comment }}</textarea>
                </div>

                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-700">
                    更新
                </button>
            </form>
            
            <!-- 削除ボタン -->
            <form action="{{ route('book.delete', $book->id) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-700">
                    削除
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
