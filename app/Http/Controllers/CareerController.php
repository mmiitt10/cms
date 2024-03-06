<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
            'career_company.*' => 'required|string|max:255',
            'career_work_from.*' => 'required|date',
            'career_work_to.*' => 'required|date',
            'career_industry.*' => 'required|string|max:255',
            'career_function.*' => 'required|string|max:255',
            'career_position.*' => 'required|string|max:255',
        ]);
    
        // バリデーションエラーを設定
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // フォームから送信されたキャリアの数だけループ
        foreach ($request->career_company as $key => $value) {
            // 新しいキャリアモデルを作成して保存
            $career = new Career();
            $career->user_id = auth()->id();
            $career->career_company = $request->career_company[$key];
            $career->career_work_from = $request->career_work_from[$key];
            $career->career_work_to = $request->career_work_to[$key];
            $career->career_industry = $request->career_industry[$key];
            $career->career_function = $request->career_function[$key];
            $career->career_position = $request->career_position[$key];
            $career->save();
        }
    
        // リダイレクトまたはレスポンスを返す
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
        return redirect('mypage')->with('success', '登録情報が更新されました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Career $career)
    {
        $career->delete();       //追加
        return redirect('mypage');  //追加
    }
}
