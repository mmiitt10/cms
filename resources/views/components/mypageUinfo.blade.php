<html>
<head>
    <style>
        .card-body {
            border: 1px solid #ccc; /* 枠線をグレーに設定 */
            padding: 20px; /* 内部の余白を設定 */
        }
        .edit-button {
            display: inline-block;
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="card-body">
        <img src="{{ asset('storage/'.auth()->user()->uinfo->profile_picture) }}" alt="Profile Picture">
        <p>Name: {{ auth()->user()->uinfo->profile_name }}</p>
        <p>Age: {{ auth()->user()->uinfo->profile_age }}</p>
        <p>Introduction: {{ auth()->user()->uinfo->profile_intro }}</p>
        <p>Profile ID: {{ auth()->user()->uinfo->id }}</p>
        <p>User ID: {{ auth()->user()->uinfo->user_id }}</p>
        <a href="{{ route('uinfo.edit', ['uinfo' => auth()->user()->uinfo->id]) }}" class="edit-button">編集</a>
    </div>
</body>
</html>


