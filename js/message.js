//================message=========================
messageModel = Backbone.Model.extend({
	defaults:{
		name : "Namaku"
	},
	initialize:function(){
		console.log("Nama : " + this.get("name"));
	},
});
message = Backbone.View.extend({
	initialize : function(){
		this.render();
	},
	render: function(){
		var template = 	'<div class="messages-detail">' + 
							'<div class="messages-user">' +
								this.model.get("name")+
							'</div>'+
							'<div class="messages-content">'+
								'Isi'+
							'</div>'+
						'</div>';
		this.$el.append(template);
	},
	
});
$(document).ready(function() {
	console.log('oke');
	$('#messages').click(function(){
		if($('#messages-container').hasClass('messages-display') == true){
			$('#messages-container').removeClass('messages-display');
			$('#messages-container').addClass('messages-hide');
			
		}else{
			$('#messages-container').removeClass('messages-hide');
			$('#messages-container').addClass('messages-display');
			
			$('#notifications-container').removeClass('notifications-display');
			$('#notifications-container').addClass('notifications-hide');
		}
	});
	
	getMessages = function (){
		$.ajax({
			url: MESSAGES_CONVERSATION_URL,
			type: "get",
			data: {},
			success:function(data){
				console.log('data : ' + data.length);
				var messages = [];
				var messageModels = [];
				for( var i = 0 ; i < data.length ; i++){
					messageModels[i] = new messageModel({name : data[i].name});
					messages[i] = new message({el: $('#messages-menu'), model : messageModels[i]});
				}
				//console.log(data);
			},error:function(){ 
				console.log('asd');
			},
			//timeout : 2000
		}); //end of ajax
	}
	
	pollIntervalMessages = setInterval(function(){
		//console.log(currentLatestNotifId);
		getMessages();
	},2000);
});
//=========================END OF message=========================