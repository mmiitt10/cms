@extends('layouts.app')

@section('slot')
    <div class="container">
        <!-- 検索フォーム -->
        <form method="get" action="{{ route('book.search.result') }}">
            <input type="text" name="search" placeholder="書籍名または著者名で検索">
            <button type="submit">検索</button>
        </form>
    </div>
@endsection