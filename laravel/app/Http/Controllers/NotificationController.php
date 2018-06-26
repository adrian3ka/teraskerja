<?php

namespace App\Http\Controllers;
use Request;

use Illuminate\Support\Facades\Auth;

use App\User;
use App\Job;
use App\AcceptedJob;
use App\Notification;

class NotificationController extends Controller
{
    //
	public function index(\Illuminate\Http\Request $request){
		if(true){
			
			$unreadNotif = Auth::user()->unreadNotifications;
			$unreadNotif_count = count($unreadNotif);
			$readNotif = Auth::user()->readNotifications;
			$readNotif_count = count($readNotif);
			$latestNotifId = '';//for polling
			$current_count = 0;
			$max_count = 10;
			$html = '' ;
			$data = array();
			
			if( $unreadNotif_count != 0)
				$latestNotifId = $unreadNotif[0]->id;
			else if ( $readNotif_count != 0)
				$latestNotifId = $readNotif[0]->id;
			if( $request->currentLatestNotifId == $latestNotifId){
				//sleep(20);
				return 'no';
			}
			for( $i = 0 ; $i < $unreadNotif_count ; $i++){
				$current_count++;
				if($current_count > $max_count){
					break;
				}
				
				if($unreadNotif[$i]->type == "App\Notifications\ApplyToJob"){
					$stringData = User::find($unreadNotif[$i]->data['id_lancer'])->name . 
								  ' Applied to ' ;
					if(Job::find($unreadNotif[$i]->data['id_job'])){
						$stringData .= Job::find($unreadNotif[$i]->data['id_job'])->jobTitle;
					}else{
						$stringData .= AcceptedJob::find($unreadNotif[$i]->data['id_job'])->jobTitle .' - already accepted';
					}
					array_push($data,array( 'string'		=> $stringData,
										    'link'			=> url('notification/read/'.$unreadNotif[$i]->id.'?redirect=job/'.$unreadNotif[$i]->data['id_job'].'/edit'),
											'created_at'	=> $unreadNotif[$i]->created_at->format('H:i:s')));
				}
			}
			
			for( $i = 0 ; $i < $readNotif_count ; $i++){
				$current_count++;
				if($current_count > $max_count){
					break;
				}
				
				if($readNotif[$i]->type == "App\Notifications\ApplyToJob"){
					$stringData = User::find($readNotif[$i]->data['id_lancer'])->name . 
								  ' Applied to ';
					if(Job::find($readNotif[$i]->data['id_job'])){
						$stringData .= Job::find($readNotif[$i]->data['id_job'])->jobTitle;
					}else{
						$stringData .= AcceptedJob::find($readNotif[$i]->data['id_job'])->jobTitle . ' - already accepted';
					}
					array_push($data,array(	 'string'	=> $stringData,
											 'link'		=> url('job/'.$readNotif[$i]->data['id_job'].'/edit'),
											 'created_at'	=> $readNotif[$i]->created_at->format('H:i:s'),
											 'read'			=> 1));
				}
			}
			$return = array('latestNotifId'		=>	$latestNotifId,
							'data'				=>  $data);
			return $return;
		}
		else{
			$unreadNotif = Auth::user()->unreadNotifications;
			$unreadNotif_count = count($unreadNotif);
			$readNotif = Auth::user()->readNotifications;
			$readNotif_count = count($readNotif);
			
			$unreadNotif_data = array();
			for( $i = 0 ; $i < $unreadNotif_count ; $i++){
				$data = array();
				if ($unreadNotif[$i]->type == "App\Notifications\ApplyToJob"){
					$lancername = User::find($unreadNotif[$i]->data['id_lancer'])->name;
					$jobname = '';
					if(Job::find($unreadNotif[$i]->data['id_job'])){
						$jobname = Job::find($unreadNotif[$i]->data['id_job'])->jobTitle;
					}else{
						$jobname = AcceptedJob::find($unreadNotif[$i]->data['id_job'])->jobTitle . ' - already accepted';
					}
					$data = 
					array('info' => $lancername.' Applied to ' . $jobname,
						  'link' => 'notification\\read\\'.$unreadNotif[$i]->id .'?redirect=job/'.$unreadNotif[$i]->data['id_job'].'/edit'
						 );
				}
				array_push($unreadNotif_data,$data);
			}
			
			$readNotif_data = array();
			for( $i = 0 ; $i < $readNotif_count ; $i++){
				$data = '';
				if ($readNotif[$i]->type == "App\Notifications\ApplyToJob"){
					$lancername = User::find($readNotif[$i]->data['id_lancer'])->name;
					$jobname = '';
					if(Job::find($readNotif[$i]->data['id_job'])){
						$jobname = Job::find($readNotif[$i]->data['id_job'])->jobTitle;
					}else{
						$jobname = AcceptedJob::find($readNotif[$i]->data['id_job'])->jobTitle . ' - already accepted';
					}
					$data = 
					array('info' => $lancername.' Applied to ' . $jobname,
						  'link' => 'job\\'.$readNotif[$i]->data['id_job'].'/edit'
						 );
				}
				array_push($readNotif_data,$data);
			}
			return view('notifications.index',compact('unreadNotif_data','readNotif_data','unreadNotif_count','readNotif_count'));
		}
	}
	public function read($id,\Illuminate\Http\Request $request){
		$notification  = Auth::user()->unreadNotifications->where('id',$id);
		$notification->markAsRead();
		return redirect($request['redirect']);
	}
}
