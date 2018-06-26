<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AcceptedJob;

use Session;

//supaya bisa pake Auth
use Illuminate\Support\Facades\Auth;

class AcceptedJobController extends Controller
{
    //
	public function __construct(){
		//$this->middleware('auth');
		$this->middleware('auth');
	}
	public function index()
    {
        //
		if(Auth::user()->occupation == 'Client'){
			$acceptedJob_list = Auth::user()->acceptedJob()->paginate(5) ;
			$jumlah_AcceptedJob = $acceptedJob_list->count();
		}
		else{
			$acceptedJob_list = Auth::user()->working()->paginate(5) ;
			$jumlah_AcceptedJob = $acceptedJob_list->count();
		}
		return view('acceptedJob/index',compact('acceptedJob_list','jumlah_AcceptedJob'));
    }
	public function show(AcceptedJob $acceptedJob)
    {	
		$milestone_count = $acceptedJob->milestone()->count();
		if( $milestone_count == 0 ){
			$progress = 0;
		}
		else{
			$progress = round($acceptedJob->milestone->where('client_done','=',1)->count() * 100 / ($acceptedJob->milestone()->count()),2);
		}
		return view ('acceptedJob.show',compact('acceptedJob','progress','milestone_count'));
    }
	
	
}
