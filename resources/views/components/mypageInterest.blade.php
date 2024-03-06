<html>
    <div class="card-body">
        <p>Interest Industry 1: {{ auth()->user()->interest->interest_industry1 }}</p>
        <p>Interest Industry 2: {{ auth()->user()->interest->interest_industry2 }}</p>
        <p>Interest Industry 3: {{ auth()->user()->interest->interest_industry3 }}</p>
        <p>Interest Function 1: {{ auth()->user()->interest->interest_function1 }}</p>
        <p>Interest Function 2: {{ auth()->user()->interest->interest_function2 }}</p>
        <p>Interest Function 3: {{ auth()->user()->interest->interest_function3 }}</p>
        <a href="{{ route('interest.edit', ['interest' => auth()->user()->interest->id]) }}" class="edit-button">編集</a>
    </div>
</html>