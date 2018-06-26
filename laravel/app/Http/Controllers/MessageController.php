<?php

namespace App\Http\Controllers;

use Request;

use Illminate\Auth\Facades;

use Illuminate\Support\Facades\Auth;

use App\WorkroomMessage;

use Illuminate\Support\Facades\DB;

use App\User;

use App\Conversation;

use App\ConversationDetail;

use Uuid;

class MessageController extends Controller
{
    //
	public function sendWorkroomMessage(\Illuminate\Http\Request $request){
		$lastWM = WorkroomMessage::all()->where('id_accepted_job',$request->id)->last();
		
		if($lastWM == ''){
			$lastSeqNum = 1;
		}else{
			$lastSeqNum = $lastWM['sequence_number'] + 1;
		}
		echo $lastSeqNum ;
		$data  = array(	'id_accepted_job' => $request->id ,
						'sequence_number' => $lastSeqNum, 
						'id_user' => Auth::user()->id,
						'message' => $request->message );
		echo json_encode($data);
		WorkroomMessage::create($data);
		return;
	}
	public function sendPrivateMessage(\Illuminate\Http\Request $request){
		$lastPM = ConversationDetail::all()->where('id',$request->conv_id)->last();
		$currSeqNum = 0;
		if($lastPM == ''){
			$currSeqNum = 1;
		}else{
			$currSeqNum = $lastPM['sequence_number'] + 1;
		}
		$data  = array(	'id' => $request->conv_id ,
						'sequence_number' => $currSeqNum, 
						'id_user' => Auth::user()->id,
						'message' => $request->message );
		ConversationDetail::create($data);
		return $request->all();
	}
	public function getWorkroomMessage(\Illuminate\Http\Request $request){
		if(Request::ajax()){
			$LIMIT = 40 ;
			$data = DB::table('workroom_messages')->
					where('id_accepted_job',$request->id)->
					limit($LIMIT)->
					orderBy('created_at','dsc');
			
			$all_message_count = (int)$data->get()->count();
			
			if ($LIMIT >= $all_message_count){
				$LIMIT = $all_message_count;
			}
			
			$messages = $data->get();
			
			$return = array();
			for( $i = $LIMIT - 1 ; $i >= 0 ; $i--){
				$LIMIT = 40 ;
				array_push($return,array( 
					'username'	=> User::find($messages[$i]->id_user)->name,
					'time'		=> $messages[$i]->created_at,
					'message'	=> $messages[$i]->message,
				));
			}
			return $return;
		}
	}
	public function getPrivateMessage(\Illuminate\Http\Request $request){
		$LIMIT = 40 ;
		//$PM = ConversationDetail::all()->where('id',$request->conv_id)->limit($LIMIT);
		$PM = DB::table('conversation_details')->
					where('id',$request->conv_id)->
					limit($LIMIT)->
					orderBy('created_at','dsc');
		$all_message_count = (int)$PM->get()->count();
			
			if ($LIMIT >= $all_message_count){
				$LIMIT = $all_message_count;
			}
			
			$messages = $PM->get();
			
			$return = array();
			for( $i = $LIMIT - 1 ; $i >= 0 ; $i--){
				$LIMIT = 40 ;
				array_push($return,array( 
					'username'	=> User::find($messages[$i]->id_user)->name,
					'time'		=> $messages[$i]->created_at,
					'message'	=> $messages[$i]->message,
				));
			}
		
		return $return;
	}
	public function checkWithOtherUser($id){
		$dataConversation = Conversation::where('id_user1','=',Auth::user()->id,'and','id_user2','=',$id)->
							  orWhere('id_user2','=',Auth::user()->id,'and','id_user1','=',$id)->
							  first();
		if ($dataConversation == ''){
			$idConv = Uuid::generate(4);
			$conv = array(
							'id'		=> $idConv,
							'id_user1'	=> Auth::user()->id,
							'id_user2'	=> $id
						 );
			Conversation::create($conv);
			$dataConversation = Conversation::find($idConv);
		}
		echo Auth::user()->allConversation;
		return view('message.private',compact('dataConversation'));
	}
	public function conversationWith(){
		$myId = Auth::user()->id;
		$data = array();
		$rawDataUser = json_decode(Auth::user()->allConversation);
		
		for ($i = 0 ; $i < sizeof($rawDataUser) ; $i++){
			if ($rawDataUser[$i]->id_user1 != $myId ){
				$dataId = $rawDataUser[$i]->id_user1;
			}else{
				$dataId = $rawDataUser[$i]->id_user2;
			}
			
			$name = User::find($dataId)->name;
			
			array_push($data,array( 
								'name' => $name
			));
		}
		
		return $data;
		
	}
}
