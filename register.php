<?php
include('included_functions.php');
require_SSL();


if (isset($_POST['Submit'])) { 
    // detect form submission

    // detect if each variable is set (fname, lname, email, password, sid, faculty)
    $fname = !empty($_POST["first_name"]) ? trim($_POST["first_name"]) : "";
    $lname = !empty($_POST["last_name"]) ? trim($_POST["last_name"]) : "";
    $email = !empty($_POST["email"]) ? trim($_POST["email"]) : "";
    $username = !empty($_POST["username"]) ? trim($_POST["username"]) : "";
    $password = !empty($_POST["password"]) ? $_POST["password"] : "";
    $password2 = !empty($_POST["password_confirm"]) ? $_POST["password_confirm"] : "";
    $f_type = !empty($_POST["f_type"]) ? trim($_POST["f_type"]) : "";


    if($password != $password2) {
        //check the password. if both password same then user knew their password
        $message = "Passwords do not match.";
    }
    else if (!$fname || !$lname || !$email || !$username || !$password || !$f_type) { 
        //all value must need value. 
    	$message = "All fields manadatory.";
    }else {
        //check the email is already exist in users db?
        //this checking email reference: https://phpdelusions.net/pdo_examples/check_email_exists
        $connect = new PDO("mysql:host=localhost;dbname=public_art", "root", "");
        $stmt = $connect->prepare("SELECT email FROM users WHERE email=?");
        $stmt->execute([$email]); 
        $user = $stmt->fetch();
        if ($user) {
            //if email exist, then send message
            $message =  "This email already exist. use different email for register";
        } else {
            // or email not exist, prepare the query for register
            $pw_encrypted = password_hash($password, PASSWORD_DEFAULT);
            //query for insert with value. that value get use bind_param
            $query = "INSERT INTO users (first_name, last_name, email, username, hashed_password, Type) ";
            $query .= "VALUES (?,?,?,?,?,?)";
        
            $stmt = $db->prepare($query);
            //six strings
            $stmt->bind_param('ssssss',$fname,$lname,$email,$username,$pw_encrypted,$f_type);
            $stmt->execute();
            //close that query. because already insert the user info
            $stmt ->close();

            //why add profile image here. when user register, we need to add user's profile image. because this is different data base which is user_image.
            $imgData = " ";
            $imgType = "image/jpeg";
            $sql = "INSERT INTO user_image (imageType ,imageData, email) VALUES(?, ?, ?)"; 
            $statement = $db->prepare($sql);
            $statement->bind_param('sss', $imgType, $imgData, $email);
            $statement->execute();
            $statement->close();
            
            //when successful to register, go to login page automatically.
            redirect_to('login.php');
        }
    }
} else {
    //if not submit the user info. then "" null
    $fname = "";
    $lname = "";
    $email = "";
    $username = "";
    $f_type = "";
}

//include the header
require('pages-header.php');
?>

<div class="register-wrapper">
    <h2>Register</h2>
    <form action="register.php" method="post">
        <div class="form-wrapper">
            <div class="grid two-columns add-gutters">
                <div class="form-first-name">
                    First Name<br />
                    <input type="text" name="first_name" value="" required /><br />
                </div>
                <div class="form-last-name">
                    Last Name<br />
                    <input type="text" name="last_name" value="" required /><br />
                </div>
            </div>
            <div class="form-rest-info">
                Email<br />
                <input type="text" name="email" value="" required /><br />
            
                Username<br />
                <input type="text" name="username" value="" required /><br />
        
                Password<br />
                <input type="password" name="password" value="" required /><br />
            
                Confirm Password<br />
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
            </div>

                <br/>
                <br />
            <div class="form-submit-wrapper">
                <input class="form-submit" type="submit" name="Submit" value="Register">
            </div>
            
        </div>
        <?php if(!empty($message)) echo '<p class="message">' . $message . '</p>' ?>
    </form>
</div>
</div>

<?php
    //footer
	require('footer.php');
    $db->close();

    
?>