<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    // フォロー機能
    public function follow(User $user)
    {
        if (Auth::user()->id != $user->id) {
            Auth::user()->following()->attach($user->id);
            return back()->with('success', 'You are now following '.$user->name);
        }

        return back()->with('error', 'You cannot follow yourself');
    }

    // フォロー解除機能
    public function unfollow(User $user)
    {
        Auth::user()->following()->detach($user->id);
        return back()->with('success', 'You have unfollowed '.$user->name);
    }

    // 自分がフォローしている人を表示
    public function followings(User $user)
    {
        $following = $user->following()->get();
        return view('following', ['following' => $following]);
    }

    // 自分をフォローしている人を表示
    public function followers(User $user)
    {
        $follower = $user->followers()->get();
        return view('follower', ['follower' => $follower]);
    }
}
