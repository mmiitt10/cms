<!-- uinfo.register.blade.php -->

@extends('layouts.app') <!-- 既存のレイアウトを継承する場合 -->

@section('slot')
    <form action="{{ route('interest.store') }}" method="POST">
        @csrf
        
        <div>
            <label for="interest_industry1">Interest Industry 1:</label>
            <input type="text" name="interest_industry1" id="interest_industry1">
        </div>
        
        <div>
            <label for="interest_industry2">Interest Industry 2:</label>
            <input type="text" name="interest_industry2" id="interest_industry2">
        </div>
        
        <div>
            <label for="interest_industry3">Interest Industry 3:</label>
            <input type="text" name="interest_industry3" id="interest_industry3">
        </div>
        
        <div>
            <label for="interest_function1">Interest Function 1:</label>
            <input type="text" name="interest_function1" id="interest_function1">
        </div>
        
        <div>
            <label for="interest_function2">Interest Function 2:</label>
            <input type="text" name="interest_function2" id="interest_function2">
        </div>
        
        <div>
            <label for="interest_function3">Interest Function 3:</label>
            <input type="text" name="interest_function3" id="interest_function3">
        </div>
        
        <button type="submit">登録</button>
    </form>

@endsection
