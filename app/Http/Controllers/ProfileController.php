<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Models\Profile;

class ProfileController extends Controller
{
    //コントローラーの全アクションに対して承認を要求

    public function __construct()
    {
        $this->middleware('auth');
    }
    


    //マイページ表示

    public function show($user_id)
    {

        $user = Auth::user();  //Userモデルから$user_idを見つける
        
        //ログインしているユーザidと表示する$user_idが異なる場合、'/home'へリダイレクト
        If(auth()->user()->id != $user_id){
        
            return redirect('home');
        }
        
        $profile = Profile::where('user_id',$user_id)->first();  //profoleからuser_idが一致するデータ取得
        
        
        return view('mypage' , ['profile' => $profile] );  //mypageを表示
    }


    //プロフィール編集
    public function edit($user_id)  
    {

        $profile = Profile::find($user_id);   //profoleからuser_idが一致するデータ取得

        //ログインしているユーザidと表示する$user_idが異なる場合、'home'へリダイレクト
        If(auth()->user()->id != $user_id){

            return redirect()->route('home');
        }
      

        return view('editprofile' , ['profile' => $profile] );

    }


    
    //プロフィール更新

    public function update(Request $request, $user_id)
    {
       
        //  バリデーション設定
        // dd(gettype($request->introduction));

        $request ->validate (
        [
            'gender'       => 'required|string',  //入力必須
            'introduction' => 'required',    //入力必須
            'avater_url'   =>  'file|image|mimes:jpeg,jpg,png',
         ],
        
        [  // 日本語化
            'gender.required'         => "性別は必須です",  
            'introduction.required'   => '自己紹介は必須です'        
            
        ]);
        

        $profile = Profile::find($user_id); //profoleからuser_idが一致するデータ取得

        //ログインしているユーザidと表示する$user_idが異なる場合、'home'へリダイレクト
        If(auth()->user()->id != $user_id){

            return redirect()->route('home');
        }


        //画像ファイルのパスをstrage\app\public\imgに保存
        $avater_url = $request ->avater_url ->store('img', 'public');

      
            
            $profile ->user_id      = $request ->user()->id;
            $profile ->gender       = $request ->gender;
            $profile ->introduction = $request ->introduction;
            $profile ->avater_url   = str_replace('public/', 'storage/', $avater_url);   
            $profile ->save();



        return redirect() ->route('profile.edit' ,  ['user_id' => $user_id] )->withInput(); //編集ページへリダイレクト

    }

}
