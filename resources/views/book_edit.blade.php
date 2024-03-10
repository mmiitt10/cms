@extends('layouts.app')

@section('slot')
    <!--書籍情報表示-->
    <div class="show">
        <img src="{{ $thumbnail }}" alt="{{ $title}}">
        <p>{{ $title }}</p>
        <p>{{ is_array($authors) ? implode(', ', $authors) : $authors }}著</p>
        <p>出版日: {{ $publishedDate }}</p>
        <p>{{ $description }}</p>
        <p hidden>{{ $isbn }}</p>
    </div>

    <!-- 登録箇所 -->
    <div class="register">
        <form action="{{ route('book.update', ['id' => $book->id]) }}" method="POST">
            @csrf
            @method('PUT') <!-- 更新操作のため、HTTPのPUTメソッドを指定 -->
            <input type="hidden" name="ssbid" value="{{ $book->ssbid }}">
            <div class="form-group">
                <label for="status">ステータス:</label>
                <select class="form-control" id="status" name="status">
                    <option value="yet" {{ $book->status == 'yet' ? 'selected' : '' }}>積読</option>
                    <option value="now" {{ $book->status == 'now' ? 'selected' : '' }}>読書中</option>
                    <option value="done" {{ $book->status == 'done' ? 'selected' : '' }}>読了</option>
                </select>
            </div>
            <div class="form-group">
                <label for="assessment">評価:</label>
                <input type="number" class="form-control" id="assessment" name="assessment" min="0" max="5" value  ="{{$book->assessment}}">
            </div>
            <div class="form-group">
                <label for="comment">コメント:</label>
                <textarea class="form-control" id="comment" name="comment" rows="3">{{$book->comment}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">更新</button>
        </form>
    </div>
    
    <!--コメント表示欄-->
    <div class=comment>
        <div class="timeline">
            @foreach ($dbBooks as $dbBook)
                <div class="card">
                    <!--uinfo-->
                    <div class="uinfo">
                        
                        <!--画像-->        
                        <img src="{{ asset('storage/'.$dbBook->user->uinfo->profile_picture) }}" alt="Profile Picture">
                        
                        <!--名前-->
                        <div class="name"> {{ $dbBook->user->uinfo->profile_name }}</div>
                    </div>
                    
                    <!--career-->
                    <div class="uinfo">
                        
                        <!--会社-->
                        <div class="company">{{ $dbBook->user->career[0]->career_company }}</div>
                        
                        <!--役職-->
                        <div class="position">{{ $dbBook->user->career[0]->career_position }}</div>
                    </div>
                    
                    <!--書籍情報-->
                    <div class="book">
                        <!--評価-->
                        <div class="assessment">評価: {{ $dbBook->assessment }}</div>
                        
                        <!--コメント-->
                        <div class="comment">コメント: {{ $dbBook->comment }}</div>
                        
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection