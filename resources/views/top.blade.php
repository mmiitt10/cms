@extends('layouts.app')

@section('slot')
<div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 bg-gray-100 bg-white">
    
    <div class="container mx-auto flex px-12 py-4 items-center justify-center">
        <div class="lg:flex-grow md:w-1/2 flex flex-col items-center text-center">
            <h1 class="top_about">インプットでつながるキャリアSNS</h1>
            <h1 class="top_title">INPUTLINK for Career</h1>
        </div>
        <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
            <img class="object-cover object-center rounded" alt="hero" src="{{ asset('images/top_picture.jpg') }}">
        </div>
    </div>
    
    <section class="text-gray-600 body-font container px-12 py-12 mx-auto">
            <div class="flex flex-wrap -m-4">
                
                <div class="p-4 md:w-1/3">
                    <div class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                         <div class="p-6 text-center">
                            <img class="mx-auto block h-24 w-32 mb-4 object-cover" src="{{ asset('images/book.png') }}" alt="Centered Image">
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-4">あなたに最適な情報が見つかる</h1>
                            <p class="leading-relaxed mb-3">自分のレベルにぴったりの情報を探すのは難しいもの。<br>INPUTLINK for Careerなら、あなたと同じようなレベルや先輩のインプット情報を見つけられます</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-4 md:w-1/3">
                    <div class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                         <div class="p-6 text-center">
                            <img class="mx-auto block h-24 w-32 mb-4 object-cover" src="{{ asset('images/senior.png') }}" alt="Centered Image">
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-4">自分の師匠が見つかる</h1>
                            <p class="leading-relaxed mb-3">背中を追いたくなるような人が身近にいるとは限りません。<br>INPUTLINK for Careerなら、目指すべきキャリアや同じような課題を乗り越えた「師匠」に出会えます</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-4 md:w-1/3">
                    <div class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                         <div class="p-6 text-center">
                            <img class="mx-auto block h-24 w-32 mb-4 object-cover" src="{{ asset('images/management.png') }}" alt="Centered Image">
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-4">インプット情報を管理できる</h1>
                            <p class="leading-relaxed mb-3">たくさんの情報をインプットしていると、その情報を管理するのは大変なもの。<br>INPUTLINK for Careerなら、本・ウェブ記事・論文などありとあらゆる情報を一覧で管理できます</p>
                        </div>
                    </div>
                </div>
                
            </div>
    </section>
    
    <div class="container mx-auto px-12 py-12">
        <!--業種-->
        <div class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden px-4 py-4">
            <h2 class="text-center title-font text-lg font-medium text-gray-900 mb-4">同じ業種の先輩</h2>
            @if(auth()->check())
                <div class="flex flex-wrap justify-center items-center">
                @if(isset($qualifiedUsersForIndustry) && $qualifiedUsersForIndustry->count() > 0)
                    @foreach($qualifiedUsersForIndustry as $user)
                    <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg mb-2">
                        <div class="flex items-start space-x-4 mb-2">
                            <a href="{{ route('user.page', ['id' => $user->user_id]) }}">
                                <img src="{{ asset('storage/'.$user->profile_picture) }}" alt="Profile Picture" class="h-12 w-12 object-cover rounded-full">
                            </a>
                            <div>
                                <div class="text-xl font-bold">{{ $user->profile_name }}</div>
                                <div class="text-sm">{{ $user->user->career[0]->career_company }} / {{ $user->user->career[0]->career_position }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p>該当するユーザーはいません。</p>
                @endif
                </div>
            @else
                <div class="text-center">
                    <a>ログイン・会員登録をして先輩を探そう</a>
                </div>
            @endif
        </div>
        
        <!--職種-->
        <div class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden px-4 py-4">
            <h2 class="text-center title-font text-lg font-medium text-gray-900 mb-4">同じ職種の先輩</h2>
            @if(auth()->check())
                <div class="flex flex-wrap justify-center items-center">
                    @if(isset($qualifiedUsersForFunction) && $qualifiedUsersForFunction->count() > 0)
                        @foreach($qualifiedUsersForFunction as $user)
                        <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg mb-2">
                            <div class="flex items-start space-x-4 mb-2">
                                <a href="{{ route('user.page', ['id' => $user->user_id]) }}">
                                    <img src="{{ asset('storage/'.$user->profile_picture) }}" alt="Profile Picture" class="h-12 w-12 object-cover rounded-full">
                                </a>
                                <div>
                                    <div class="text-xl font-bold">{{ $user->profile_name }}</div>
                                    <div class="text-sm">{{ $user->user->career[0]->career_company }} / {{ $user->user->career[0]->career_position }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p>該当するユーザーはいません。</p>
                    @endif
                </div>
            @else
                <div class="text-center">
                    <a>ログイン・会員登録をして先輩を探そう</a>
                </div>
            @endif
        </div>

    </div>


</div>
@endsection
