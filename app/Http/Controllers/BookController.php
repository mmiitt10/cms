<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\CareerSummary;
use App\Events\CareerUpdated;

// キャッシュを使用してAPIの負荷を減らす
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;

// デバッグ確認
use Illuminate\Support\Facades\Log;


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

        return view('timeline', ['books' => $books]);
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
        $books = [];
    
        // パラメータ
        $search_query = $request->input('search');
        $startIndex = $request->input('start', 0); // デフォルトは0から開始
        $maxResults = 10; // 1ページあたりのアイテム数
    
        if (empty($search_query)) {
            return view('book_search', ['search_error' => '検索クエリを入力してください。']);
        }
    
        // Google Books APIのURLを構築
        $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($search_query)
             . "&startIndex=" . $startIndex
             . "&maxResults=" . $maxResults;
    
        // APIからのレスポンスを取得
        $response = @file_get_contents($url);
    
        // レスポンスをデコード
        if ($response) {
            $data = json_decode($response);
    
            if (isset($data->items)) {
                $books = $data->items;
                
                // 出版日が新しい順にソート
                usort($books, function ($a, $b) {
                    $dateA = $a->volumeInfo->publishedDate ?? '0000';
                    $dateB = $b->volumeInfo->publishedDate ?? '0000';
                    return strcmp($dateB, $dateA); // 降順にする
                });
    
                $total_items = $data->totalItems;
            } else {
                $search_error = '検索結果が見つかりませんでした。';
            }
        } else {
            $search_error = 'APIリクエストに失敗しました。';
        }
    
        return view('book_search_result', compact('books', 'total_items', 'search_error', 'search_query', 'startIndex', 'maxResults'));
    }

    
    // public function searchBooks(Request $request)
    // {
        
    //     // 初期化
    //     $search_error = '';
    //     $total_items = 0;
    //     $books = [];
        
    //     // パラメータ
    //     $search_query = $request->input('search');
    //     $startIndex = $request->input('start', 0); // デフォルトは0から開始
    //     $maxResults = 20; // 1ページあたりのアイテム数
    
    //     // 検索クエリが空の場合はエラーメッセージを設定
    //     if (empty($search_query)) {
    //         $search_error = '検索クエリを入力してください。';
    //         return view('book_search');
    //     }
    
    //     // Google Books APIのURLを構築
    //     $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($search_query)
    //          . "&startIndex=" . $startIndex
    //          . "&maxResults=" . $maxResults;

    //     // APIからのレスポンスを取得
    //     $response = file_get_contents($url);
        
    //     // レスポンスをデコード
    //     $data = json_decode($response);
        
    //     // レスポンスをデコード
    //     if ($response) {
    //             $data = json_decode($response);
        
    //             if (isset($data->items)) {
    //                 $books = $data->items;
    //                 $total_items = $data->totalItems;
    //             } else {
    //                 $search_error = '検索結果が見つかりませんでした。';
    //             }
    //         } else {
    //             $search_error = 'APIリクエストに失敗しました。';
    //         }
        
    //     return view('book_search_result', compact('books', 'total_items', 'search_error', 'search_query', 'startIndex', 'maxResults'));
    // }
    
    public function showByISBN($isbn)
    {
        // APIのURLを作成
        $url = "https://www.googleapis.com/books/v1/volumes?q=isbn:" . $isbn;
    
        // APIからのレスポンスを取得
        $response = @file_get_contents($url); // エラーを抑制
    
        // レスポンスの確認
        if ($response === false) {
            // APIリクエストに失敗した場合
            return redirect()->back()->withErrors(['msg' => '書籍情報の取得に失敗しました。']);
        }
    
        // レスポンスをデコード
        $bookData = json_decode($response);
        
        // データベースからISBNに一致するすべての書籍を検索
        $dbBooks = Book::where('ssbid', $isbn)->get();
    
        // 書籍情報が存在するか確認
        if (isset($bookData->items) && !empty($bookData->items)) {
            $volumeInfo = $bookData->items[0]->volumeInfo;
            $title = $volumeInfo->title ?? 'タイトル不明';
            $authors = $volumeInfo->authors ?? ['著者不明'];
            $thumbnail = $volumeInfo->imageLinks->thumbnail ?? 'no_image.png';
            $description = $volumeInfo->description ?? '概要がありません。';
            $publishedDate = $volumeInfo->publishedDate ?? '出版日がありません。';
        } else {
            // 該当する書籍が見つからない場合
            return redirect()->back()->withErrors(['msg' => '該当する書籍が見つかりませんでした。']);
        }
    
        // ビューに書籍情報を渡す
        return view('book_register', compact('isbn', 'title', 'authors', 'thumbnail', 'description', 'publishedDate','dbBooks'));
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
    
    
    public function showBookshelf()
    {
        
        // 現在ログインしているユーザーのIDを取得
        $userId = auth()->id();
    
        // 現在のユーザーが登録した書籍情報のみを取得
        $books = Book::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        
        $client = new Client();
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

        return view('bookshelf', ['books' => $books]);
    }
    
    public function showUserBookshelf($id)
    {
        // クリックしたユーザーの情報を取得
        $user = User::findOrFail($id);
    
        // クリックしたユーザーが登録した書籍情報のみを取得
        $books = Book::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();        
        
        $client = new Client();
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
        
        // 特定のユーザーIDに基づく情報を取得
        $industrySummaries = CareerSummary::where('user_id', $id)
                                ->where('type', 'industry')
                                ->get();
    
        $functionSummaries = CareerSummary::where('user_id', $id)
                                ->where('type', 'function')
                                ->get();
    
        // ビューにデータを渡す
        return view('mypage_watch', compact('user', 'books', 'industrySummaries', 'functionSummaries'));
        
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
    public function edit($id)
    {
        // IDによって書籍を見つける、見つからなければ404エラー
        $book = Book::findOrFail($id); 
        
        // 格納しているisbnを抽出
        $isbn = $book->ssbid;
        
        // APIのURLを作成
        $url = "https://www.googleapis.com/books/v1/volumes?q=isbn:" . $isbn;
    
        // APIからのレスポンスを取得
        $response = @file_get_contents($url); // エラーを抑制
    
        // レスポンスの確認
        if ($response === false) {
            // APIリクエストに失敗した場合
            return redirect()->back()->withErrors(['msg' => '書籍情報の取得に失敗しました。']);
        }
    
        // レスポンスをデコード
        $bookData = json_decode($response);
        
        // データベースからISBNに一致するすべての書籍を検索
        $dbBooks = Book::where('ssbid', $isbn)->get();
    
        // 書籍情報が存在するか確認
        if (isset($bookData->items) && !empty($bookData->items)) {
            $volumeInfo = $bookData->items[0]->volumeInfo;
            $title = $volumeInfo->title ?? 'タイトル不明';
            $authors = $volumeInfo->authors ?? ['著者不明'];
            $thumbnail = $volumeInfo->imageLinks->thumbnail ?? 'no_image.png';
            $description = $volumeInfo->description ?? '概要がありません。';
            $publishedDate = $volumeInfo->publishedDate ?? '出版日がありません。';
        } else {
            // 該当する書籍が見つからない場合
            return redirect()->back()->withErrors(['msg' => '該当する書籍が見つかりませんでした。']);
        }
        
        // ビューに書籍情報を渡す
        return view('book_edit', compact('book','isbn', 'title', 'authors', 'thumbnail', 'description', 'publishedDate','dbBooks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // バリデーションルールの定義
        $validator = Validator::make($request->all(), [
            'ssbid' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'assessment' => 'required|integer|min:0|max:5',
            'comment' => 'nullable|string',
        ]);
    
        // バリデーションエラーを設定
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // 指定されたIDで書籍情報を見つける、見つからなければ404エラーを返す
        $book = Book::findOrFail($id);
    
        // リクエストデータで書籍情報を更新
        $book->ssbid = $request->ssbid;
        $book->status = $request->status;
        $book->assessment = $request->assessment;
        $book->comment = $request->comment;
        $book->save(); // 更新された書籍情報を保存
    
        // 書籍情報の更新後、ユーザーをbookshelfページにリダイレクト
        return redirect('/bookshelf')->with('success', '書籍情報が更新されました！');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id); // IDに基づいて書籍を見つける
        $book->delete(); // 書籍を削除
        return redirect('/bookshelf')->with('success', '書籍が削除されました！');
    }
    
    
}
