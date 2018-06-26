<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
	/**
	 * Indicates if the IDs are auto-incrementing.
	 *
	 * @var bool
	 */
	public $incrementing = false;
	protected $fillable = [
        'id','id_user','product_name', 'price',
    ];
	
	public function owner(){
		return $this->belongsTo('App\User','id_user');
	}
}
