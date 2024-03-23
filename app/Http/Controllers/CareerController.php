<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\CareerSummary;
use App\Events\CareerUpdated;

class CareerController extends Controller
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
        $validator = Validator::make($request->all(), [
            'career_company' => 'required|string|max:255',
            'career_work_from' => 'required|date',
            'career_work_to' => 'required|date',
            'career_industry' => 'required|string|max:255',
            'career_function' => 'required|string|max:255',
            'career_position' => 'required|string|max:255',
        ]);
    
        // バリデーションエラーを設定
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // 新しいキャリアモデルを作成して保存
        $career = new Career();
        $career->user_id = auth()->id();
        $career->career_company = $request->career_company;
        $career->career_work_from = $request->career_work_from;
        $career->career_work_to = $request->career_work_to;
        $career->career_industry = $request->career_industry;
        $career->career_function = $request->career_function;
        $career->career_position = $request->career_position;
        $career->save();
    
        // '新しい職歴を追加'ボタンが押された場合、新しいフォームを表示
        if ($request->input('submit') == 'save_and_new') {
            event(new CareerUpdated($career));
            return redirect()->route('career.create'); // 新しいフォーム画面へリダイレクト
        }
    
        // 通常の'登録'ボタンが押された場合、例えばマイページへリダイレクト
        event(new CareerUpdated($career));
        return redirect('mypage')->with('success', 'キャリア情報が登録されました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Career $career)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Career $career)
    {
        return view('career_edit', ['career' => $career]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Career $career)
    {
        // バリデーションチェック
        $validator=Validator::make($request->all(),[
            'career_company' => 'required|string|max:255',
            'career_work_from' => 'required|date',
            'career_work_to' => 'required|date',
            'career_industry' => 'required|string|max:255',
            'career_function' => 'required|string|max:255',
            'career_position' => 'required|string|max:255',
        ]);
        
        // バリデーションエラーを設定
        if($validator->fails()){
            return redirect('/')
                ->withInput
                ->withErrors($validator);
        }

        // モデルを使用してデータを保存
        $career->career_company = $request->career_company;
        $career->career_work_from = $request->career_work_from;
        $career->career_work_to = $request->career_work_to;
        $career->career_industry = $request->career_industry;
        $career->career_function = $request->career_function;
        $career->career_position = $request->career_position;
        $career->save();
        
        event(new CareerUpdated($career));
        
        return redirect('mypage')->with('success', '登録情報が更新されました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Career $career)
    {
        $career->delete();       //追加
        event(new CareerUpdated($career));
        return redirect('mypage');  //追加
    }
    
    /**
     * ログインユーザーのキャリアサマリーを表示
     */
    public function showCareerSummary()
    {
        $user_id = Auth::id(); // ログイン中のユーザーIDを取得

        // 業種ごとの経験年数を取得
        $industrySummaries = CareerSummary::where('user_id', $user_id)
                            ->where('type', 'industry')
                            ->get();

        // 職種ごとの経験年数を取得
        $functionSummaries = CareerSummary::where('user_id', $user_id)
                            ->where('type', 'function')
                            ->get();

        // ビューにデータを渡す
        return view('mypage', compact('industrySummaries', 'functionSummaries'));
    }
    
    /**
     * 特定のユーザーのキャリアサマリーを表示
     */
    public function showUserCareerSummary($userId)
    {
        // 特定のユーザーIDに基づく情報を取得
        $industrySummaries = CareerSummary::where('user_id', $userId)
                                ->where('type', 'industry')
                                ->get();
    
        $functionSummaries = CareerSummary::where('user_id', $userId)
                                ->where('type', 'function')
                                ->get();
    
        // ビューにデータを渡す
        return view('user.mypage', compact('industrySummaries', 'functionSummaries'));
    }

}
