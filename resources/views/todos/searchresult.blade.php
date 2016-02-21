@extends('app') 

@section('content')
<?php
function highlightStr($haystack, $needle) {
     // return $haystack if there is no highlight color or strings given, nothing to do.
    if (strlen($haystack) < 1 || strlen($needle) < 1) {
        return $haystack;
    }
    preg_match_all("/$needle+/i", $haystack, $matches);
    if (is_array($matches[0]) && count($matches[0]) >= 1) {
        foreach ($matches[0] as $match) {
            $haystack = str_replace($match, '<span class="highlight">'.$match.'</span>', $haystack);
        }
    }
    return $haystack;
}
?>
<div class="page-header">
	<h1 id="timeline">Search Result</h1>
</div>
<ul class="timeline">
    <?php $i = 0; ?>
	<?php foreach($news_feed as $feed) { ?>
	<?php switch($feed->progress) { 
		  case "new": ?>
	<?php $title = "Anyone can do this for me??"; $tag = "Posted"; $time = $feed->created_at; ?>
	<?php $gylo = "glyphicon-time"; $alert = "warning"; $provider = ""; ?>
	<?php break;?>
	<?php case "started": ?>
	<?php $title = "This Request Taken"; $tag = "Taken"; $time = $feed->updated_at; ?>
	<?php $gylo = "glyphicon-road"; $alert = "success"; $provider = ' <i class="glyphicon glyphicon-user"></i> Provider : <a href="'.URL::to('/').'/user/profile/'.$feed->provider->id.'">'.highlightStr($feed->provider->first_name. " " .$feed->provider->last_name, $query) .'</a>'; ?>
	<?php break;?>
	<?php case "finished": ?>
	<?php $title = "This Request Finished"; $tag = "Finished"; $time = $feed->updated_at; ?>
	<?php $gylo = "glyphicon-ok"; $alert = ""; $provider = ' <i class="glyphicon glyphicon-user"></i> Provider : <a href="'.URL::to('/').'/user/profile/'.$feed->provider->id.'">'.highlightStr($feed->provider->first_name. " " .$feed->provider->last_name, $query) .'</a>'; ?>
	<?php break;?>
	<?php case "expired": ?>
	<?php $title = "This Request Expired"; $tag = "Expired"; $time = $feed->created_at; ?>
	<?php $gylo = "glyphicon-remove"; $alert = "danger"; $provider = ""; ?>
	<?php break;?>
	<?php default: ?>
	<?php break;?>
	<?php } ?>
	<li<?php echo ($i++%2 == 0) ? '' : ' class="timeline-inverted"'; ?>>
		<div class="timeline-badge <?php echo $alert; ?>">
			<i class="glyphicon <?php echo $gylo; ?>"></i>
		</div>
		<div class="timeline-panel">
			<div class="timeline-heading">
				<h4 class="timeline-title">
				<?php echo highlightStr($feed->todo, $query); ?>
				</h4>
				<p>
					<small class="text-muted"> <i
						class="glyphicon glyphicon-time"></i> <?php echo $tag." @ ".$time; ?> <i
						class="glyphicon glyphicon-user"></i> Owner : <a href=""><?php echo highlightStr($feed->owner->first_name . " " . $feed->owner->last_name, $query) ?></a> <?php echo $provider; ?>
					</small>
				</p>
			</div>
			<div class="timeline-body">
			    <?php 
			    $first = true; $all_tags = "";
			    foreach($feed->tags as $atag) {
			        if(!$first)
			            $all_tags .= ", ";
			            
			        $all_tags .= highlightStr($atag->name, $query); 
			        $first = false;
			    }
			    ?>
				<p>Location : <?php echo highlightStr($feed->location, $query); ?></p>
				<?php if($all_tags != "") { ?><p>Tags : <?php echo $all_tags; ?></p><?php } ?>
			</div>
			<?php if($feed->progress == "new") { ?>
			<?php
			$bidders = array();
			foreach($feed->offers as $bidder) {
			    $bidders[] = $bidder->id;
			}
			?>
		          <hr>
		    <?php if(!in_array(Auth::user()->id, $bidders) && Auth::user()->id != $feed->owner->id) { ?>
        	<a href="/offer/<?php echo $feed->id; ?>" class="btn btn-primary btn-md">Offer</a>
        	<?php } ?>
        	<?php if(Auth::user()->id != $feed->owner->id) { ?>
			<a href="/inbox/<?php echo $feed->owner->id; ?>" class="btn btn-primary btn-md">Send Message</a>
        	<?php } ?>
			<?php } ?>
		</div>
	</li>
	<?php } ?>
</ul>
@stop