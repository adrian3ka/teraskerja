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
		
		<h1>
			Edit Job 
			<form  class="inlineForm" method="POST"  action="{!! action('JobController@destroy',['id'=> $job->id]) !!}">
				<input name="_method" type="hidden" value="DELETE">
				{!! csrf_field() !!}
				<button type="submit" class="btn btn-warning">
					Delete
				</button>
			</form>
		</h1> 
		
		<div class="edit-job">
			<form class="form-horizontal" method="POST"  action="{!! action('JobController@update',['id'=> $job->id]) !!}">
				<input name="_method" type="hidden" value="PATCH">
				{!! csrf_field() !!}
				<div class="form-group{{ $errors->has('jobTitle') ? ' has-error' : '' }}">
					<label for="jobTitle" class="col-md-4 control-label">Job Title</label>

					<div class="col-md-6">
						<input id="jobTitle" type="text" class="form-control" name="jobTitle" value="{{ $job->jobTitle }}" required autofocus>

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
						<input id="fee" type="number" class="form-control" name="fee" value="{{ $job->fee }}" required>

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
							Update
						</button>
						
					</div>
				</div>
			</form>
			
			@if($applicantCount == 0 )
				No Applicant yet!
			@else
				<table class="table table-striped">
					<tr>
						<th>
							Lancer Name
						</th>
						<th>
							Action
						</th>
					</tr>
					@foreach($job->applicant as $app)
					<tr>
						<th>
							{{ $app->name }}
						</th>
						<th>
							<form  class="inlineForm" method="POST"  action="{{ url('job/accept/' . $app->id .'/'.$job->id) }}">
								{!! csrf_field() !!}
								<button type="submit" class="btn btn-warning">
									Accept
								</button>
							</form>
						</th>
					</tr>
					@endforeach
				</table>
			@endif
		</div>
	</div>
	
@endsection

@section('content2')
	<p>Hellooo</p>
@endsection