//================NOTIFICATION=========================
$(document).ready(function() {
	var currentLatestNotifId = '';
	$('#read').click(function(){
		readAllNotifications();
		getNotifications();
	});
	$('#notifications').click(function(){
		if($('#notifications-container').hasClass('notifications-display') == true){
			$('#notifications-container').removeClass('notifications-display');
			$('#notifications-container').addClass('notifications-hide');
			
		}else{
			$('#notifications-container').removeClass('notifications-hide');
			$('#notifications-container').addClass('notifications-display');
			$('#messages-container').removeClass('messages-display');
			$('#messages-container').addClass('messages-hide');
		}
	});
	function readAllNotifications(){
		$.ajax({
			url: NOTIFICATION_READALL_URL,
			type: "get",
			data: {_token:CSRF_TOKEN},
			success:function(data){
				console.log(data);
			},error:function(){ 
				console.log('asd');
			}
		}); //end of ajax
	}
	getNotifications = function (_x){
		$.ajax({
			url: NOTIFICATION_URL,
			type: "get",
			data: { //_token:CSRF_TOKEN, 
					currentLatestNotifId:_x },
			success:function(data){
				//console.log(data);
				if(data == 'no'){
					//console.log('hehe');
				}else{
					currentLatestNotifId = data.latestNotifId;
					var html = '' ;
					var unread_count = 0;
					for(var i = 0 ; i < data.data.length ; i++ ){
						html += '<a href=" ' + data.data[i].link + ' "> ' +
									'<div class="notifications-detail';
						if(data.data[i].read != 1){
							unread_count++;
							html+=				' unread-notifications">';
						}else{
							html+=  								 '">';
						}
						html +=				data.data[i].created_at+ '<br>' + 
										data.data[i].string +
									'</div>'+
								'</a>';
					}
					$('#notifications-menu').html(html);
					$('#notif_count').html(unread_count);
				}
				if(currentLatestNotifId == data.latestNotifId){
					//console.log('stop get data');
					//clearInterval(pollIntervalNotifications);
				}
			},error:function(){ 
				//console.log('asd');
			},
			timeout : 2000
		}); //end of ajax
	}
	
	pollIntervalNotifications = setInterval(function(){
		//console.log(currentLatestNotifId);
		getNotifications(currentLatestNotifId);
	},2000);

	//initial
	getNotifications(currentLatestNotifId);
});
//=========================END OF NOTIFICATION=========================