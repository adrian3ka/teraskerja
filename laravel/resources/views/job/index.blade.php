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
	
	<h1>Job</h1>
	
	@if(Auth::check() && Auth::user()->occupation == 'Client')
		<a href="{{ url('job/manage') }}" class='btn btn-primary'> Manage Job </a>
		<br><br>
	@endif
	@include('job.form_pencarian')
	@if($jobCount !=0)
		<ul class="list-group">
		@foreach ($job_list as $job)
			<a href="{{ url('job/' . $job->id ) }}" class="list-group-item">
				<span class="badge">Rp. {{ $job->fee }},-</span>
				<h4 class="list-group-item-heading">{{ $job->jobTitle }}</h4>
				<p class="list-group-item-text">Keterangan</p>
			</a>
		@endforeach
		</ul>
		<div class="table-nav">
			<div class="jumlah-data">
				<strong>Jumlah Job : {{ $jobCount }} </strong>
			</div>
			<div class="paging">
				{{$job_list->links()}}
			</div>
		</div>
	@else
		Belum ada job saat ini!!
	@endif
		
	
</div>
	
@endsection

@section('content2')
	<p>Hellooo</p>
@endsection