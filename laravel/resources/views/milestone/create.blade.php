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
		
		<h1>Milestone of {{ $acceptedJob->jobTitle }}</h1>
		<hr>
		<div class="create-milestone">
			<form class="form-horizontal" method="POST" action="{{ url('milestone') }}">
				{{ csrf_field() }}
				<input type="hidden" id="id_accepted_job" name="id_accepted_job" value="{{ $acceptedJob->id }}">
				<div class="form-group{{ $errors->has('milestone_title') ? ' has-error' : '' }}">
					<label for="milestone_title" class="col-md-4 control-label">Milestone Title</label>

					<div class="col-md-6">
						<input id="milestone_title" type="text" class="form-control" name="milestone_title" value="{{ old('milestone_title') }}" required autofocus>

						@if ($errors->has('milestone_title'))
							<span class="help-block">
								<strong>{{ $errors->first('milestone_title') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('milestone_description') ? ' has-error' : '' }}">
					<label for="milestone_description" class="col-md-4 control-label">Milestone Description</label>

					<div class="col-md-6">
						<textarea id="milestone_description" class="form-control" name="milestone_description" value="{{ old('milestone_description') }}" rows="5">
						</textarea>
						@if ($errors->has('milestone_description'))
							<span class="help-block">
								<strong>{{ $errors->first('milestone_description') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<button type="submit" class="btn btn-primary">
							Register
						</button>
					</div>
				</div>
			<form>
		</div>
	</div>
	
@endsection

@section('content2')
	<p>Hellooo</p>
@endsection