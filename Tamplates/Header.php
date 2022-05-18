
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CoolPizza</title>
	<link rel="stylesheet"  href="Tamplates/style.css">
</head>
<body>

<!-- start of the navigationBar here -->
<header>
		<div class="container">
			<nav>
				<div class="logo">
					<a href="index.php"><h1>cool pizza</h1></a>
				</div>
			<?php if (isset($_SESSION['customer_id'])):?>
				<div class="LOGIN">
					<a href="login.php">LOG-OUT</a>
				</div>
			<?php else: ?>
				<div class="LOGIN">
					<a href="login.php">LOG-IN</a>
				</div>
			<?php endif; ?>
				 
				 <?php if (isset($_SESSION['customer_id'])):?>
				<div class="Add-Pizza">
					<a href="add.php">add a pizza</a>
				</div>
				<?php endif; ?>
			</nav>
		</div>	
</header>
<!--  End of the navigationBar here -->