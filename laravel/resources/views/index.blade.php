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
		<h1>Selamat datang di Blog Kami</h1>
		<?php
			for( $i = 0 ; $i < 30 ; $i++){
				echo "<br>";
			}
		?>
	</div>
	
@endsection

@section('registration')
	<div id='registrationContainer'>
		
		<div class="banner1">
			<div class="banner1Cover">
			</div>
		</div>
		<div class="infoBanner">
			<form class="form-horizontal" method="POST" action="{{ route('register') }}">
				{{ csrf_field() }}
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="name" class="col-md-4 control-label">Name</label>

					<div class="col-md-6">
						<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

						@if ($errors->has('name'))
							<span class="help-block">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
						<div class="form-group{{ $errors->has('occupation') ? ' has-error' : '' }}">
							<label for="occupation" class="col-md-4 control-label">Occupation</label>

							<div class="col-md-6">
								<input id="occupation" type="text" class="form-control" name="occupation" value="{{ old('occupation') }}" required >

								@if ($errors->has('occupation'))
									<span class="help-block">
										<strong>{{ $errors->first('occupation') }}</strong>
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
				<!--div id="occupation">
					Please Choose Your Preference 
				</div-->
				
			<form>
		</div>
		<div class="banner2">
			<div class="banner2Cover">
			</div>
		</div>
		<div class="banner1Mobile">
			<div class="banner1Cover">
			</div>
		</div>
		<div class="banner2Mobile">
			<div class="banner2Cover">
			</div>
		</div>
	</div>
@endsection
@section('content2')
	<p>Hellooo</p>
@endsection