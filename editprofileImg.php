<?php
    include('included_functions.php');

//change the profile image.
//this reference that https://phppot.com/php/mysql-blob-using-php/
//We got many information from that website, but we did not use imagegallery as that website.
//we upload for update the user profile image! not insert.

    require_once __DIR__ . '/db.php';
    if (count($_FILES) > 0) {
        if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
            $imgData = file_get_contents($_FILES['userImage']['tmp_name']);
            $imgType = $_FILES['userImage']['type'];
            $email = $_SESSION['valid_user'];

            $sql = "UPDATE user_image ";
            $sql .= " SET imageType=? ,imageData=?";
            $sql .= " WHERE email='$email'";
            $statement = $conn->prepare($sql);
            $statement->bind_param('ss', $imgType, $imgData);
            $statement->execute();
            redirect_to('profile.php');
        }
    }
    require('pages-header.php');
?>

<h2>Edit Profile Image</h2>
<form name="frmImage" enctype="multipart/form-data" action=""
    method="post">
    <div class="img-container tile-container">
        <p>Upload Image File:</p>
        <div class="row">
            <input name="userImage" type="file" class="full-width" />
        </div>
        <div class="row">
            <input type="submit" value="Submit" />
        </div>
    </div>
</form>
</div>

<?php
	require('footer.php');
?>
