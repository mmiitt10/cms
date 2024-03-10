@extends('layouts.app') <!-- 既存のレイアウトを継承する場合 -->

@section('slot')
    <!--ログインしていない場合-->
    @if( auth()->user()->uinfo ===null)
        <a href="{{route('uinfo.create')}}">会員登録する</a>
        
    @else
    <!--ログインしている場合-->
        @include('components.mypageUinfo')
        @include('components.mypageInterest')
        @include('components.mypageCareer')
    @endif
@endsection