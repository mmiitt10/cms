<html>
    <div class="card-body">
        @foreach($user->career as $career)
            <p>企業: {{ $career->career_company }}</p>
            <p>入社時期: {{ $career->career_work_from }}</p>
            <p>退社時期: {{ $career->career_work_to }}</p>
            <p>業界: {{ $career->career_industry }}</p>
            <p>職種: {{ $career->career_function }}</p>
            <p>役職: {{ $career->career_position }}</p>
            <hr> <!-- 区切り線を追加 -->
        @endforeach
    </div>
</html>

