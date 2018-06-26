<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
        <title>@yield('title')</title>
		<!--link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		
		
		<!-- Include jQuery Mobile stylesheets -->
		<!--link rel="stylesheet" href="{{ asset('JQmobile/jquery.mobile-1.4.5.css') }}"-->

		<!-- Include the jQuery Mobile library -->
		<!--script src="{{ asset('JQmobile/jquery.mobile-1.4.5.js') }}"></script-->
		
		<link href="{{ asset('bootstrap_3_3_6/css/bootstrap.min.css')}}" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/master.css') }}">
		
		<!-- Include the jQuery library -->
		<script src="{{ asset('JQuery/jquery-1.12.4.js') }}"></script>
		<script src="{{ asset('bootstrap_3_3_6/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/underscore.js') }}"></script>
		<script src="{{ asset('js/backbone.js') }}"></script>
		<script type="text/template" id="messageTemplate">
			<div class="messages-detail">
				<div class="messages-user">
				Nama
				</div>
				<div class="messages-content">
				Isi
				</div>
			</div>
		</script>
    </head>
	
	<div id="wrapper">
		<body class="normal">
			@include('navbar')
			<div class="container">
				@yield('content')
			</div>
			
		@guest
			@yield('registration')
		@else
		@endguest
			@include('footer')
		</body>
	</div>
	
	
	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
		});

		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var MESSAGES_CONVERSATION_URL = '{{ URL::asset('/message/conversationWith') }}';

		var NOTIFICATION_URL = '{{ URL::asset('/notification') }}';
		var NOTIFICATION_READALL_URL = '{{ URL::asset('/notification/readall') }}';
		var NOTIFICATION_SEND_WORKROOM_MESSAGE_URL = '{{ URL::asset('/message/send/woorkroom') }}';
		var NOTIFICATION_SEND_PRIVATE_MESSAGE_URL = '{{ URL::asset('/message/send/private') }}';
		var NOTIFICATION_GET_WORKROOM_MESSAGE_URL = '{{ URL::asset('/message/get/woorkroom') }}';
		var NOTIFICATION_GET_PRIVATE_MESSAGE_URL = '{{ URL::asset('/message/get/private') }}';
	</script>
	<script src="{{ asset('js/master.js') }}"></script>
	@guest
	@else
	<script src="{{ asset('js/notification.js') }}"></script>
	<script src="{{ asset('js/message.js') }}"></script>
	@endguest
	@yield('script')
</html>
