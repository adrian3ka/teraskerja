<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\AcceptedJob;

use App\Milestone;

use Illuminate\Support\Facades\Auth;

class MilestoneController extends Controller
{
    //
	public function create($id){
		$acceptedJob = AcceptedJob::find($id);
		
		return view('milestone.create',compact('acceptedJob'));
	}
	public function store(Request $request){
		$lastMilestoneId = DB::table('milestones')
												  ->where('id_accepted_job','=',$request->id_accepted_job)
												  ->orderBy('id_milestone','desc')
												  ->first();
		
		$data = $lastMilestoneId;
		
		if( $lastMilestoneId == '' ){
			$currentMilestoneId = 1;
		}
		else{
			$currentMilestoneId = $data->id_milestone + 1;
		}
		echo $currentMilestoneId;
		$tempArray = array('id_accepted_job' => $request->id_accepted_job ,
						   'id_milestone' => $currentMilestoneId, 
						   'milestone_title' => $request->milestone_title,
						   'milestone_description' => $request->milestone_description);
		Milestone::create($tempArray);
		
		return redirect('acceptedJob/'.$request->id_accepted_job);
	}
	
	public function clientFinish($id,$id2){
		$milestone = Milestone::where('id_accepted_job',$id)->where('id_milestone',$id2);
		$milestone->update(['client_done' => 1, 'lancer_done' => 1]);
		
		return redirect ('acceptedJob/'.$id);
	}
	public function lancerFinish($id,$id2){
		$milestone = Milestone::where('id_accepted_job',$id)->where('id_milestone',$id2);
		$milestone->update(['lancer_done' => 1]);
		
		return redirect ('acceptedJob/'.$id);
	}
}
