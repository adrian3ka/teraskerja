<header>
<div class="topHeader">
	<div class="topHeaderLeft" >
		<img class="verySmallIcon" src="{{ asset('Image/customicon/smallPhone.png') }}">
		<div class="verySmallText">
			0877-3809-8919 
		</div>
		<img class="verySmallIcon" src="{{ asset('Image/customicon/smallMail.png') }}">
		<div class="verySmallText">
			eekkaaadrian@gmail.com
		</div>
	</div>
	<div class="topHeaderRight">
	@guest
		<a class="verySmallButton" href="{{ route('login') }}">Login</a>
		<a class="verySmallButton buttonToRegistration" href="#">Register</a>
	@else
		<div id="messages" class="messages">Message
			<span id="messages_count" class="badge">{{-- Message_count --}}</span>
		</div> 
		<div id="messages-container" class="messages-hide">
			<div id="messages-menu">
				<div class="messages-detail">
					Detail Goes Here
				</div>
			</div>
		</div>
		<div id="notifications" class="notifications">Notifications 
			<span id="notif_count" class="badge">{{-- Notif_count --}}</span>
		</div> 
		<div id="notifications-container" class="notifications-hide">
			<div id="notifications-menu">
				<div class="notifications-detail">
					Detail Goes Here
				</div>
			</div>
			<table border="1" width="100%">
				<tr>
					<td>
						<div id="read" class="mark-as-read">
							mark all as read
						</div>
					</td>
					<td>
						<a id="seeall" href="{{ url('notification') }}">
							see all notifications
						</a>
					</td>
				</tr>
			</table>
		</div>
		<a  class="usernameBox" href="{{ route('logout') }}"
			onclick="event.preventDefault();
					 document.getElementById('logout-form').submit();"
			>
			Logout 
		</a>

		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			{{ csrf_field() }}
		</form>
	@endguest
	</div>
	
</div>
<a href="{{ url('') }}">
	<img class="logo" src="{{ asset('Image/icon.png') }}">
</a>
<div class="subheader2" align="right">
	@if(Auth::check())
	<a class='icon' href="{{ url('user') }}">
		<div class='iconImage'>
		</div>
		<div class='iconDetail'>
			Profile
		</div>
	</a>
	@if(Auth::user()->occupation == 'Client')
	<a class='icon' href="{{ url('job/manage') }}">
	@else
	<a class='icon' href="{{ url('job') }}">
	@endif
		<div class='iconImage'>
		</div>
		<div class='iconDetail'>
			Job
		</div>
	</a>
	
	<a class='icon' href="{{ url('acceptedJob') }}">
		<div class='iconImage'>
		</div>
		<div class='iconDetail'>
			Working Rooms
		</div>
	</a>
	@if(Auth::user()->occupation == 'Lancer')
	<a class='icon' href="{{ url('product/manage') }}">
	@else
	<a class='icon' href="{{ url('product') }}">
	@endif
		<div class='iconImage'>
		</div>
		<div class='iconDetail'>
			@if(Auth::user()->occupation == 'Lancer')
			My Product
			@else
			Find Product
			@endif
		</div>
	</a>	
	@endif
</div>
</header>