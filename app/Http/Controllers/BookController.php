<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

// キャッシュを使用してAPIの負荷を減らす
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        $books = Book::orderBy('created_at', 'desc')->get();
    
        foreach ($books as $book) {
            // ISBN に基づいてキャッシュキーを生成
            $cacheKey = 'book_info_' . $book->ssbid;
    
            // キャッシュから書籍情報を取得しようと試みる
            $bookInfo = Cache::remember($cacheKey, 60*24, function () use ($client, $book) {
                // キャッシュにデータがない場合は、API を叩いてデータを取得
                $response = $client->request('GET', 'https://www.googleapis.com/books/v1/volumes', [
                    'query' => ['q' => 'isbn:' . $book->ssbid]
                ]);
    
                if ($response->getStatusCode() == 200) {
                    $data = json_decode($response->getBody()->getContents(), true);
                    return $data['items'][0] ?? null;
                }
    
                return null; // APIからのレスポンスが異常な場合
            });
    
            // 取得した情報を書籍オブジェクトに追加
            $book->googleBookInfo = $bookInfo;
        }

        return view('books.timeline', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    

    // 書籍情報を検索
    public function searchBooks(Request $request)
    {
        
        $search_error = '';
        $total_items = 0;
        
        // 検索クエリを取得
        $search_query = $request->input('search');
    
        // 検索クエリが空の場合はエラーメッセージを設定
        if (empty($search_query)) {
            $search_error = '検索クエリを入力してください。';
            return view('book_search');
        }
    
        // Google Books APIのURL
        // $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($search_query) ;
        // . "&langRestrict=ja";
        $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($search_query);


        // APIからのレスポンスを取得
        $response = file_get_contents($url);
        
        // レスポンスをデコード
        $data = json_decode($response);
        
        if ($data && isset($data->items)) {
                $books = $data->items;
                
                // 出版日が新しい順番にソート
                usort($books, function ($a, $b) {
                    // publishedDate プロパティが存在するかチェック
                    if (isset($a->volumeInfo->publishedDate) && isset($b->volumeInfo->publishedDate)) {
                        return strtotime($b->volumeInfo->publishedDate) - strtotime($a->volumeInfo->publishedDate);
                    } else {
                        // publishedDate プロパティが存在しない場合は同じ値を返す
                        return 0;
                    }
                });
                
                $total_items = $data->totalItems;
                
                return view('book_search_result', compact('books','total_items'));
            } else {
                $search_error = '検索結果が見つかりませんでした。';
        }
    } 
    
    
    // book_register.blade.phpに書籍のisbn情報を渡す
    public function showByISBN($isbn)
    {
        // APIのURLを作成
        $url = "https://www.googleapis.com/books/v1/volumes?q=isbn:" . $isbn;


        // APIからのレスポンスを取得
        $response = file_get_contents($url);
        
        // レスポンスをデコード
        $bookData = json_decode($response);
        
        if (isset($bookData->items[0]->volumeInfo)) {
            $volumeInfo = $bookData->items[0]->volumeInfo;
            $title = $volumeInfo->title ?? '';
            $authors = $volumeInfo->authors ?? '著者不明';
            $thumbnail = $volumeInfo->imageLinks->thumbnail ?? 'no_image.png';
            $description = $volumeInfo->description ?? '概要がありません。';
            $publishedDate = $volumeInfo->publishedDate ?? '出版日がありません。';
        } else {
            // エラーハンドリング
            return view('book_search');
        }

        // ビューに書籍情報を渡す
        return view('book_register',compact('isbn','title', 'authors', 'thumbnail', 'description', 'publishedDate'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーションルールの定義
        $validator=Validator::make($request->all(),[
            'ssbid' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'assessment' => 'required|integer|min:0|max:5',
            'comment' => 'nullable|string',
        ]);
        
        // バリデーションエラーを設定
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // モデルを使用してデータを保存
        $book = new Book();
        $book->user_id = auth()->id();
        $book->ssbid = $request->ssbid;
        $book->status = $request->status;
        $book->assessment = $request->assessment;
        $book->comment = $request->comment;
        $book->save();

        // リダイレクトまたはレスポンスを返す
        return redirect('/bookshelf');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
    
    // 書籍のisbn情報をもとにtimelineに情報を渡す
    public function isbnToTimeline($isbn)
    {
        // books DBに登録しているisbnを抜き出す
        
        
        // APIのURLを作成
        $url = "https://www.googleapis.com/books/v1/volumes?q=isbn:" . $isbn;


        // APIからのレスポンスを取得
        $response = file_get_contents($url);
        
        // レスポンスをデコード
        $bookData = json_decode($response);
        
        if (isset($bookData->items[0]->volumeInfo)) {
            $volumeInfo = $bookData->items[0]->volumeInfo;
            $title = $volumeInfo->title ?? '';
            $authors = $volumeInfo->authors ?? '著者不明';
            $thumbnail = $volumeInfo->imageLinks->thumbnail ?? 'no_image.png';
            $description = $volumeInfo->description ?? '概要がありません。';
            $publishedDate = $volumeInfo->publishedDate ?? '出版日がありません。';
        } else {
            // エラーハンドリング
            return view('book_search');
        }

        // ビューに書籍情報を渡す
        return view('book_register',compact('isbn','title', 'authors', 'thumbnail', 'description', 'publishedDate'));
    }
    
}
