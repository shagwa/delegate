@extends('nonlogged')

@section('content')
    <div class="starter-template">
		<h1>Welcome to Delegate</h1>
		<p class="lead">Delegate will help you to get your TODO list done!</p>
	</div>
   
    {!! Form::open(['url' => '/auth/register', 'class' => 'form-horizontal']) !!}
        {!! csrf_field() !!}
        <fieldset>

			<!-- Form Name -->
			<legend>Sign Up Form</legend>

			 @if($errors->any())
			        <div class="alert alert-danger">
			            <ul>
			                @foreach($errors->all() as $error)
			                    <li>{{ $error }}</li>
			                @endforeach
			            </ul>
			        </div>
			@endif
    
            <div class="form-group">
				<label class="col-md-4 control-label" for="first_name">First name :</label>
				<div class="col-md-4">
					<input id="first_name" name="first_name" type="text"
						placeholder="Your first name" class="form-control input-md"
						value="<?php if(old('first_name')) { echo old('first_name'); } else if(isset($first_name)) { echo $first_name; } ?>" required="">

				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-4 control-label" for="last_name">Last name :</label>
				<div class="col-md-4">
					<input id="last_name" name="last_name" type="text"
						placeholder="Your last name" class="form-control input-md"
						value="<?php if(old('last_name')) { echo old('last_name'); } else if(isset($last_name)) { echo $last_name; } ?>" required="">

				</div>
			</div>
			
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

			<!-- Password input-->
			<div class="form-group">
				<label class="col-md-4 control-label" for="confirmpassword">Confirm Password :</label>
				<div class="col-md-4">
					<input id="password_confirmation" name="password_confirmation" type="password"
						placeholder="Confirm Password" class="form-control input-md"
						required="">

				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-4 control-label" for="gender">Gender :</label>
				<div class="col-md-4">
					<select class="form-control" id="gender" name="gender">
						<option value="m">Male</option>
						<option value="f">Female</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label" for="dob">Birth date :</label>
				<div class="col-md-4"> 
					<input id="dob" name="dob" type="date"
						placeholder="Birth date" class="form-control input-md" required=""
						value="<?php if(old('dob')) { echo old('dob'); } else if(isset($dob)) { echo $dob; } ?>">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-4 control-label" for="contacts">Contacts :</label>
				<div class="col-md-4">
					<textarea class="form-control custom-control" id="contacts" name="contacts" rows="3"
						style="resize: none"></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label" for="location">Location :</label>
				<div class="col-md-4">
					<textarea class="form-control custom-control" id="location" name="location" rows="3"
						style="resize: none"></textarea>
				</div>
			</div>

			<!-- Button (Double) -->
			<div class="form-group">
				<label class="col-md-4 control-label" for="signup"></label>
				<div class="col-md-8">
					<button id="signup" name="signup" class="btn btn-primary">Sign Up</button>
					<p>You have an account? <a href="<?php echo URL::to('/'); ?>/auth/login">Sign in</a>.</p>
				</div>
			</div>

		</fieldset>
    {!! Form::close() !!}
@stop