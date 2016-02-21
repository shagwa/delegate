@extends('nonlogged')

@section('content')
   {!! Form::open(['url' => '/auth/login', 'class' => 'form-horizontal']) !!}
        {!! csrf_field() !!}
		<fieldset>

			<!-- Form Name -->
			<legend>Login</legend>

			@if($errors->any())
		        <div class="alert alert-danger">
		            <ul>
		                @foreach($errors->all() as $error)
		                    <li>{{ $error }}</li>
		                @endforeach
		            </ul>
		        </div>
		    @endif
		    
			<!-- Text input-->
			<div class="form-group">
				<label class="col-md-4 control-label" for="email">Email :</label>
				<div class="col-md-4">
					<input id="email" name="email" type="text"
						placeholder="Your Email" class="form-control input-md"
						value="<?php if(old('email')) { echo old('email'); } else if(isset($email)) { echo $email; } ?>" required="">

				</div>
			</div>

			<!-- Password input-->
			<div class="form-group">
				<label class="col-md-4 control-label" for="password">Password :</label>
				<div class="col-md-4">
					<input id="password" name="password" type="password"
						placeholder="Your Password" class="form-control input-md"
						required="">

				</div>
			</div>

			<!-- Button (Double) -->
			<div class="form-group">
				<label class="col-md-4 control-label" for="signup"></label>
				<div class="col-md-8">
					<button id="signup" name="signup" class="btn btn-primary">Login</button>
					<p>You don't have an account yet? <a href="<?php echo URL::to('/'); ?>/auth/register">Sign up</a>.</p>
				</div>
			</div>

		</fieldset>
	{!! Form::close() !!}
@stop