@extends('layouts.app') <!-- 既存のレイアウトを継承する場合 -->

@section('slot')
        @include('components.userpageUinfo')
        @include('components.userpageInterest')
        @include('components.userpageCareer')
        @include('components.userpageBookshelf')
@endsection