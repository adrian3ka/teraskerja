<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcceptedJob extends Model
{
    //
	protected $fillable = [
		'id',
        'jobTitle', 
		'fee', 
		'id_user',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
		
    ];
	public function user(){
		return $this->belongsTo('App\User','id_user');
	}
	public function lancer() {
		return $this->belongsToMany('App\User', 'workrooms', 'id_accepted_job', 'id_user');
	}
	
	public function milestone(){
		return $this->hasMany('App\Milestone','id_accepted_job');
	}
	
	public function message(){
		return $this->hasMany('App\WorkroomMessage','id_accepted_job');
	}
	
}
