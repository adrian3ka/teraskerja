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
	<h1>
	My Chat
	</h1>
	@if(Auth::user()->id == $dataConversation->id_user1)
		{{$dataConversation->user2->name}}
	@else
		{{$dataConversation->user1->name}}
	@endif
	<div class="row">
		<div class="col-md-5" id="conversation-list">
			Daftar Conversation
		</div>
		<div class="col-md-7" id="private-messsage">
			<div id="chat-detail">
				<div class="my-chat chat">
					<div class="username-chat">Username</div>
					<div class="message-chat">detail</div>
				</div>
				<div class="other-chat chat">
					<div class="username-chat">Username</div>
					<div class="message-chat">detail</div>
				</div>
			</div>
			<form id="message-private" class="inlineForm form-chat">
			<div class="input-group">
				<input id="conv_id" type="hidden" send="conv_id" value="{{$dataConversation->id}}">
				<input id="send_chat" type="text" class="form-control"  value="" >
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
			var conv_id = $('#conv_id').val();
			var privateMessage = $('#send_chat').val();
			$('#message-private').submit(function(){
				privateMessage = $('#send_chat').val();
				console.log(privateMessage);
				$.ajax({
					url: NOTIFICATION_SEND_PRIVATE_MESSAGE_URL,
					type: "get",
					data: { message:privateMessage, conv_id:conv_id , _token:CSRF_TOKEN},
					success:function(data){
						console.log(data);
						$('#send_chat').val('');
					},error:function(){ 
						console.log('Kirim Pesan Gagal');
					}
				}); //end of ajax
				$('#send_message').val('');
				return false;
			});
			
			
			getPrivateMessage = function (_x){
				$.ajax({
					url: NOTIFICATION_GET_PRIVATE_MESSAGE_URL,
					type: "get",
					data: { conv_id:conv_id },
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
						var chatHeight    = $('#chat-detail');
						var height = chatHeight[0].scrollHeight;
						//chatHeight.scrollTop(height);
					},error:function(){ 
						console.log('asd');
					},
					//timeout : 2000
				}); //end of ajax
			}
			
			pollPrivateMessage = setInterval(function(){
				getPrivateMessage();
			},2000);
		});
	</script>
@endsection
