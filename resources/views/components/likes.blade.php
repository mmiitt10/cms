<form action="{{ route('likes.toggle') }}" method="post">
    @csrf
    <input type="hidden" name="likeable_type" value="App\Models\Book">
    <input type="hidden" name="likeable_id" value="{{ $book->id }}">

    @if ($book->isLikedByAuthUser())
        <button type="submit" class="btn-liked" style="background-color: transparent; border: none;">
            <img src="{{ asset('images/like_done.png') }}" alt="Liked">
        </button>
    @else
        <button type="submit" class="btn-not-liked" style="background-color: transparent; border: none;">
            <img src="{{ asset('images/like.png') }}" alt="Not Liked">
        </button>
    @endif

    <!-- いいねの件数 -->
    <span>{{ $book->likes->count() }} いいね</span>
</form>
