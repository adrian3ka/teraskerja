@extends('layouts.master')

@section('title')
	Homey
@endsection


@section('content')

@guest
@else
	@include('leftNavBar')
@endguest

<div class="content">
	<h1>Running Project</h1>
	<table class="table table-striped">
		<tr>
			<th> Nama Job </th>
			<td> {{ $acceptedJob->jobTitle }} </td>
		</tr>
		<tr>
			<th> Fee </th>
			<td> {{ $acceptedJob->fee }}</td>
		</tr>
		<tr>
			<th> Client Name </th>
			<td> {{ $acceptedJob->user->name }} </td>
		</tr>
		<tr>
			<th> Lancer Name </th>
			
			<td> 
			@foreach($acceptedJob->lancer as $app)
				{{ $app->name }} 
			@endforeach
			</td>
		</tr>
		<tr>
			<th> Created at </th>
			<td> {{ $acceptedJob->created_at->format('H:i:s') }} on {{ $acceptedJob->created_at->format('d/m/Y') }} </td>
		</tr>
		<tr>
			<th> Last Update </th>
			<td> {{ $acceptedJob->updated_at->format('H:i:s') }} on {{ $acceptedJob->updated_at->format('d/m/Y') }}  </td>
		</tr>
	</table>
	<hr>
	<h3>Milestone and Progress</h3>
	@if($milestone_count == 0)
	@else
	<div class="progress">
	  <div class="progress-bar" role="progressbar" aria-valuenow="70"
	  aria-valuemin="0" aria-valuemax="100" style="width:{{ $progress }}%">
		  {{$progress}}%
	  </div>
	</div>
	<br>
	@endif
	@if(Auth::user()->occupation == 'Client')
	
	<a href="{{ url('milestone/create/jobid/' . $acceptedJob->id) }}" class='btn btn-primary'> Add Milestone </a>
	<br><br>
	@endif
	<div id="milestone-chats" class="row">
		<div id="milestone" class="col-md-7">
			<div class="list-group">
				@foreach($acceptedJob->milestone as $ms)
				
				<div class="list-group-item {{ ($ms->client_done == 0) ? '' : 'item-done' }}">
				
					@if($ms->lancer_done == 1 && $ms->client_done == 1)
					@else
						@if($ms->lancer_done ==0)
						<a class="badge badge-remove">Remove</a>
							@if(Auth::user()->occupation == 'Lancer')
							<a class="badge badge-finish" href="{{ url('milestone/lancerFinish/' . $acceptedJob->id  . '/' .  $ms->id_milestone ) }}">Finish</a>	
							@else
							<a class="badge badge-finish" href="{{ url('milestone/clientFinish/' . $acceptedJob->id  . '/' .  $ms->id_milestone ) }}">Finish</a>
							@endif
						<a class="badge badge-edit">Edit</a>
						@else
							@if(Auth::user()->occupation == 'Lancer')
							<span class="badge badge-green">Wait For Client</span>
							@else
							<a class="badge badge-green" href="{{ url('milestone/clientFinish/' . $acceptedJob->id  . '/' .  $ms->id_milestone ) }}">Confirm</a>
							@endif
						@endif
					@endif
					<h4 class="list-group-item-heading">{{ $ms->milestone_title }}</h4>
					<p class="list-group-item-text">{{ $ms->milestone_description }}</p>
				</div>
				@endforeach
			</div>
		</div>
		<div id="chat-working-rooms" class="col-md-5">
			<div id="onlineUser" >
				Online user (10)
			</div>
			<div id="chat-detail">
				<!--div class="my-chat chat">
					<div class="username-chat">Username</div>
					<div class="message-chat">detail</div>
				</div-->
				<!--div class="other-chat chat">
					<div class="username-chat">Username</div>
					<div class="message-chat">detail</div>
				</div-->
			</div>
			<form id="message" class="inlineForm form-chat">
			<div class="input-group">
				<input id="send_message" type="text" class="form-control" name="send_message" value="" >
				<input id="workroom_id" type="hidden" send="workroom_id" value="{{$acceptedJob->id}}">
				<span class="input-group-btn">
					<button type="submit" id="send_message_button" class="btn btn-default">
						Send
					</button>
				</span>
			</div>	
			</form>
		</div>
	</div>
</div>

@endsection

@section('script')
	<script>
		var MY_NAME = '{{ Auth::user()->name }}';
		$(document).ready(function() {
			var message = $('#send_message').val();
			var workroom_id = $('#workroom_id').val();
			$('#message').submit(function(){
				
				return false;
			});
			function getWorkroomMessage(id){
				$.ajax({
					url: NOTIFICATION_GET_WORKROOM_MESSAGE_URL,
					type: "get",
					data: { id:$('#workroom_id').val() },
					success:function(data){
						console.log(data);
						var html ='';
						for(var i = 0 ; i < data.length ; i++){
							html += 	'<div class="';
									if(MY_NAME == data[i].username ) 
										html+='my-chat'; 
									else
										html+='other-chat'; 
							html +=     ' chat">' + 
										'<div class="username-chat">'+ data[i].username + ' - ' + data[i].time +'</div>'+
										'<div class="message-chat">'+ data[i].message +'</div>'+
									'</div>';
						}	
						$('#chat-detail').html(html);
						var wtf    = $('#chat-detail');
						var height = wtf[0].scrollHeight;
						//wtf.scrollTop(height);
					},error:function(){ 
						console.log('asd');
					}
				}); //end of ajax
			}
			//================WORKROOM CHAT===================
			function sendWorkroomMessage(message,id){
				message = $('#send_message').val();
				$.ajax({
					url: NOTIFICATION_SEND_WORKROOM_MESSAGE_URL,
					type: "get",
					data: { message:message, id:id , _token:CSRF_TOKEN},
					success:function(data){
						
					},error:function(){ 
						console.log('Kirim Pesan Gagal');
					}
				}); //end of ajax
			}
			$('#send_message_button').click(function (){
				sendWorkroomMessage(message,workroom_id);
				$('#send_message').val('');
				getWorkroomMessage(workroom_id);
			});
			//================END OF WORKROOM CHAT=================
			window.setInterval(function(){
				getWorkroomMessage(workroom_id);
			},2000);
			//initial
			getWorkroomMessage(workroom_id);
		});
	</script>
@endsection
