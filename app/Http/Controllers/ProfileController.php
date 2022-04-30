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

        $user_id = Auth::id();  //ログインしているユーザID取得
        
        //ログインしているユーザidと表示する$user_idが異なる場合、'/home'へリダイレクト
        If(auth()->user()->id != $user_id){
        
            return redirect('home');
        }
        
        $profile = Profile::where('user_id',$user_id)->first();  //profoleからuser_idが一致する最初のデータ取得
        // dd($profile);
        
        return view('mypage' , ['profile' => $profile] );  //mypageを表示
    }


    //プロフィール編集
    public function edit($user_id)  
    {

        $profile = Profile::where('user_id',$user_id)->first();
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
        // dd($request);

        $this->validate ($request,
        [
            'gender'       => 'required|string',  //入力必須
            'introduction' => 'required',    //入力必須
            // 'avater_url'   =>  'mimes:jpeg,jpg,png',
         ],
        
        [  // 日本語化
            'gender.required'         => "性別は必須です",  
            'introduction.required'   => '自己紹介は必須です',        
        //     'avater_url.mimes'         =>'指定された拡張子(jpeg,jpg,png)ではありません', 
        ]);
                
        $user_id = Auth::id();  //ログインしているユーザID取得

        //ログインしているユーザidと表示する$user_idが異なる場合、'home'へリダイレクト
        If(auth()->user()->id != $user_id){

            return redirect()->route('home');
        }
      
        $profile = Profile::where('user_id',$user_id)->first();//profoleからuser_idが一致する最初のデータ取得
        

        //画像ファイルのパスをstrage\app\publicに保存
        // $avater_url = $request ->avater_url ->store('img', 'public');


            if($profile !== null) { // $profileがnullでないとき、更新
                $profile ->user_id      = $user_id;
                $profile ->gender       = $request ->gender;
                $profile ->introduction = $request ->introduction;
                // $profile ->avater_url   = str_replace('public/', 'storage/', $avater_url);   
                $profile ->save();

            }else { //nullなら新規作成

                Profile::create([

                    'user_id' => $user_id,
                    'gender'  => $request ->gender,
                    'introduction' => $request ->introduction
                ]);
            }
                // dd($profile);
        return redirect() ->route('mypage.show' ,  ['user_id' => $user_id] )->withInput(); //マイページへリダイレクト

    }

}