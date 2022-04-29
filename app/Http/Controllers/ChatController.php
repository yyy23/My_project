<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Models\Room;
use App\Models\Chat;


class ChatController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    //チャットルームの表示

    public function show($room_id)  
    {

        $user_id = auth()->id(); //現在認証しているユーザID取得

        If(auth()->user()->id != $user_id){//ログインしているユーザidと表示するuser_idが異なる場合、'home'へリダイレクト

            return redirect()->route('home');
        }

        $room = Room::where('id', $room_id) ->first();  //roomのidとroom_idが一致するレコードの最初の結果を取得

        $chats = Room::find($room_id) ->chats() ->orderby('id' , 'asc') ->get();  //RoomからユーザIDで取得し、チャットデータをID昇順で取得

        return view('chatroom',  ['room' => $room , 'chats' =>$chats] ); 
    }




    public function store(Request $request)  //Requetのデータは$requestとして呼び出して、DBへ保存
    {

        $savedata = [  //DBへの保存内容
            "id" => $request -> id,
            "room_id" => $request -> room_id,
            "user_id" => $request -> user()->id,
            "content" => $request -> content,   

          ];
  
          $chat = new Chat;    //新規投稿
          $chat ->fill($savedata) ->save();  //内容を保存
        
        return redirect() ->route('chatroom.show' , [$savedata ['room_id'] ]);   //チャットルームへリダイレクト
    }




}









