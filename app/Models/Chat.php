<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Room;



class Chat extends Model//Modelを継承してChatクラスを作成
{

    //チャットは１つのチャットルームに紐づく[多対一]
    public function user()
    { 
        
        return $this ->belongsTo('App\User');  //Userを返す
    }

    public function rooms()
    { 
		
        return $this ->belongsTo('App\Models\Room');  //Roomモデルを返す
	}


    //テーブル名

    protected $table = "chats";


    //チャットページ表示項目の保存
    protected $fillable =
    [
        "id",
        "room_id",
        "user_id",
        "content"
    ];

    public $timestamps = false;

    
}
