<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Welcome To Laravel!</title> 
 
	<link href="http://fonts.googleapis.com/css?family=Quattrocento&amp;v1" rel="stylesheet" type="text/css" media="all" />
	<link href="http://fonts.googleapis.com/css?family=Ubuntu&amp;v1" rel="stylesheet" type="text/css" media="all" />
	<link href="http://fonts.googleapis.com/css?family=Amaranth&amp;v1" rel="stylesheet" type="text/css" media="all" />

	<style type="text/css">
		body {
			background-color: #eee;
			color: #6d6d6d;
			font-family: 'Ubuntu';
			font-size: 15px;
		}

		a {
			color: #7089b3;
			font-weight: bold;
			text-decoration: none;
		}

		h1.laravel {
			font-family: 'Amaranth', Helvetica, serif;				
			font-size: 50px;
			margin: 0 0 15px -10px;
			padding: 0;
			text-shadow: -1px 1px 1px #fff;
		}

		h2 {
			font-family: 'Quattrocento', serif;
			font-size: 30px;
			margin: 30px 0 0 0;
			padding: 0;
			text-shadow: -1px 1px 1px #fff;
		}

		p {
			margin: 10px 0 0 0;
			line-height: 25px;
		}

		#header {
			margin: 0 auto;
			margin-bottom: 15px;
			margin-top: 20px;
			width: 100%;
		}

		.wrapper {	
			margin: 0 auto;
			width: 80%;
		}

		.wrapper h2:first-of-type {
			margin-top: 0;
		}
		
		.content {
			background-color: #fff;
			border-radius: 10px;
			padding: 10px;
		}

		.menu {
			padding: 0;
		}
		
		.menu li {
			background-color: #fff;
			border: 1px solid;
			border-radius: 10px 10px 0 0;
			display: inline;
			list-style-type: none;
			margin-left: 5px; 
			padding: 10px; 
		}
		
		.menu li.active {
			border-bottom: none;
		}
		
		.message {
			color:#00b;
		}
		
		.error {
			color:#e00;
		}

		input, textarea {
			display: block;
			margin: 0 0 10px 0;
		}

		.edit {
			color: #f00;
			margin-left: 10px;
			text-decoration: underline;
		}
	</style>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script>
</head> 
<body>
	<div class="wrapper">

	<div id="header">
		<h1 class="laravel">Laravel</h1>
	</div>
	
	<ul class="menu">
	<li><a href="<?php echo URL::to('/'); ?>">Home</a></li>
	<?php if (Auth::check()): ?>
	<li>Profile</li>
	<li>Manage</li>
	<li><a href="<?php echo URL::to('logout'); ?>">Logout</a></li>
	<?php else: ?>
	<li><a href="<?php echo URL::to('login'); ?>">Login</a></li>
	<?php endif; ?>
	<li><a href="<?php echo URL::to('items'); ?>">Items</a></li>
	</ul>
	
	<div class="content">
		<?php if (Session::has('error')) { 
			echo '<div class="error">'.Session::get('error').'</div>';
		} elseif (Session::has('message')) {
			echo '<div class="message">'.Session::get('message').'</div>';
		}?>
		<?php echo $content; ?>
	</div>
	
	</div>
</body> 
</html>