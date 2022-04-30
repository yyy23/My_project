<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{

    //プロフィールは１ユーザに紐づく[１対１]
    public function  user()
    { 
		
        return $this ->belongsTo('App\User');  //Userを返す
	}


    //テーブル名
    protected $table = "profiles";

    //マイページ表示項目の保存
    protected $fillable =
    [
        "id",
        "user_id",
        "gender",
        "introduction",
        // "avater_url",
    
    ];


}
