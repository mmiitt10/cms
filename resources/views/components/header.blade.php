<!-- resources/views/layouts/app.blade.php -->
<html>
    <body>
        <header>
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('images/inputlink_logo2.png') }}" alt="Inputlink Logo">
                </a>
            </div>
    
            <nav>
                <ul>
                    <!-- ログインしていない場合の表示項目 -->
                    @guest
                        <li><a href="timeLine">タイムライン</a></li>
                        <li><a href="find">探す</a></li>
                        <li><a href="conRegister">登録する</a></li>
                        <li><a href="management">マネジメント</a></li>
                        <li><a href="{{route('login')}}">ログイン</a></li>
                        <li><a href="{{route('register')}}">会員登録</a></li>
                    <!-- ログインしている場合の表示項目 -->
                    @else
                        <li><a href="timeLine">タイムライン</a></li>
                        <li><a href="find">探す</a></li>
                        <li><a href="register">登録する</a></li>
                        <li><a href="management">マネジメント</a></li>
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
                        <li><a href="mypage">
                            @if(auth()->user()->uinfo && auth()->user()->uinfo->profile_picture)
                                <img src="{{ asset('storage/'.auth()->user()->uinfo->profile_picture) }}" alt="User Icon" style="height: 50px;">
                            @else
                                <img src="{{ asset('path/to/default-user-icon.png') }}" alt="User Icon" style="height: 50px;">
                            @endif
                        </a></li>
                    @endguest
                </ul>
            </nav>
        </header>
    </body>
</html>
