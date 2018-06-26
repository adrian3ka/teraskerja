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
			<th> Nama </th>
			<td> {{ $user->name}} </td>
		</tr>
		<tr>
			<th> Email </th>
			<td> {{ $user->email}}</td>
		</tr>
		<tr>
			<th> Occupation </th>
			<td> {{ $user->occupation}} </td>
		</tr>
		
	</table>
</div>
	
@endsection

@section('content2')
	<p>Hellooo</p>
@endsection