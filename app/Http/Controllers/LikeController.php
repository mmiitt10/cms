<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Request $request)
    {
        // likeable_typeとlikeable_idはフォームから送信される想定
        $type = $request->likeable_type; // 'App\Models\Book' または 'App\Models\Reply'
        $id = $request->likeable_id;
    
        $likeable = $type::findOrFail($id);
    
        $like = $likeable->likes()->where('user_id', auth()->id())->first();
    
        if ($like) {
            $like->delete();
        } else {
            $likeable->likes()->create([
                'user_id' => auth()->id(),
            ]);
        }
    
        return back();
    }

}
