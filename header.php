<html>
<head>
	<title>Public Art</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/grid.css">
	
	<!-- CSS files-->
	<link rel="stylesheet" type="text/css" href="css/slick.css">
  	<link rel="stylesheet" type="text/css" href="css/slick-theme.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>


</head>
<body>
	<div class="class= home-img ">
		<header class="grid header-menu">

			<!-- Wesbite logo-->
			<a href="index.php" class= "logo">PublicArt</a>

			<!--Navigation bar -->
			<nav class="navbar">
				<a href="showSearch.php">Search Collections</a> 
				
				<!-- If the user is logged in, add a "Logout" and "Profile" links to the navigation bar. And if the user is not logged in, show the "Log in" button. -->
				<?php 
					if (isset($_SESSION['valid_user'])){
						echo "<a class=\"nav\"  href=\"profile.php\">Profile</a> ";
						echo "<a href=\"logout.php\">Log out</a>";
					}else 
						echo "<a href=\"login.php\" class=\"loginLink\">Log in</a>";
				?>
			</nav>
		</header>
		

<!--header ends here-->