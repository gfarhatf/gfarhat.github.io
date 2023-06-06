<?php
    //include the functions
    include_once('included_functions.php');

    //require the page to be secured
    no_SSL();

    //if the user is not logged in, redirect to the login page
    if(!isset($_SESSION['valid_user'])) {
        $_SESSION['callback_url'] = 'profile.php';
        redirect_to('login.php');
    } 

    //require the email from the logged in user
    $email = $_SESSION['valid_user'];

    if (isset($_SESSION['callback_url']) && $_SESSION['callback_url'] == 'profile.php') {
        unset($_SESSION['callback_url']);
    }

    
    $query_p = "SELECT `username`,`first_name`,`last_name`,`email`,`Type` ";
    $query_p .= " FROM users";
    $query_p .= " WHERE email='$email'";
    $result = $db->query($query_p);

    include_once('pages-header.php');

    if (isset($message)) echo "<p>$message</p>";

?>

<div class="profile-wrapper">


    <?php

        if($row = $result->fetch_assoc()) {
            echo "<h2>Welcome!  ". $row["username"] . "</h2>\n";
            echo "<div>\n";
            echo "<h3>" . $row["first_name"]. " " . $row["last_name"] . "</h3>";
            echo "<p>Email: " . $row["email"] . "</p>";
            echo "<p>Favorite Type: " . $row["Type"]. "</p>";
            echo "</div>\n";
        };

        require_once __DIR__ . '/db.php';
    ?>


    <div class="image-gallery">
        <?php require_once __DIR__ . '/showprofileimg.php'; ?>
    </div> 


    <?php

        echo "<div class=\"grid two-columns profile-buttons\">";
            echo "<div>";
            echo "<a class=\"action\" href=\"editprofileImg.php\">Edit Profile image</a>";
            echo "</div>";

            echo "<div>";
            echo "<a class=\"action\" href=\"editprofile.php\">Edit Profile</a>";
            echo "</div>";

        echo "</div>";

        echo "<div class=\"grid two-columns profile-buttons\">";
            echo "<div>";
            echo "<a class=\"action\" href=\"favoriteList.php\">My favorite list</a>";
            echo "</div>";
        echo "</div>";

        $result->free_result();
        
    ?>
    
</div>
</div>

<?php
//add the footer
include_once('footer.php');

//close the database
$db->close();
?>
