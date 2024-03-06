<!-- uinfo.register.blade.php -->

@extends('layouts.app') <!-- 既存のレイアウトを継承する場合 -->

@section('slot')
    <div class="container">
        <h2>ユーザー情報登録</h2>
        <form action="{{ route('uinfo.store') }}" method="POST" enctype="multipart/form-data">
            @csrf <!-- CSRFトークンを含める -->

            <div class="form-group">
                <label for="profile_name">名前:</label>
                <input type="text" class="form-control" id="profile_name" name="profile_name" required>
            </div>

            <div class="form-group">
                <label for="profile_age">年齢:</label>
                <input type="number" class="form-control" id="profile_age" name="profile_age">
            </div>

            <div class="form-group">
                <label for="profile_picture">プロフィール画像:</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture">
            </div>

            <div class="form-group">
                <label for="profile_intro">自己紹介:</label>
                <textarea class="form-control" id="profile_intro" name="profile_intro"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">登録</button>
        </form>
    </div>
@endsection
