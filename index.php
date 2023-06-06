<?php
//include the functions file
include('included_functions.php');

//don't require the page to be server secured
no_SSL();

//add the header
require('header.php');

?>

<!-- Add the hompage titles -->
<div class="homepage-titles">
	<p class="home-title-font">Public Art</p>
	<p class="home-subtitle">Vancouver, BC</p>
</div>

</div> 
<!--close the div of the header-->

<br>

<?php

//show the carousel

require('showCollection.php');
?>

<!--
	carousel information gotten from: 
	http://kenwheeler.github.io/slick/ 
	https://www.youtube.com/watch?v=2gAh-Kqn6r8&ab_channel=LearnDesign
	https://cdnjs.com/libraries/jquery
-->

<!--carousel starts -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"> </script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> 
<script type= "text/javascript" src="js/carousel.js"> </script>

<!-- carousel ends-->

<br>

<!-- Add the explore button  -->
<div class="explore-btn-wrapper">
	<p class="explore-btn"><a href="showSearch.php">Explore</a></p>
</div>



</div> 
<!-- closing the div of the carousel-->


<!-- start the about section-->
<div class="home-about grid two-columns">

	<!-- 
	Add the image. Image's reference: https://unsplash.com/s/photos/vancouver-arthttps://unsplash.com/photos/zeFzrfbL8CU/download?ixid=MnwxMjA3fDB8MXxzZWFyY2h8MTd8fHZhbmNvdXZlciUyMGFydHxlbnwwfHx8fDE2NzA1NDA3Nzc&force=true 
	-->
	<img src="img/about.jpg" class="about-img">

	<div id="about-id">
		<div class="about-content">
			<!-- About title-->
			<h3>About</h3>

			<!-- About description -->
			<p>
				Public Art is a website that displays Vancouver, BC extraordinary art that is available to everyone that wants to explore, locate, and admire. The data is provided by City of Vancouver's <a href="https://opendata.vancouver.ca/pages/home/">Open Data Portal</a> including the <a href="https://opendata.vancouver.ca/explore/dataset/public-art/information/">art list</a> and <a href="https://opendata.vancouver.ca/explore/dataset/public-art-artists/information/">artist</a> databases.
			</p>
		</div>
	</div>
</div>

<!-- meet the creators section-->
<div class= "pages-wrapper">

	<!-- meet the creators title-->
	<h2>Meet the creators </h2>

	<!-- Display two columns -->
	<div class="grid two-columns creators-wrapper">

		<div class="creators">
			<!-- picture obtained from: https://www.drawkit.com/product/notion-style-avatar-creator and edited with Figma-->
			<img src="img/sooa.svg">

			<!-- Creator title-->
			<h4>Sooa Mo</h4>

			<!-- Creator description-->
			<p>
				&emsp; &emsp; Hello! I am fourth year student majoring in Interactive Arts and Technology at Simon Fraser University. I have some skills in workflow, wireframing, prototyping for UX design and web developent using HTML, CSS, JS, and PHP. I am interested in becoming a <strong> Web Developer and UX Designer</strong>. Also, I like the interactive artwork, that is why I try to develop this website :D My future plan is make interactive website to use dynamic js functions. I always enjoy learning new things!!
			</p>

		</div>
		<div class="creators">
			<!-- picture obtained from: https://www.drawkit.com/product/notion-style-avatar-creator and edited with Figma-->
			<img src="img/gaby.svg">

			<!-- Creator title-->
			<h4>Gabriela Farhat</h4>

			<!-- Creator description-->
			<p>
				&emsp; &emsp; Hi! I am a fourth year student majoring in Interactive Arts and Technology with a concentration in Interactive Systems and Design at Simon Fraser University. I am passionate about becoming a <strong>Web Developer and UX Designer</strong> because it allows me to apply my creativity, problem-solving skills, and attention to detail in a digital environment. I am able to use my skills in Java, HTML, JavaScript, PHP, CSS, Wireframing, and Prototyping. Also, i'm a tennis player and coach! I am currently part of the SFU Tennis Competitive Team. In my free time, I like to cook, watch movies, and go to the beach on a nice day.
			</p>
		</div>
	</div>
</div>

<!-- Addd the footer -->
<?php
require('footer.php');
?>
