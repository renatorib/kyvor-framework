<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Kyvor Framework</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	</head>
	<body>
		<header>
			<div class="logo">
				<a href="<?php echo $app->route(); ?>">

				</a>
			</div>
			<div class="wrap">
				<nav>
					<ul>
						<li><a href="<?php echo $app->route('?page=norender'); ?>">No render page</a></li>
					</ul>
					<div class="clearfix"></div>
				</nav>
			</div>
		</header>
		
		<div class="wrap flash">
			<?php echo $app->flash(); ?>
		</div>
		
		<?php echo $app->contents(); ?>
       
	</body>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>