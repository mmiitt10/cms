<!--自分がフォローしている人を表示-->
@extends('layouts.app') <!-- 既存のレイアウトを継承する場合 -->

@section('slot')
    <div class="container">
        <h1>フォロー中のユーザー</h1>
        <ul>
            @foreach ($following as $followingUser)
                <ul>
                    @if($followingUser->uinfo->profile_picture)
                        <!-- プロファイル画像の表示 -->
                        <img src="{{ asset('storage/' . $followingUser->uinfo->profile_picture) }}" alt="Profile Picture" style="width: 100px; height: 100px;">
                    @else
                        <!-- プロファイル画像がない場合の代替テキストや画像 -->
                        <img src="/images/no_login_user.png" alt="User Icon" style="width: 100px; height: 100px;">
                    @endif
                    {{ $followingUser->uinfo->profile_name }}
                </ul>
            @endforeach
        </ul>
    </div>
@endsection