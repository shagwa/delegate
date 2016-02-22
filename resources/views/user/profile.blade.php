@extends('app') 

@section('content')
<div class="page-header">
	<h1 id="timeline"><?php if(Auth::user()->id == $user->id) echo "My"; else echo $user->first_name."'s"; ?> Profile</h1>
</div>
<div class="row">
	<div class="col-sm-3">
		<ul class="list-group">
			<li class="list-group-item no-padding">
				<?php $avatar = ($user->avatar != "" && @file_exists(URL::to('/')."/files/user/260x260/".$user->avatar)) ? URL::to('/')."/files/user/260x260/".$user->avatar : URL::to('/')."/files/user/260x260/avatar.png"; ?>
				<img class="full-width" src="<?php echo $avatar ?>">
			</li>
		</ul>
	</div>
	<div class="col-sm-8">
		<ul class="list-group">
			<li class="list-group-item">
				<label>About</label><br> 
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				<span style="padding-left: 20px;">Name : <h7>{!! $user->first_name . " " . $user->last_name; !!}</h7></span><br>
				<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
				<span style="padding-left: 20px;">Gender : <h7><?php if($user->gender == "f") echo "Female"; else if($user->gender == "m") echo "Male"; else echo "Not set"; ?></h7></span><br> 
				<span class="glyphicon glyphicon-home" aria-hidden="true"></span>
				<span
				style="padding-left: 20px;">Location :</span><h7>{!! $user->location; !!}</h7><br> <span class="glyphicon glyphicon-time"
				aria-hidden="true"></span>
				<span style="padding-left: 20px;">BirthDate : <h7>{!! $user->dob; !!}</h7>
			</span></li>
		</ul>

		<ul class="list-group">
			<li class="list-group-item"><label>Reviews</label><br> <br>
				<?php if(count($reviews) == 0) { ?>
				<div class="update">
					<div class="update-header">
						There are no Reviews
					</div>
					</div>
				<?php } ?>
				<?php foreach($reviews as $review) { ?>
				<div class="update">
					<div class="update-header">
						<table>
							<tr>
								<td style="padding: 10px;">
								<?php $avatar = ($review->reviewer->avatar != "" && @file_exists(URL::to('/')."/files/user/40x40/".$review->reviewer->avatar)) ? URL::to('/')."/files/user/40x40/".$review->reviewer->avatar : URL::to('/')."/files/user/40x40/avatar.png"; ?>
									<img src="<?php echo $avatar ?>" class="img-circle" width="40" height="40">
								</td>
								<td style="padding: 10px;"><label><?php echo $review->reviewer->first_name . " " . $review->reviewer->last_name; ?></label></td>
								<td style="padding: 10px;">
									<input id="input-review-<?php echo $review->id; ?>-xs"
										class="rating rating-loading" value="<?php echo $review->rate; ?>" data-min="0"
										data-max="5" data-step="0.5" data-size="xs"
										data-show-clear="false" data-show-caption="false"
										data-disabled="true">
								</td>
							</tr>
						</table>
					</div>
					<div class="update-body">
						<p><?php echo $review->review; ?></p>
					</div>
				</div>
				<?php } ?>
			</li>
		</ul>
	</div>
</div>
@stop
