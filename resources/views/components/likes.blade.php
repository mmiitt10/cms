<div class="flex items-center">
    <form action="{{ route('likes.toggle') }}" method="post" class="flex items-center">
        @csrf
        <input type="hidden" name="likeable_type" value="App\Models\Book">
        <input type="hidden" name="likeable_id" value="{{ $book->id }}">

        @if ($book->isLikedByAuthUser())
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-700 mr-2" style="background-color: transparent; border: none;">
                <img src="{{ asset('images/like_done.png') }}" alt="Liked" class="h-6 w-6">
            </button>
        @else
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-300 hover:bg-gray-400 mr-2" style="background-color: transparent; border: none;">
                <img src="{{ asset('images/like.png') }}" alt="Not Liked" class="h-6 w-6">
            </button>
        @endif

        <!-- いいねの件数 -->
        <span class="text-sm font-medium">{{ $book->likes->count() }} いいね</span>
    </form>
</div>
