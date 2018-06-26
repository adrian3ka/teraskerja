<div id="navBar">
	<hr class="lineBar" >
	<a href="{{ url('user') }}" class="barButton">
		Profile
	</a>
	<hr class="lineBar" >
	<div class="barButton">
		Message
	</div>
	<hr class="lineBar" >
	<div class="barButton">
		My Lancer
	</div>
	<hr class="lineBar" >
	<div class="barButton">
		progress
	</div>
	<hr class="lineBar" >
	<div class="barButton">
		progress
	</div>
	<hr class="lineBar" >
	<a  class="barButton" href="{{ route('logout') }}"
		onclick="event.preventDefault();
				 document.getElementById('logout-form').submit();"
		>
		Logout
	</a>

	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		{{ csrf_field() }}
	</form>
	<hr class="lineBar" >
</div>
<div id="navButton">
	>>
</div>