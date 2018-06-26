<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConversationDetail extends Model
{
    //
	protected $fillable = [
        'id', 
		'sequence_number', 
		'id_user',
		'message',
		'isRead',
    ];
}
