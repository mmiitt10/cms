<html>
    <div class="card-body">
        <img src="{{ asset('storage/'. $user->uinfo->profile_picture) }}" alt="Profile Picture">
        <p>名前: {{ $user->uinfo->profile_name }}</p>
        <p>年齢: {{ $user->uinfo->profile_age }}</p>
        <p>自己紹介: {{ $user->uinfo->profile_intro }}</p>
        
        <!--フォロー・フォロー解除ボタン-->
        @if(Auth::check()) <!-- ユーザーがログインしているか確認 -->
            @if(Auth::user()->isFollowing($user->id)) <!-- ログインユーザーがこのユーザーをフォローしているか確認 -->
                <!-- フォロー解除ボタン -->
                <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">フォロー解除</button>
                </form>
            @else
                <!-- フォローボタン -->
                <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">フォローする</button>
                </form>
            @endif
        @endif
        
        <!--フォローしている人・されている人を表示するボタン-->
        <!-- フォローしている人を表示するリンク -->
        <a href="{{ route('followings', ['user' => $user->id]) }}" class="btn btn-link">フォロー中</a>
        
        <!-- フォローされている人を表示するリンク（自分のプロフィールでのみ表示）-->
        <a href="{{ route('followers', ['user' => $user->id]) }}" class="btn btn-link">フォロワー</a>

    </div>
</html>