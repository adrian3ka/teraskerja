<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
class UserController extends Controller
{
    //
	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		return view ('user.index');
	}
	
	public function edit(){
		return view ('user.edit');
	}
	public function show(User $user){
		return view ('user.show',compact('user'));
	}
	public function update(User $user,UserRequest $ur){
		echo "User >> " . $user. '<br>';
		echo "UserRequest >> " . json_encode($ur->all()). '<br>';
		$arrayRequest = array();
		$arrayRequest = $ur->all();
		if( $arrayRequest['password'] == NULL ){
			$user->update($ur->except('password'));
		}else{	
			$arrayRequest['password'] = bcrypt($ur['password']);
			$user->update($arrayRequest);
		}
		return redirect('user');
	}
}
