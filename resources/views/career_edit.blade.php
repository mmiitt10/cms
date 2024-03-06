@extends('layouts.app') <!-- 既存のレイアウトを継承する場合 -->

@section('slot')
    <form action="{{ route('career.update',  ['career' => $career->id]) }}" method="POST">
        @csrf
        @method('PUT') <!-- PUTリクエストを送信するための方法を指定 -->

        
        <div>
            <label for="career_company">Company:</label>
            <input type="text" name="career_company" id="career_company" value="{{ $career->career_company }}">
        </div>
        
        <div>
            <label for="career_work_from">Work From:</label>
            <input type="date" name="career_work_from" id="career_work_from" value="{{ $career->career_work_from }}">
        </div>
        
        <div>
            <label for="career_work_to">Work To:</label>
            <input type="date" name="career_work_to" id="career_work_to" value="{{ $career->career_work_to }}">
        </div>
        
        <div>
            <label for="career_industry">Industry:</label>
            <input type="text" name="career_industry" id="career_industry" value="{{ $career->career_industry }}">
        </div>
        
        <div>
            <label for="career_function">Function:</label>
            <input type="text" name="career_function" id="career_function" value="{{ $career->career_function }}">
        </div>
        
        <div>
            <label for="career_position">Position:</label>
            <input type="text" name="career_position" id="career_position" value="{{ $career->career_position }}">
        </div>
        
        <button type="submit"　class="btn btn-primary">更新</button>
    </form>

@endsection
