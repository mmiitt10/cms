@extends('layouts.app') <!-- 既存のレイアウトを継承する場合 -->

@section('slot')
    {{-- メインコンテンツ部分 --}}
    
    <!--ファーストビュー-->
    <section class="text-gray-600 body-font">
      <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
        <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
          <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">インプットでつながるキャリアSNS
          </h1>
          <p class="mb-8 leading-relaxed">Copper mug try-hard pitchfork pour-over freegan heirloom neutra air plant cold-pressed tacos poke beard tote bag. Heirloom echo park mlkshk tote bag selvage hot chicken authentic tumeric truffaut hexagon try-hard chambray.</p>
        </div>
        <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
            <img class="object-cover object-center rounded" alt="hero" src="{{ asset('images/top_picture.jpg') }}">
        </div>
      </div>
    </section>
    
    <!--訴求ポイント-->
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4">
                
                <div class="p-4 md:w-1/3">
                    <div class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                         <div class="p-6 text-center">
                            <img class="mx-auto block h-24 w-32 object-cover" src="{{ asset('images/your-image-path.png') }}" alt="Centered Image">
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">The Catalyzer</h1>
                            <p class="leading-relaxed mb-3">ここにテキストが入ります。</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-4 md:w-1/3">
                    <div class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                         <div class="p-6 text-center">
                            <img class="mx-auto block h-24 w-32 object-cover" src="{{ asset('images/your-image-path.png') }}" alt="Centered Image">
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">The Catalyzer</h1>
                            <p class="leading-relaxed mb-3">ここにテキストが入ります。</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-4 md:w-1/3">
                    <div class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                         <div class="p-6 text-center">
                            <img class="mx-auto block h-24 w-32 object-cover" src="{{ asset('images/your-image-path.png') }}" alt="Centered Image">
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">The Catalyzer</h1>
                            <p class="leading-relaxed mb-3">ここにテキストが入ります。</p>
                        </div>
                    </div>
                </div>
                
                <!--<div class="p-4 md:w-1/3">-->
                <!--     <div class="p-6 text-center">-->
                <!--        <img class="mx-auto block h-24 w-32 object-cover" src="{{ asset('images/your-image-path.png') }}" alt="Centered Image">-->
                <!--        <h1 class="title-font text-lg font-medium text-gray-900 mb-3">The Catalyzer</h1>-->
                <!--        <p class="leading-relaxed mb-3">ここにテキストが入ります。</p>-->
                <!--    </div>-->
                <!--</div>-->
                
                <!--<div class="p-4 md:w-1/3">-->
                <!--     <div class="p-6 text-center">-->
                <!--        <img class="mx-auto block h-24 w-32 object-cover" src="{{ asset('images/your-image-path.png') }}" alt="Centered Image">-->
                <!--        <h1 class="title-font text-lg font-medium text-gray-900 mb-3">The Catalyzer</h1>-->
                <!--        <p class="leading-relaxed mb-3">ここにテキストが入ります。</p>-->
                <!--    </div>-->
                <!--</div>-->
                
                <!--<div class="p-4 md:w-1/3">-->
                <!--    <div class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">-->
                <!--        <img class="w-32 h-24 object-cover" src="{{ asset('images/senior.png') }}" alt="blog">-->
                <!--        <div class="p-6">-->
                <!--            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">The Catalyzer</h1>-->
                <!--            <p class="leading-relaxed mb-3">Photo booth fam kinfolk cold-pressed sriracha leggings jianbing microdosing tousled waistcoat.</p>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                
                <!--<div class="p-4 md:w-1/3">-->
                <!--    <div class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">-->
                <!--        <img class="w-32 h-24 object-cover" src="{{ asset('images/management.png') }}" alt="blog">-->
                <!--        <div class="p-6">-->
                <!--            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">The Catalyzer</h1>-->
                <!--            <p class="leading-relaxed mb-3">Photo booth fam kinfolk cold-pressed sriracha leggings jianbing microdosing tousled waistcoat.</p>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                
            </div>
        </div>
    </section>
    
    <div class="container">
        
        <!--業種-->
        <h2>同じ業種の先輩</h2>
        @if(auth()->check())
            @if(isset($qualifiedUsersForIndustry) && $qualifiedUsersForIndustry->count() > 0)
                @foreach($qualifiedUsersForIndustry as $user)
                    <div class="flex items-start space-x-4 mb-2">
                        <a href="{{ route('user.page', ['id' => $user->user_id]) }}">
                            <img src="{{ asset('storage/'.$user->profile_picture) }}" alt="Profile Picture" class="h-12 w-12 object-cover rounded-full">
                        </a>
                        <div>
                            <div class="text-xl font-bold">{{ $user->profile_name }}</div>
                            <div class="text-sm">{{ $user->user->career[0]->career_company }} / {{ $user->user->career[0]->career_position }}</div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>該当するユーザーはいません。</p>
            @endif
        @else
            <div>
                <a href="{{ route('login') }}" class="btn btn-primary">ログイン</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">会員登録</a>
            </div>
        @endif
        
        <!--職種-->
        <h2>同じ職種の先輩</h2>
        @if(auth()->check())
            @if(isset($qualifiedUsersForFunction) && $qualifiedUsersForFunction->count() > 0)
                @foreach($qualifiedUsersForFunction as $user)
                    <div class="flex items-start space-x-4 mb-2">
                        <a href="{{ route('user.page', ['id' => $user->user_id]) }}">
                            <img src="{{ asset('storage/'.$user->profile_picture) }}" alt="Profile Picture" class="h-12 w-12 object-cover rounded-full">
                        </a>
                        <div>
                            <div class="text-xl font-bold">{{ $user->profile_name }}</div>
                            <div class="text-sm">{{ $user->user->career[0]->career_company }} / {{ $user->user->career[0]->career_position }}</div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>該当するユーザーはいません。</p>
            @endif
        @else
            <div>
                <a href="{{ route('login') }}" class="btn btn-primary">ログイン</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">会員登録</a>
            </div>
        @endif
        
    </div>


@endsection
