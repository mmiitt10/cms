<!-- uinfo_edit.blade.php -->

@extends('layouts.app') <!-- 既存のレイアウトを継承する場合 -->

@section('slot')
    <div class="container">
        <h2>ユーザー情報編集</h2>
            <form action="{{ route('uinfo.update',  ['uinfo' => auth()->user()->uinfo->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf <!-- CSRFトークンを含める -->
            @method('PUT') <!-- PUTリクエストを送信するための方法を指定 -->

            <div class="form-group">
                <label for="profile_name">名前:</label>
                <input type="text" class="form-control" id="profile_name" name="profile_name" value="{{ $uinfo->profile_name }}" required>
            </div>

            <div class="form-group">
                <label for="profile_age">年齢:</label>
                <input type="number" class="form-control" id="profile_age" name="profile_age" value="{{ $uinfo->profile_age }}">
            </div>

            <div class="form-group">
                <label for="profile_picture">プロフィール画像:</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                <img src="{{ asset('storage/'. $uinfo->profile_picture) }}" alt="Profile Picture">
            </div>

            <div class="form-group">
                <label for="profile_intro">自己紹介:</label>
                <textarea class="form-control" id="profile_intro" name="profile_intro">{{ $uinfo->profile_intro }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">更新</button>
        </form>
    </div>
@endsection
