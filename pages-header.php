<html>
    <head>
        <title>Public Art</title>
            <!-- main css files -->
            <link rel="stylesheet" href="css/main.css">
            <link rel="stylesheet" href="css/grid.css">

         
	        <!-- 
                carousel information below and the files gotten from: http://kenwheeler.github.io/slick/ and https://www.youtube.com/watch?v=2gAh-Kqn6r8&ab_channel=LearnDesign 
            -->


            <!-- For the carousel. Slick css. Javascript library-->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

            <!-- For the carousel. Slick css. Javascript library-->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <header class="pages-header grid header-menu">
            <!-- Display the website's logo-->
            <a href="index.php" class= "logo">PublicArt</a>
            
            <!-- Navigation bar-->
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

        <div class="pages-wrapper"> 

