<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Uuid;
class User extends Authenticatable
{
    use Notifiable;
	
	/**
	 * Indicates if the IDs are auto-incrementing.
	 *
	 * @var bool
	 */
	public $incrementing = false;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	
    protected $fillable = [
        'id','name', 'email', 'password','occupation',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            try {
                $model->id = Uuid::generate(4);
            } catch (UnsatisfiedDependencyException $e) {
                abort(500, $e->getMessage());
            }
        });
    }
	
	//jika client
	public function job(){
		return $this->hasMany('App\Job','id_user');
	}
	//jika lancer
	public function product(){
		return $this->hasMany('App\Product','id_user');
	}
	public function acceptedJob(){
		return $this->hasMany('App\AcceptedJob','id_user');
	}
	
	public function applying() {
		return $this->belongsToMany('App\Job', 'applicants', 'id_user', 'id_job')->withTimeStamps();
	}
	public function working() {
		return $this->belongsToMany('App\AcceptedJob', 'workrooms', 'id_user', 'id_accepted_job')->withTimeStamps();
	}
	public function allConversation(){
		return $this->hasMany('App\Conversation','id_user1')->union($this->hasMany('App\Conversation','id_user2'));
	}
}
