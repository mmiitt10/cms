{{-- postcard.blade.php --}}
<div class="postcard">
    
    <!--ユーザー情報を抽出-->
    <div class="postcard_uinfo">
        
        {{-- ユーザー画像 --}}
        <div class="image">
            @if(auth()->user()->uinfo->profile_picture)
                <img src="{{ asset('storage/'.auth()->user()->uinfo->profile_picture) }}" alt="User Image" class="user-image">
            @else
                <img src="{{ asset('images/no_login_user.png') }}" alt="Default User Image" class="user-image">
            @endif
        </div>
        
        <!--名前-->
        <div class="name">
            <p>名前：{{ auth()->user()->uinfo->profile_name }}</p>
        </div>
        
    </div>
    
    <!--キャリア情報を抽出-->
    <div class="postcard_career">
    
        <!--所属企業-->
        <div class="company">
            <p>
               {{auth()->user()->career[0]->career_company}}
            </p>
        </div>
        
        <!--役職-->
        <div class="position">
            <p>
               {{auth()->user()->career[0]->career_position}}
            </p>
        </div>
    </div>
    
    <!--書籍情報を抽出-->
    <!--<div class="postcard_book">-->
    
        <!--書籍画像-->
    <!--    <div class="image">-->
            
    <!--    </div>-->
        
        <!--書籍名-->
    <!--    <div class="name">-->
            
    <!--    </div>-->
        
        <!--コメント-->
    <!--    <div class="name">-->
            
    <!--    </div>-->

        <!--評価-->
    <!--    <div class="name">-->
            
    <!--    </div>-->
    <!--</div>-->
    
</div>
