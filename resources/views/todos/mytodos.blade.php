@extends('app') 

@section('content')
<div class="page-header">
	<h1 id="timeline">My Todos</h1>
</div>
<ul class="MyTodos">
    <?php $i = 0; ?>
	<?php foreach($mytodos as $feed) { ?>
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
								    <?php if($feed->progress == "started" || $feed->progress == "finished") { ?>
								    <tr>
										<td style="padding: 10px;">
										<?php $avatar = ($feed->provider->avatar != "" && @file_exists(URL::to('/')."/files/user/40x40/".$feed->provider->avatar)) ? URL::to('/')."/files/user/40x40/".$feed->provider->avatar : URL::to('/')."/files/user/40x40/avatar.png"; ?>
										<img
											src="<?php echo $avatar ?>" class="img-circle"
											width="40" height="40"></td>
										<td style="padding: 10px;"><a><?php echo $feed->provider->first_name. " ".$feed->provider->last_name; ?></a></td>
									</tr>
									<?php } ?>
									
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
									    <td style="padding: 15px"><label>Time:</label></td>
										<td><label name="startdate" id="startdate"><?php echo $feed->todo_time; ?></label></td>
										<td style="padding: 15px"><label><?php if($feed->is_price == 1) echo "Price : "; else echo "Benefit : "; ?></label>
										</td>
										<td>
										    <label name="Benefit" id="Benefit"><?php if($feed->is_price == 1) echo "$"; echo $feed->benefit; ?></label>
										</td>
									</tr>
								</table>
							</div>

                            <?php if($feed->progress == "new") { ?>
							<div class="panel-footer clearfix">
								<button type="button" class="btn btn-warning"
									data-toggle="modal" data-target="#ProviderList<?php echo $feed->id; ?>">Show
									Providers</button>
								<span class="toggler fa fa-chevron-down pull-right"></span>
							</div>
                            <?php } else if($feed->progress == "started") { ?>
                            <div class="panel-footer clearfix">
								<button type="button" class="btn btn-success" data-toggle="modal" data-target="#reviewpopup">Finish</button>
								<span class="toggler fa fa-chevron-down pull-right"></span>
							</div>
                            <?php } ?>
                            
                            <?php if($feed->progress == "new") { ?>
							<div id="ProviderList<?php echo $feed->id; ?>" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<nav>
										<ul>
										    <?php if(count($feed->offers) == 0) { ?>
										    <li>
												<!-- Modal content-->
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title"></h4>
													</div>
													<div class="modal-body">
														Providers List is empty!
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default"
															data-dismiss="modal">Close</button>
													</div>
												</div>
											</li>
										    <?php } else { ?>
										    
											<li>
												<!-- Modal content-->
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">Providers List</h4>
													</div>
													<div class="modal-body">
														<table style="width: 100%;">
														    <?php foreach($feed->offers as $offer) { ?>
															<tr>
																<td>
																<?php $avatar = ($offer->avatar != "" && @file_exists(URL::to('/')."/files/user/40x40/".$offer->avatar)) ? URL::to('/')."/files/user/40x40/".$offer->avatar : URL::to('/')."/files/user/40x40/avatar.png"; ?>
																<img src="<?php echo $avatar; ?>"
																	class="img-circle" width="40" height="40"> <a
																	href="/user/profile/<?php echo $offer->id; ?>"><?php echo $offer->first_name . " " . $offer->last_name; ?></a></td>
																<td style="padding: 10px">
																	<h4>
																		<a href="/accept_offer/<?php echo $feed->id."/".$offer->id; ?>" class="btn btn-success">Accept</a>
																	</h4>
																</td>
															</tr>
															<?php } ?>
														</table>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default"
															data-dismiss="modal">Close</button>
													</div>
												</div>
											</li>
											<?php } ?>
										</ul>
									</nav>
								</div>
							</div>
							<?php } ?>
							<?php if($feed->progress == "started") { ?>
                            <div id="reviewpopup" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Rate</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal"
							                    role="search" action="/review" method="get">
                                            <table style="width:100%;">
                                                <tr style="padding: 10px;">
                                                    <td style="padding=10px;">
                                                        <?php $avatar = ($feed->provider->avatar != "" && @file_exists(URL::to('/')."/files/user/40x40/".$feed->provider->avatar)) ? URL::to('/')."/files/user/40x40/".$feed->provider->avatar : URL::to('/')."/files/user/40x40/avatar.png"; ?>
                										<img
                											src="<?php echo $avatar ?>" class="img-circle"
                											width="40" height="40">
                                                    </td> 
                                                    <td>
                                                        <a href="/user/profile/<?php echo $feed->provider->id ?>"><?php echo $feed->provider->first_name . " " . $feed->provider->last_name; ?></a>    
                                                    </td>   
                                                    <td>
                                                        <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" data-size="xs">
                                                    </td> 
                                                </tr>
                                                <tr style="padding: 10px;">
                                                    <td colspan="3">
                                                        <input type="hidden" name="todo_id" value="<?php echo $feed->id; ?>" />
                                                        <input type="hidden" name="user_id" value="<?php echo $feed->provider->id; ?>" />
                                                        <textarea class="form-control custom-control" name="review" rows="3" style="resize:none"></textarea>     
                                                    </td> 
                                                </tr>
                                                <tr style="padding: 10px;">
                                                    <td>
                                                        <button type="submit" class="btn btn-success">Rate</button>
                                                    </td> 
                                                </tr>
                                            </table>  
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
					</div>
				</div>
			</div>
		</div>

	</li>
	<?php } ?>
</ul>
@stop