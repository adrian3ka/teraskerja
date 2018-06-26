<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
	protected $fillable = [
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
	public function applicant() {
		return $this->belongsToMany('App\User', 'applicants', 'id_job', 'id_user');
	}
	public function getFeeAttribute($fee){
		//return 'Rp. '.$fee.',-';
		return $fee;
	}
}
