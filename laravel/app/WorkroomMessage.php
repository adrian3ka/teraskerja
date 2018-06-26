<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkroomMessage extends Model
{
    //
	protected $fillable = [
		'id_accepted_job' ,
		'sequence_number' , 
		'id_user' ,
		'message',
	];
}
