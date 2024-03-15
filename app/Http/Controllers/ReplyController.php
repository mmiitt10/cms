<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $bookId)
    {
        $request->validate([
            'comment' => 'required', // 必要に応じてバリデーションルールを調整
        ]);
    
        $reply = new Reply();
        $reply->comment = $request->comment;
        $reply->book_id = $bookId; // ここで、返信がどの投稿に紐づくかを設定
        $reply->user_id = auth()->id(); // ユーザーIDを設定
        $reply->save();
    
        return redirect()->back()->with('success', '返信が成功しました！');
    }


    /**
     * Display the specified resource.
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reply $reply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reply $reply)
    {
        //
    }
}
