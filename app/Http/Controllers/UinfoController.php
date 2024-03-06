<?php

namespace App\Http\Controllers;

use App\Models\Uinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UinfoController extends Controller
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
        // バリデーションチェック
        $validator=Validator::make($request->all(),[
            'profile_name'=>'required|min:1|max:255',
            'profile_age'=>'required|min:1|max:3',
            'profile_intro'=>'required',
            'profile_picture'=>'file|image|max:5000',
            // 画像ファイルの形式・サイズを指定
            ]);
        
        // バリデーションエラーを設定
        if($validator->fails()){
            return redirect('/')
                ->withInput
                ->withErrors($validator);
        }
        
        // 問題ない場合に登録処理実施
        
        $uinfo=new uinfo;
        $uinfo ->user_id = auth()->id();
        $uinfo ->profile_name =$request ->profile_name;
        $uinfo ->profile_age =$request ->profile_age;
        $uinfo ->profile_intro =$request ->profile_intro;
        
        // ファイルのみ安全に保存するために工夫
        if($request->hasFile('profile_picture')&&$request->file('profile_picture')->isValid()){
            // 安全なファイル名を生成
            $file=$request->file('profile_picture');
            
            // ランダムな値を生成
            $safeName = time() . '_' . \Str::random(10) . '.' . $file->getClientOriginalExtension();
            
            // ファイルをストレージに格納し、そのパスを取得する
            $path = $file->storeAs('profile_pictures', $safeName, 'public');
            
            // ファイルを保存
            $uinfo ->profile_picture =$path;
        }
        
        $uinfo ->save();
        return redirect('/interest/create');
        // ->route('interest.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Uinfo $uinfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Uinfo $uinfo)
    {
        return view('uinfo_edit', ['uinfo' => $uinfo]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Uinfo $uinfo)
    {
        // バリデーションチェック
        $validator = Validator::make($request->all(), [
            'profile_name' => 'required|min:1|max:255',
            'profile_age' => 'required|min:1|max:3',
            'profile_intro' => 'required',
            'profile_picture' => 'file|image|max:5000',
            // 画像ファイルの形式・サイズを指定
        ]);
    
        // バリデーションエラーを設定
        if($validator->fails()){
            return redirect('/')
                ->withInput
                ->withErrors($validator);
        }
    
        // 問題ない場合に更新処理実施
        $uinfo->profile_name = $request->profile_name;
        $uinfo->profile_age = $request->profile_age;
        $uinfo->profile_intro = $request->profile_intro;
    
        // ファイルがアップロードされた場合は処理する
        if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
            // 安全なファイル名を生成
            $file = $request->file('profile_picture');
            $safeName = time() . '_' . \Str::random(10) . '.' . $file->getClientOriginalExtension();
            
            // ファイルをストレージに格納し、そのパスを取得する
            $path = $file->storeAs('profile_pictures', $safeName, 'public');
            
            // ファイルを保存
            $uinfo->profile_picture = $path;
        }
    
        $uinfo->save();
    
        return redirect('mypage')->with('success', '登録情報が更新されました');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Uinfo $uinfo)
    {
        //
    }
}
