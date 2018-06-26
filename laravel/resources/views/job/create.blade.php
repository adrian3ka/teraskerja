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
		
		<h1>Create Job</h1>
		<hr>
		<div class="create-job">
			<form class="form-horizontal" method="POST" action="{{ url('job') }}">
				{{ csrf_field() }}
				<div class="form-group{{ $errors->has('jobTitle') ? ' has-error' : '' }}">
					<label for="jobTitle" class="col-md-4 control-label">Job Title</label>

					<div class="col-md-6">
						<input id="jobTitle" type="text" class="form-control" name="jobTitle" value="{{ old('jobTitle') }}" required autofocus>

						@if ($errors->has('jobTitle'))
							<span class="help-block">
								<strong>{{ $errors->first('jobTitle') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('fee') ? ' has-error' : '' }}">
					<label for="fee" class="col-md-4 control-label">Fee</label>

					<div class="col-md-6">
						<input id="fee" type="number" class="form-control" name="fee" value="{{ old('fee') }}" required>

						@if ($errors->has('fee'))
							<span class="help-block">
								<strong>{{ $errors->first('fee') }}</strong>
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