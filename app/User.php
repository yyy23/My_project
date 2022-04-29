<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Profile;
use App\Models\Chat;


class User extends Authenticatable
{
    
    //ユーザは多数のチャットに紐づく[多対一]
    public function profiles()  
    { 
		
        return $this ->hasOne('App\Models\Profile'); //Profileモデルを１つ返す
	}


    public function chats()  
    { 
		
        return $this ->hasMany('App\Models\Chat'); //Chatモデルを複数返す
	}

    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
