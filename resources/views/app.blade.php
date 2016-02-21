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
	{!! Html::style('assets/css/bootstrap-tagsinput.css') !!}

	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    {!! Html::style('assets/css/ie10-viewport-bug-workaround.css') !!}
    
    <!-- Custom styles for this template -->
    {!! Html::style('assets/css/starter-template.css') !!}
    
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
			<!--    
        navbar-default can be changed with navbar-ct-blue navbar-ct-azzure navbar-ct-red navbar-ct-green navbar-ct-orange  
        -->
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
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse"
						id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="javascript:void(0);" data-toggle="search"
								class="hidden-xs"> <i class="pe-7s-search"></i>
									<p>Search</p>
							</a>
                            </li>
							<li><a href="/inbox"> <i class="pe-7s-mail">
								</i>
									<p>Messages</p>
							    </a>
                            </li>
							
							<li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="pe-7s-wallet"></i>
								    <p>TO DO</p>
							     </a>
								<ul class="dropdown-menu">
									<li><a href="/todos">My Todos</a></li>
									<li><a href="/jobs">My Jobs</a></li>
									<li><a href="/todos/add">Add Todo</a></li>
								</ul></li>
							<li class="dropdown"><a href="#" class="dropdown-toggle"
								data-toggle="dropdown"> <i class="pe-7s-user"></i>
									<p>Account</p>
							</a>
								<ul class="dropdown-menu">
									<li><a href="/user/profile">Profile</a></li>
									<li class="divider"></li>
									<li><a href="/auth/logout">Logout</a></li>
								</ul></li>
						</ul>
						<form class="navbar-form navbar-right navbar-search-form"
							role="search" action="/search" method="get">
							<div class="form-group">
								<input type="text" name="search_word" value="" class="form-control"
									placeholder="Search...">
							</div>
						</form>

					</div>
					<!-- /.navbar-collapse -->
				</div>
				<!-- /.container-fluid -->
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
{!! Html::script('assets/js/jquery-1.10.2.js') !!}
{!! Html::script('assets/js/ct-navbar.js') !!}
{!! Html::script('assets/js/star-rating.js') !!}
{!! Html::script('assets/js/public-java-script.js') !!}
{!! Html::script('assets/js/bootstrap-tagsinput.min.js') !!}
{!! Html::script('assets/js/bootstrap-tagsinput/bootstrap-tagsinput-angular.min.js') !!}

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
{!! Html::script('assets/js/ie10-viewport-bug-workaround.js') !!}

</body>
</html>