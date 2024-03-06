<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfRegistered
{
    public function handle($request, Closure $next)
    {
        if ($request->session()->get('registered')) {
            // フラグをリセット
            $request->session()->forget('registered');
            
            // 登録後の特定のページにリダイレクト
            return redirect('/special-page');
        }

        return $next($request);
    }
}
