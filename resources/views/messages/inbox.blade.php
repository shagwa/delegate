@extends('app') 

@section('content')
<div class="page-header">
	<h1 id="timeline">My Inbox</h1>
</div>
<div class="row " style="padding-top: 40px;">
    <div class="col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading">RECENT MESSAGES</div>
			<div class="panel-body">
				<ul class="media-list">
                	<?php foreach($messages as $message) { ?>
					<li class="media">
						<div class="media-body">
							<div class="media">
								<a class="pull-left" href="#"> 
								    <?php $avatar = ($message->sender->avatar != "" && @file_exists(URL::to('/')."/files/user/40x40/".$message->sender->avatar)) ? URL::to('/')."/files/user/40x40/".$message->sender->avatar : URL::to('/')."/files/user/40x40/avatar.png"; ?>
								    <img class="media-object img-circle " src="<?php echo $avatar; ?>" alt="Image Here" />
								</a>
								<div class="media-body">
									<?php echo $message->message; ?><br /> <small
										class="text-muted"> <?php if($message->sender->id == Auth::user()->id) { echo "Me"; } else { echo $message->sender->first_name . " " . $message->sender->last_name; } ?> @ <?php echo $message->created_at; ?></small>
									<hr />
								</div>
							</div>
						</div>
					</li>
	            <?php } ?>
	            </ul>
			</div>
			<div class="panel-footer">
			    <form class="form-horizontal" action="/send_message" method="get">
				    <div class="input-group">
						<input type="text" name="message" value="" class="form-control"
								placeholder="Enter Message"> 
						<input type="hidden" name="user_id" value="<?php echo $user_id; ?>" /> 
						<span class="input-group-btn"><button class="btn btn-info" type="submit">SEND</button></span>
				    </div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-primary">
			<div class="panel-heading">USERS</div>
			<div class="panel-body">
				<ul class="media-list">
				    <?php foreach($chat_with as $auser) { ?>
					<li class="media">
						<div class="media-body">
							<div class="media">
								<a class="pull-left" href="#"> 
								<?php $avatar = ($auser->avatar != "" && @file_exists(URL::to('/')."/files/user/40x40/".$auser->avatar)) ? URL::to('/')."/files/user/40x40/".$auser->avatar : URL::to('/')."/files/user/40x40/avatar.png"; ?>
								<img
									class="media-object img-circle" style="max-height: 40px;"
									alt="Image Here" src="<?php echo $avatar; ?>" />
								</a>
								<div class="media-body">
									<h5><a href="/inbox/<?php echo $auser->id; ?>"><?php echo $auser->first_name . " " . $auser->last_name; ?></a></h5>
								</div>
							</div>
						</div>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>
@stop