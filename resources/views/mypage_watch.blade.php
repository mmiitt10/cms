@extends('layouts.app') <!-- 既存のレイアウトを継承する場合 -->

@section('slot')
        @include('components.mypageUinfo')
        @include('components.mypageInterest')
        @include('components.mypageCareer')
@endsection
<!---->