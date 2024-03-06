<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class InterestController extends Controller
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
    public function store(Request $request)
    {
        // バリデーションルールの定義
        $validator=Validator::make($request->all(),[
            'interest_industry1' => 'required|string|max:255',
            'interest_industry2' => 'required|string|max:255',
            'interest_industry3' => 'required|string|max:255',
            'interest_function1' => 'required|string|max:255',
            'interest_function2' => 'required|string|max:255',
            'interest_function3' => 'required|string|max:255',
        ]);
        
        // バリデーションエラーを設定
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // モデルを使用してデータを保存
        $interest = new Interest();
        $interest->user_id = auth()->id();
        $interest->interest_industry1 = $request->interest_industry1;
        $interest->interest_industry2 = $request->interest_industry2;
        $interest->interest_industry3 = $request->interest_industry3;
        $interest->interest_function1 = $request->interest_function1;
        $interest->interest_function2 = $request->interest_function2;
        $interest->interest_function3 = $request->interest_function3;
        $interest->save();

        // リダイレクトまたはレスポンスを返す
        return redirect('/career/create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Interest $interest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Interest $interest)
    {
        return view('interest_edit', ['interest' => $interest]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Interest $interest)
    {
        // バリデーションルールの定義
        $validator=Validator::make($request->all(),[
            'interest_industry1' => 'required|string|max:255',
            'interest_industry2' => 'required|string|max:255',
            'interest_industry3' => 'required|string|max:255',
            'interest_function1' => 'required|string|max:255',
            'interest_function2' => 'required|string|max:255',
            'interest_function3' => 'required|string|max:255',
        ]);
        
        // バリデーションエラーを設定
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // モデルを使用してデータを保存
        $interest->interest_industry1 = $request->interest_industry1;
        $interest->interest_industry2 = $request->interest_industry2;
        $interest->interest_industry3 = $request->interest_industry3;
        $interest->interest_function1 = $request->interest_function1;
        $interest->interest_function2 = $request->interest_function2;
        $interest->interest_function3 = $request->interest_function3;
        $interest->save();

        // リダイレクトまたはレスポンスを返す
        return redirect('mypage')->with('success', '登録情報が更新されました');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interest $interest)
    {
        //
    }
}
