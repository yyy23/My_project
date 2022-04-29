<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Chat;

class Room extends Model //Modelを継承してRoomクラスを作成
{

    // チャットルームは複数のチャットを持つ[一対多]

    public function chats()  
    { 
		
        return $this ->hasMany('App\Models\Chat'); //Chatモデルを複数返す
	}

    //テーブル名

    protected $table = "rooms";

    //ルーム表示項目の保存
    protected $fillable =
    [
        "id",
        "room_name",
        "explanation",
        "image_url",   
    ];
}
