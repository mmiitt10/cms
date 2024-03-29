<div class="bookshelf">
    
    <!--積読中の書籍-->
    <div class="yet">
        <h2>積読中の書籍</h2>
        @foreach ($books as $book)
            @if ($book->status == 'yet')
                <div class="book">
                    <!--書籍画像-->
                    <a href="{{ route('book.register', ['isbn' => $book->ssbid]) }}">
                        @if (isset($book->googleBookInfo['volumeInfo']['imageLinks']['thumbnail']))
                            <img class="image" src="{{ $book->googleBookInfo['volumeInfo']['imageLinks']['thumbnail'] }}" alt="Book Image">
                        @else
                            <img class="image" src="/images/no_image.png" alt="No Image Available">
                        @endif
                    </a>

                    <!--書籍タイトル-->
                    @if (isset($book->googleBookInfo))
                        <div class="title">書籍タイトル: {{ $book->googleBookInfo['volumeInfo']['title']  ?? 'N/A' }}</div>
                    @endif
                    
                    
                    <!--評価-->
                    <div class="assessment">評価: {{ $book->assessment }}</div>
                    
                    <!--コメント-->
                    <div class="comment">コメント: {{ $book->comment }}</div>
                
                </div>
            @endif
        @endforeach
    </div>
    
    <!--読書中の書籍-->
    <div class="now">
        <h2>読書中の書籍</h2>
        @foreach ($books as $book)
            @if ($book->status == 'now')
                <div class="book">
                    <!--書籍画像-->
                    <a href="{{ route('book.register', ['isbn' => $book->ssbid]) }}">
                        @if (isset($book->googleBookInfo['volumeInfo']['imageLinks']['thumbnail']))
                            <img class="image" src="{{ $book->googleBookInfo['volumeInfo']['imageLinks']['thumbnail'] }}" alt="Book Image">
                        @else
                            <img class="image" src="/images/no_image.png" alt="No Image Available">
                        @endif
                    </a>
                    
                    <!--書籍タイトル-->
                    @if (isset($book->googleBookInfo))
                        <div class="title">書籍タイトル: {{ $book->googleBookInfo['volumeInfo']['title']  ?? 'N/A' }}</div>
                    @endif
                    
                    <!--評価-->
                    <div class="assessment">評価: {{ $book->assessment }}</div>
                    
                    <!--コメント-->
                    <div class="comment">コメント: {{ $book->comment }}</div>

                </div>
            @endif
        @endforeach
    </div>
    
    <!--読了の書籍-->
    <div class="done">
        <h2>読了の書籍</h2>
        @foreach ($books as $book)
            @if ($book->status == 'done')
                <div class="book">
                    <!--書籍画像-->
                    <a href="{{ route('book.register', ['isbn' => $book->ssbid]) }}">
                        @if (isset($book->googleBookInfo['volumeInfo']['imageLinks']['thumbnail']))
                            <img class="image" src="{{ $book->googleBookInfo['volumeInfo']['imageLinks']['thumbnail'] }}" alt="Book Image">
                        @else
                            <img class="image" src="/images/no_image.png" alt="No Image Available">
                        @endif
                    </a>
                    
                    <!--書籍タイトル-->
                    @if (isset($book->googleBookInfo))
                        <div class="title">書籍タイトル: {{ $book->googleBookInfo['volumeInfo']['title']  ?? 'N/A' }}</div>
                    @endif
                    
                    <!--評価-->
                    <div class="assessment">評価: {{ $book->assessment }}</div>
                    
                    <!--コメント-->
                    <div class="comment">コメント: {{ $book->comment }}</div>

                </div>
            @endif
        @endforeach
    </div>
    
</div>