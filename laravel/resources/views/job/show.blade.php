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
	<h1>Detail Job</h1>
	<table class="table table-striped">
		<tr>
			<th> Nama Job </th>
			<td> {{ $job->jobTitle }} </td>
		</tr>
		<tr>
			<th> Fee </th>
			<td> {{ $job->fee }} </td>
		</tr>
		<tr>
			<th> Client Name </th>
			<td> {{ $job->user->name }} </td>
		</tr>
		<tr>
			<th> Created at </th>
			<td> {{ $job->created_at->format('H:i:s') }} on {{ $job->created_at->format('d/m/Y') }} </td>
		</tr>
		<tr>
			<th> Last Update </th>
			<td> {{ $job->updated_at->format('H:i:s') }} on {{ $job->updated_at->format('d/m/Y') }}  </td>
		</tr>
	</table>
	@if(Auth::check() && Auth::user()->occupation == 'Lancer')
		<form  class="inlineForm" method="post" action="{!! url('job/apply/'.$job->id) !!}">
			{{ csrf_field() }}
			<button type="submit" class="btn btn-primary">
				Apply
			</button>
		</form>
	@endif
	<form class="inlineForm" method="get" action="{!! url('job') !!}">
		{{ csrf_field() }}
		<button type="submit" class="btn btn-primary">
			Back
		</button>
	</form>
</div>
	
@endsection

@section('content2')
	<p>Hellooo</p>
@endsection