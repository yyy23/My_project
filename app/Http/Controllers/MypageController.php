<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Auth;


class MypageController extends Controller
{

    //コントローラーの全アクションに対して承認を要求

    public function __construct()
    {
        $this->middleware('auth');
    }
    

    //$user_idを取得してマイページ表示

    public function show($user_id)
    {
        //ログインしているユーザidと表示する$user_idが異なる場合、'/home'へリダイレクト
        If(Auth::user()->id != $user_id){

            return redirect('/home');
        }

        $user = User::find($user_id);

        return view('mypage')->with('user' , Auth::user() );
    }


    
}
