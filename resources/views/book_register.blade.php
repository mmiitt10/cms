@extends('layouts.app')

@section('slot')
    <!--書籍情報表示-->
    <div class="show">
        <img src="{{ $thumbnail }}" alt="{{ $title }}">
        <p>{{ $title }}</p>
        <p>{{ is_array($authors) ? implode(', ', $authors) : $authors }}著</p>
        <p>出版日: {{ $publishedDate }}</p>
        <p>{{ $description }}</p>
        <p hidden>{{ $isbn }}</p>
    </div>

    <!-- 登録箇所 -->
    <div class="register">
        <form action="{{ route('book.store') }}" method="POST">
            @csrf
            <input type="hidden" name="ssbid" value="{{ $isbn }}">
            <div class="form-group">
                <label for="status">ステータス:</label>
                <select class="form-control" id="status" name="status">
                    <option value="yet">積読</option>
                    <option value="now">読書中</option>
                    <option value="done">読了</option>
                </select>
            </div>
            <div class="form-group">
                <label for="assessment">評価:</label>
                <input type="number" class="form-control" id="assessment" name="assessment" min="0" max="5">
            </div>
            <div class="form-group">
                <label for="comment">コメント:</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">登録</button>
        </form>
    </div>
    
    <!--コメント表示欄-->
    <div class=comment>
            
    </div>
@endsection