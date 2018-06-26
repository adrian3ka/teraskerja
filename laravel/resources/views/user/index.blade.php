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
	<h1>User</h1>
	<table class="table table-striped">
		<tr>
			<th> Id </th>
			<td> {{Auth::user()->id}} </td>
		</tr>
		<tr>
			<th> Nama </th>
			<td> {{Auth::user()->name}} </td>
		</tr>
		<tr>
			<th> Email </th>
			<td> {{Auth::user()->email}}</td>
		</tr>
		<tr>
			<th> Occupation </th>
			<td> {{Auth::user()->occupation}} </td>
		</tr>
		
	</table>
	<a href="{{ url('user/' . Auth::user()->id . '/edit') }}" class='btn btn-primary form-control'>Edit Profile</a>
</div>
	
@endsection

@section('content2')
	<p>Hellooo</p>
@endsection