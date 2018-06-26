<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //
	protected $fillable = [
        'id', 
		'id_user1', 
		'id_user2',
    ];
	public function user1(){
		return $this->belongsTo('App\User','id_user1');
	}
	public function user2(){
		return $this->belongsTo('App\User','id_user2');
	}
}
