<html>
    <div class="card-body">
        @foreach(auth()->user()->career as $career)
            <p>Company: {{ $career->career_company }}</p>
            <p>Joined: {{ $career->career_work_from }}</p>
            <p>Left: {{ $career->career_work_to }}</p>
            <p>Career Industry: {{ $career->career_industry }}</p>
            <p>Career Function: {{ $career->career_function }}</p>
            <p>Position: {{ $career->career_position }}</p>
            <a href="{{ route('career.edit', ['career' => $career->id]) }}" class="edit-button">編集</a>
            <form action="{{ route('career.delete', ['career' => $career->id]) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="edit-button">削除</button>
            </form>
            <hr> <!-- 区切り線を追加 -->
        @endforeach
    </div>

    <div class="card-body" id="career-form" style="display: none;">
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
            
            <button type="submit">登録</button>
        </form>
    </div>

    <div class="card-body">
        <button type="button" id="add-career">＋</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('add-career').addEventListener('click', function() {
                var form = document.getElementById('career-form');
                form.style.display = 'block';
            });
        });
    </script>
</html>

