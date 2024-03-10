<html>
    <div class="card-body">
        <img src="{{ asset('storage/'.auth()->user()->uinfo->profile_picture) }}" alt="Profile Picture">
        <p>名前: {{ auth()->user()->uinfo->profile_name }}</p>
        <p>年齢: {{ auth()->user()->uinfo->profile_age }}</p>
        <p>自己紹介: {{ auth()->user()->uinfo->profile_intro }}</p>
        <p hidden>Profile ID: {{ auth()->user()->uinfo->id }}</p>
        <p hidden>User ID: {{ auth()->user()->uinfo->user_id }}</p>
        <a href="{{ route('uinfo.edit', ['uinfo' => auth()->user()->uinfo->id]) }}" class="edit-button">編集</a>
    </div>
</html>

