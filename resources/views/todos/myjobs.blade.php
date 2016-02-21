@extends('app') 

@section('content')
<div class="page-header">
	<h1 id="timeline">My Jobs</h1>
</div>
<ul class="MyTodos">
    <?php $i = 0; ?>
	<?php foreach($myjobs as $feed) { ?>
	<?php switch($feed->progress) { 
		  case "new": ?>
	<?php $title = "Anyone can do this for me??"; $tag = "Posted"; $time = $feed->created_at; ?>
	<?php $gylo = "glyphicon-time"; $alert = "warning"; $provider = ""; ?>
	<?php break;?>
	<?php case "started": ?>
	<?php $title = "This Request Taken"; $tag = "Taken"; $time = $feed->updated_at; ?>
	<?php $gylo = "glyphicon-road"; $alert = "success"; $provider = ' <i class="glyphicon glyphicon-user"></i> Provider : <a href="'.URL::to('/').'/user/profile/'.$feed->provider->id.'">'.$feed->provider->first_name. " " .$feed->provider->last_name .'</a>'; ?>
	<?php break;?>
	<?php case "finished": ?>
	<?php $title = "This Request Finished"; $tag = "Finished"; $time = $feed->updated_at; ?>
	<?php $gylo = "glyphicon-ok"; $alert = ""; $provider = ' <i class="glyphicon glyphicon-user"></i> Provider : <a href="'.URL::to('/').'/user/profile/'.$feed->provider->id.'">'.$feed->provider->first_name. " " .$feed->provider->last_name .'</a>'; ?>
	<?php break;?>
	<?php case "expired": ?>
	<?php $title = "This Request Expired"; $tag = "Expired"; $time = $feed->created_at; ?>
	<?php $gylo = "glyphicon-remove"; $alert = "danger"; $provider = ""; ?>
	<?php break;?>
	<?php default: ?>
	<?php break;?>
	<?php } ?>
	<li>
		<div class="container" style="margin-top: 30px;">
			<div class="row form-group">
				<div
					class="col-xs-12 col-md-offset-2 col-lg-offset-2 col-md-8 col-lg-8">
					<div class="panel panel-default">
						<div class="panel-heading">
						<?php $tags = ""; $first = true; foreach($feed->tags as $tag) { if(!$first) $tags .= ", "; $first = false; $tags .= $tag->name; } ?>
							<i>Tags</i> - 
							<?php if($tags == "") echo "No tags";
							else { ?>
							<input type="text"
								value="<?php echo $tags; ?>"
								data-role="tagsinput" readonly="readonly" />
							<?php } ?>
						</div>
							<div class="panel-image">
								<table>
								    <tr>
										<td style="padding: 10px;">
										<?php $avatar = ($feed->owner->avatar != "" && @file_exists(URL::to('/')."/files/user/40x40/".$feed->owner->avatar)) ? URL::to('/')."/files/user/40x40/".$feed->owner->avatar : URL::to('/')."/files/user/40x40/avatar.png"; ?>
										<img
											src="<?php echo $avatar ?>" class="img-circle"
											width="40" height="40"></td>
										<td style="padding: 10px;"><a><?php echo $feed->owner->first_name. " ".$feed->owner->last_name; ?></a></td>
									</tr>
									<tr>
										<td style="padding: 15px"><label>To do</label></td>
										<td colspan="3"><label name="todo" id="todo"><?php echo $feed->todo; ?></label></td>
									</tr>
									<tr>
										<td style="padding: 15px"><label>Location </label></td>
										<td><textarea class="form-control custom-control"
												rows="3" style="resize: none" readonly><?php echo $feed->location; ?></textarea></td>
									    <?php 
                        			    $first = true; $all_tags = "";
                        			    foreach($feed->tags as $atag) {
                        			        if(!$first)
                        			            $all_tags .= ", ";
                        			            
                        			        $all_tags .= $atag->name; 
                        			        $first = false;
                        			    }
                        			    if($all_tags == "") $all_tags = "No tags!";
                        			    ?>
                        			    <td style="padding: 15px"><label>Tags </label></td>
                        			    <td><label name="tags" id="tags"><?php echo $all_tags; ?></label></td>
									</tr>
									<tr>
									    <td style="padding: 15px"><label>Date:</label></td>
										<td><label name="startdate" id="startdate"><?php echo $feed->todo_time; ?></label></td>
										<td style="padding: 15px"><label><?php if($feed->is_price == 1) echo "Price : "; else echo "Benefit : "; ?></label>
										</td>
										<td>
										    <label name="Benefit" id="Benefit"><?php if($feed->is_price == 1) echo "$"; echo $feed->benefit; ?></label>
										</td>
									</tr>
								</table>
							</div>

					</div>
				</div>
			</div>
		</div>

	</li>
	<?php } ?>
</ul>
@stop