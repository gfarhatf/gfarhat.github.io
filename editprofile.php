
<?php
include('included_functions.php');
no_SSL();
//only login user can see this page.
if(!isset($_SESSION['valid_user'])) {
	$_SESSION['callback_url'] = 'profile.php';
	redirect_to('login.php');
} 

$email = $_SESSION['valid_user'];
if (isset($_SESSION['callback_url']) && $_SESSION['callback_url'] == 'profile.php') {
	unset($_SESSION['callback_url']);
}

//use update to edit profile content without email. 
if (isset($_POST['Submit'])) { 
    $fname = !empty($_POST["first_name"]) ? trim($_POST["first_name"]) : "";
    $lname = !empty($_POST["last_name"]) ? trim($_POST["last_name"]) : "";
    $username = !empty($_POST["username"]) ? trim($_POST["username"]) : "";
    $password = !empty($_POST["password"]) ? $_POST["password"] : "";
    $password2 = !empty($_POST["password_confirm"]) ? $_POST["password_confirm"] : "";
    $f_type = !empty($_POST["f_type"]) ? trim($_POST["f_type"]) : "";

    if($password != $password2) {
        //check the password.
        $message = "Passwords do not match.";
    }else if ( !$fname || !$lname || !$username || !$password || !$f_type) {
    	$message = "All fields manadatory.";
    }else{
        $pw_encrypted = password_hash($password, PASSWORD_DEFAULT);
        //check the valid user
        $email = $_SESSION['valid_user'];
        $_SESSION['type'] = $f_type;
        //prepare the query for update. our website can change personal information without email.
        $sql = "UPDATE users ";
        $sql .= " SET first_name = ?, last_name = ?, username= ?, hashed_password= ?, Type= ?";
        $sql .= " WHERE email='$email'";

        $statement = $db->prepare($sql);
        $statement->bind_param('sssss', $fname,$lname, $username, $pw_encrypted, $f_type);//
        $statement->execute();
        $statement->close();
        $db->close();
        //after change all information of firstname,lastname,username, password, and favorite type, go back to profile page.
        redirect_to('profile.php');
    }
}
else {
    $fname = "";
    $lname = "";
    $ussername = "";
    $f_type = "";
}


require('pages-header.php');

?>

<div class="profile-wrapper">
    <h2>Edit Profile</h2>

    <div class = "edit-profile-form">
        <form action="editprofile.php" method="post">
            <div class="form-first-name">
                First Name<br />
                <input type="text" name="first_name" value="" required /><br />
            </div>
            <div class="form-last-name">
                Last Name<br />
                <input type="text" name="last_name" value="" required /><br />
            </div>

            Username:<br />
            <input type="text" name="username" value="" required /><br />
            New Password:<br />
            <input type="password" name="password" value="" required /><br />
            Confirm Password:<br />
            <input type="password" name="password_confirm" value="" required /><br />
    
            <label for="favoriteType">Artwork Type:</label> <br />
            <select name="f_type" id="artworktype">
                <option value="">Select Your Favorite Type</option>
                <option value="Sculpture">Sculpture</option>
                <option value="Fountain or water feature">Fountain or water feature</option>
                <option value="Figurative">Figurative</option>
                <option value="Memorial or monument">Memorial or monument</option>
                <option value="Relief">Relief</option>
                <option value="Totem pole">Totem pole</option>
                <option value="Mural">Mural</option>
                <option value="Site-integrated work">Site-integrated work</option>
            </select>
        <br />
        <br />
        <br />
    </div>
        <input type="submit" name="Submit" value="Update!">
        <?php if(!empty($message)) echo '<p class="message">' . $message . '</p>' ?>
        
        </form>
</div>
</div>

<?php
	require('footer.php');
    $db->close();
?>
