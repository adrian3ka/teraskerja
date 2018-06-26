@extends('layouts.master')

@section('title')
	Homey
@endsection


@section('content')
	@include('leftNavBar')
@guest
@else

@endguest
	<div class="content">
		
		<h1>Manage Job</h1>
		<div>
		<a href="{{ url('job/create') }}" class='btn btn-primary'> Create Job </a>
		<a href="{{ url('job') }}" class='btn btn-primary'> See All Job </a>
		<br>&nbsp;
		</div>
		@if($jobCount != 0)
			<ul class="list-group">
			@foreach ($job_list as $job)
				<!--a href="{{ url('job/' . $job->id . '/edit') }}" class="jobBox">
					<div class="jobTitle">
						{{ $job->jobTitle }}
					</div>
					<div class="fee">
						{{ $job->fee }}
					</div>
				</a-->
				<a href="{{ url('job/' . $job->id . '/edit' ) }}" class="list-group-item">
					<span class="badge">{{ $job->fee }}</span>
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
			<div class="info-warning">
			Anda Belum post Job Apapun
			</div>
		@endif
		
	</div>
	
@endsection

@section('content2')
	<p>Hellooo</p>
@endsection