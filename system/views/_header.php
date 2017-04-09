<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="GC Soluções em Gestão e Tecnologia">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
        <title>Flexi - Credit Report App</title>
		
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/tether.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/ie10-viewport-bug-workaround.js"></script>

		<script src="js/main.js"></script>
	</head>
	<body>
    	<!-- Fixed navbar -->
		<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand" href="#">Flexi - Credit Report App</a>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="parse.php">Parse Files</a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="container-fluid">
			<?php if (isset($title)): ?>
			<h1><?= htmlspecialchars($title) ?></h1>
			<?php endif ?>