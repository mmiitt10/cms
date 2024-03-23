<!-- resources/views/layouts/app.blade.php -->
<html>
    <body>
        <header>
            <div class="logo">
                <a href="/">
                    <img src="/images/inputlink_logo2.png" alt="Inputlink Logo">
                </a>
            </div>
    
            <nav class="header-contents">
                <ul>
                    <!-- ログインしていない場合の表示項目 -->
                    @guest
                        <li><a href="{{route('timeline')}}">タイムライン</a></li>
                        <li><a href="{{route('book.search')}}">探す</a></li>
                        <li><a href="{{route('bookshelf')}}">本棚</a></li>
                        <li><a href="{{route('login')}}">ログイン</a></li>
                        <li><a href="{{route('register')}}">会員登録</a></li>
                    <!-- ログインしている場合の表示項目 -->
                    @else
                        <li><a href="{{route('timeline')}}">タイムライン</a></li>
                        <li><a href="{{route('book.search')}}">探す</a></li>
                        <li><a href="{{route('bookshelf')}}">本棚</a></li>
                        <!--ログアウト機能-->
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="route('logout')"
                                   onclick="event.preventDefault();
                                             this.closest('form').submit();">
                                    {{ ('ログアウト') }}
                                </a>
                            </form>
                        </li>
                        <!-- ログインユーザーのアイコン表示 -->
                        <li class="icon"><a href="{{route('mypage')}}">
                            @if(auth()->user()->uinfo && auth()->user()->uinfo->profile_picture)
                                <img src="{{ asset('storage/'.auth()->user()->uinfo->profile_picture) }}" alt="User Icon">
                            @else
                                <img src="/images/no_login_user.png" alt="User Icon">
                            @endif
                        </a></li>
                    @endguest
                </ul>
            </nav>
        </header>
    </body>
</html>
