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
	
	<h1>Notifications</h1>
	Unread Notifications
	<table border="1" width="100%">
	@foreach($unreadNotif_data as $un)
		<tr>
			<td>
			<a href=" {{ url( $un['link']) }}">
				<div class="notif-detail-page unread" href="{{ url($un['link']) }}">
				{{$un['info']}}
				</div>
			</a>
			</td>
		</tr>
	@endforeach
	</table>
	<hr>
	Read Notifications
	<table border="1" width="100%">
	@foreach($readNotif_data as $un)
		<tr>
			<td>
			<a href=" {{ url( $un['link']) }}">
				<div class="notif-detail-page read" href="{{ url($un['link']) }}">
				{{$un['info']}}
				</div>
			</a>
			</td>
		</tr>
	@endforeach
	</table>
</div>
	
@endsection

@section('content2')
	<p>Hellooo</p>
@endsection