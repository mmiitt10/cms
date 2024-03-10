<html>
    <div class="card-body">
        <img src="{{ asset('storage/'. $user->uinfo->profile_picture) }}" alt="Profile Picture">
        <p>名前: {{ $user->uinfo->profile_name }}</p>
        <p>年齢: {{ $user->uinfo->profile_age }}</p>
        <p>自己紹介: {{ $user->uinfo->profile_intro }}</p>
    </div>
</html>