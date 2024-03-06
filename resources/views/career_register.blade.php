@extends('layouts.app') <!-- 既存のレイアウトを継承する場合 -->

@section('slot')
    <form action="{{ route('career.store') }}" method="POST">
        @csrf
        
        <div class="form-container">
            <div class="form-item">
                <label for="career_company">Company:</label>
                <input type="text" name="career_company[]" id="career_company">
            </div>
            
            <div class="form-item">
                <label for="career_work_from">Work From:</label>
                <input type="date" name="career_work_from[]" id="career_work_from">
            </div>
            
            <div class="form-item">
                <label for="career_work_to">Work To:</label>
                <input type="date" name="career_work_to[]" id="career_work_to">
            </div>
            
            <div class="form-item">
                <label for="career_industry">Industry:</label>
                <input type="text" name="career_industry[]" id="career_industry">
            </div>
            
            <div class="form-item">
                <label for="career_function">Function:</label>
                <input type="text" name="career_function[]" id="career_function">
            </div>
            
            <div class="form-item">
                <label for="career_position">Position:</label>
                <input type="text" name="career_position[]" id="career_position">
            </div>
        </div>
        
        <button type="button" id="add-career">＋</button>
        <button type="submit">登録</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('add-career').addEventListener('click', function() {
                var container = document.querySelector('.form-container');
                var clone = container.cloneNode(true);
                clone.classList.add('new-form-container'); // 新しく追加されるフォームに枠線を追加
                container.parentNode.appendChild(clone);
            });
        });
    </script>
@endsection
