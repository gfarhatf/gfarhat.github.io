<?php
//check valid user(the email)
$email = $_SESSION['valid_user'];
//select the imgid for the user
$sql = "SELECT imageId FROM user_image WHERE email='$email'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

?>

<?php

//use imageView, we show our BLOB data as image. but what is onerror? first time we insert " "<-this's BLOB data
//so that first BLOB data is not image data, so it showing error. That is why we customized erroricon to basicprofile.jpg here.

    if ($row = $result->fetch_assoc()) {
        ?>
		<img src="imageView.php?image_id=<?php echo $row["imageId"]; ?> " onerror="this.src='img/basicprofile.jpg'">
<?php
    }

?>