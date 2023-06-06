<?php
include('included_functions.php');
require_SSL();
//if user did not click the submit
if (!isset($_POST['submit'])) {
    // email and password is null
    $email = $password = "";
    $type = "";

} else {
    $email = !empty($_POST["email"]) ? trim($_POST["email"]) : "";
    $password = !empty($_POST["password"]) ? trim($_POST["password"]) : "";
    //query for login, email is the id
    $query = "SELECT email,hashed_password,Type FROM users ";
    $query .= "WHERE email = ?";

	$stmt = $db->prepare($query);
	$stmt->bind_param('s',$email);
	$stmt->execute();
	$stmt->bind_result($email,$hashed_password,$type);
	

    if($stmt->fetch() && password_verify($password,$hashed_password)) {
        //now $_SESSION['valid_user'] is login user's email. so use that computer knew that who is user
        $_SESSION['valid_user'] = $email;
        //get login user's favorite type. this will using in index page.
        $_SESSION['type'] = $type;
        $callback_url = "index.php";
        if (isset($_SESSION['callback_url']))
        	$callback_url = $_SESSION['callback_url'];
        redirect_to($callback_url);
    }
    else $message = "Sorry, email and password combination not registered.";
}

//header
require('pages-header.php');

?>

<div class="register-wrapper">
    <h2>Log in </h2>

    <?php if(!empty($message)) echo '<p>' . $message . '</p>' ?>
    <!-- login form, id-> email because email cannot edit. -->
    <form action="login.php" method="post">
        <div class="login-form-wrapper">
            <label for="email">Email Address <input type="email" name="email" value="" required></label>
            <br/>
            <label for="password">Password <input type="password" name="password" value="" required></label>
            <br/>
            <div class="form-submit-wrapper">
                <input type="submit" name="submit" value="Submit">
            </div>
        </div>
    </form>
    <p class="login-register">
        <a href="register.php">Not registered yet? <strong class="login-register-strong">Register here</strong></a>
    </p>
</div>
</div>

<?php 
	require('footer.php');//footer
?>