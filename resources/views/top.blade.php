@extends('layouts.app') <!-- 既存のレイアウトを継承する場合 -->

@section('slot')
    {{-- メインコンテンツ部分 --}}
    <div class="container">
        <h1>トップページ1</h1>
        <h1>トップページ2</h1>
        <h1>トップページ3</h1>
    </div>
@endsection
