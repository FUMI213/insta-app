<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;

class FollowController extends Controller
{
    public function __construct(Follow $follow){
        $this->follow = $follow;
    }

    public function store($user_id){
        $this->follow->follower_id = Auth::user()->id;   //user who clicks "follow"
        $this->follow->followed_id = $user_id;   //target user (being followed)
        $this->follow->save();

        //go to previous page
        return redirect()->back();
    }

    public function delete($user_id){
        $this->follow->where('follower_id', Auth::user()->id)
                    ->where('followed_id', $user_id)
                    ->delete();
        return redirect()->back();
    }
}
