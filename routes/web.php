<?php
// コントローラー
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UinfoController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\LikeController;


// モデル
use App\Models\User;
use App\Models\Uinfo;
use App\Models\Interest;
use App\Models\Career;
use App\Models\Book;
use App\Models\Follow;
use App\Models\Reply;
use App\Models\Like;
use App\Models\CareerSummary;

// ファサード
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// トップ画面
Route::get('/', function () {
    return view('top');
});

// ログイン
Route::get('/login',function(){
    return view('auth.login');
}) ->name('login');

// 会員登録
Route::get('/register',function(){
    return view('auth.register');
}) ->name('register');

// マイページ
    // 自分のマイページ
    Route::get('mypage', [CareerController::class,'showCareerSummary'])->name('mypage');
    
    
    // 他人のマイページ
    Route::get('/user/{id}/mypage', [BookController::class,'showUserBookshelf'])->name('user.page');

// ユーザー情報
    // ユーザー情報登録フォームを表示
    Route::get('/uinfo/create', function () {
        return view('uinfo_register');
    })->name('uinfo.create');
    
    // ユーザー情報登録
    Route::post('/uinfo',[UinfoController::class,'store'])->name('uinfo.store');
    
    // ユーザー情報編集フォームを表示
    Route::get('/uinfo/edit/{uinfo}', [UinfoController::class, 'edit'])->name('uinfo.edit');
    
    // ユーザー情報編集
    Route::put('/uinfo/update/{uinfo}',[UinfoController::class,"update"])->name('uinfo.update');


// 関心情報
    // 関心情報入力フォームを表示
    Route::get('/interest/create', function () {
        return view('interest_register');
    })->name('interest.create');
    
    // 関心情報登録
    Route::post('/interest',[InterestController::class,'store'])->name('interest.store');
    
    // ユーザー情報編集フォームを表示
    Route::get('/interest/edit/{interest}', [InterestController::class, 'edit'])->name('interest.edit');
    
    // ユーザー情報編集
    Route::put('/interest/update/{interest}',[InterestController::class,"update"])->name('interest.update');

// キャリア情報
    // 登録フォーム表示
    Route::get('/career/create', function () {
        return view('career_register');
    })->name('career.create');
    
    // 情報登録
    Route::post('/career',[CareerController::class,'store'])->name('career.store');
    
    // 更新フォーム表示
    Route::get('/career/edit/{career}', [CareerController::class, 'edit'])->name('career.edit');
    
    // 更新
    Route::put('/career/update/{career}',[CareerController::class,"update"])->name('career.update');
    
    //削除 
    Route::delete('/career/{career}', [CareerController::class,"destroy"])->name('career.delete');

// 書籍情報登録
    // 書籍情報登録フォームを表示
    Route::get('/book/search', function () {
        return view('book_search');
    })->name('book.search');
    
    // 書籍情報検索結果を取得
    Route::get('/book/search/result', [BookController::class, 'searchBooks'])->name('book.search.result');
    
    // isbn取得
    Route::get('/book/{isbn}', [BookController::class,'showByISBN'])->name('book.register');
    
    // 情報登録
    Route::post('/book',[BookController::class,'store'])->name('book.store');
    
    // 更新フォーム表示
    Route::get('/book/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
    
    // 更新
    Route::put('/book/{id}/update',[BookController::class,"update"])->name('book.update');
    
    //削除 
    Route::delete('/book/{id}', [BookController::class,"destroy"])->name('book.delete');
    
    // タイムライン表示
    Route::get('/timeline', [BookController::class,"index" ])->name('timeline');

// 本棚機能
    // 本棚表示
    Route::get('/bookshelf', [BookController::class,"showBookshelf" ])->name('bookshelf');
    
//フォロー・フォロワー
    // フォロー機能
    Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
    
    // 自分がフォローしている人を表示する機能
    Route::get('/users/{user}/followings', [FollowController::class, 'followings'])->name('followings');
    
    // フォロー解除機能
    Route::delete('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');
    
    // 自分をフォローしている人を表示する機能
    Route::get('/users/{user}/followers', [FollowController::class, 'followers'])->name('followers');
    
// 返信機能
    // 返信を保存
    Route::post('/books/{book}/replies', [ReplyController::class, 'store'])->name('replies.store');
    
// いいね機能
    // いいね追加・削除
    Route::post('/likes/toggle', [LikeController::class, 'toggle'])->name('likes.toggle');



// そのほか
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
