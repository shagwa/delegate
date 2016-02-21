<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/assets/img/favicon.ico">

    <title>Welcome to Delegate - Login</title>

	<!-- Bootstrap core CSS -->
	{!! Html::style('assets/css/bootstrap.min.css') !!}
	
	<!-- Custom styles for this template -->
	{!! Html::style('assets/css/starter-template.css') !!}
	{!! Html::style('assets/css/pe-icon-7-stroke.css') !!}
	{!! Html::style('assets/css/ct-navbar.css') !!}
	{!! Html::style('assets/css/star-rating.css') !!}
	{!! Html::style('assets/css/public.css') !!}
	{!! Html::style('assets/css/theme-krajee-fa.css') !!}
	{!! Html::style('assets/css/theme-krajee-svg.css') !!}
	{!! Html::style('assets/css/theme-krajee-uni.css') !!}
	
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    {!! Html::style('assets/css/ie10-viewport-bug-workaround.css') !!}
    
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="{!! Html::script('assets/js/ie8-responsive-file-warning.js') !!}"></script><![endif]-->
    {!! Html::script('assets/js/ie-emulation-modes-warning.js') !!}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div id="navbar-full">
		<div id="navbar">
			<nav class="navbar navbar-ct-blue navbar-fixed-top" role="navigation">

				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse"
							data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span> <span
								class="icon-bar"></span> <span class="icon-bar"></span> <span
								class="icon-bar"></span>
						</button>
						<a class="navbar-brand navbar-brand-logo" href="/">
							<div class="logo">
								<img
									src="/assets/img/logo.png">
							</div>
							<div class="brand">Delegate</div>
							<br>
							<small>Will Do Your TODO</small>
						</a>
					</div>
				</div>
			</nav>
		</div>
		<!--  end navbar -->
	</div>
	<!-- end menu-dropdown -->
	<div class="main container">

	    @yield("content")
	
	</div>

<!-- Bootstrap core JavaScript
================================================== -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo URL::to('/'); ?>/assets/js/vendor/jquery.min.js"><\/script>')</script>
{!! Html::script('assets/js/bootstrap.min.js') !!}
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
{!! Html::script('assets/js/ie10-viewport-bug-workaround.js') !!}

</body>
</html>