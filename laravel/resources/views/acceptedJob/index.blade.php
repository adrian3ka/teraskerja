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
	
	<h1>Work Rooms</h1>
	@if(Auth::check() && Auth::user()->occupation == 'Client')
		<a href="{{ url('job/manage') }}" class='btn btn-primary'> Manage Job </a>
	@endif
	@if($jumlah_AcceptedJob !=0)
		<ul class="list-group">
		@foreach ($acceptedJob_list as $job)
			<!--a href="{{ url('acceptedJob/' . $job->id ) }}" class="jobBox">
				<div class="jobTitle">
					{{ $job->jobTitle }}
				</div>
				<div class="fee">
					{{ $job->fee }}
				</div>
			</a-->
			<a href="{{ url('acceptedJob/' . $job->id ) }}" class="list-group-item">
				<span class="badge">{{ $job->fee }}</span>
				<h4 class="list-group-item-heading">{{ $job->jobTitle }}</h4>
				<p class="list-group-item-text">Keterangan</p>
			</a>
		@endforeach
		</ul>
		<div class="table-nav">
			<div class="jumlah-data">
				<strong>Jumlah Job : {{ $jumlah_AcceptedJob }} </strong>
			</div>
			<div class="paging">
				{{$acceptedJob_list->links()}}
			</div>
		</div>
	@else
		<div class="info-warning">
			No currently running Project!! <br>
			@if(Auth::check() && Auth::user()->occupation == 'Client')
				Go to, Manage your job
			@else
				Go to,Find your job
			@endif
		</div>
	@endif
		
	
</div>
	
@endsection

@section('content2')
	<p>Hellooo</p>
@endsection