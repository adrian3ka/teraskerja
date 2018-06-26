<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    //
	protected $fillable = [
        'id_accepted_job', 
		'id_milestone', 
		'milestone_title',
		'milestone_description',
    ];
	public function acceptedJob(){
		return $this->belongsTo('App\AcceptedJob','id_accepted_job');
	}
}
