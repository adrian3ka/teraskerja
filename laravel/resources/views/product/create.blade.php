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
		
		<h1>Upload Product</h1>
		<div class="create-product">
			<form class="form-horizontal" method="POST" action="{{ url('product') }}">
				{{ csrf_field() }}
				<div class="form-group{{ $errors->has('product_name') ? ' has-error' : '' }}">
					<label for="product_name" class="col-md-4 control-label">Product Name</label>

					<div class="col-md-6">
						<input id="product_name" type="text" class="form-control" name="product_name" value="{{ old('product_name') }}" required autofocus>

						@if ($errors->has('product_name'))
							<span class="help-block">
								<strong>{{ $errors->first('product_name') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
					<label for="price" class="col-md-4 control-label">Price</label>

					<div class="col-md-6">
						<input id="price" type="number" class="form-control" name="price" value="{{ old('price') }}" required>

						@if ($errors->has('price'))
							<span class="help-block">
								<strong>{{ $errors->first('price') }}</strong>
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