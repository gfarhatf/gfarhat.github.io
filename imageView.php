<?php
require_once __DIR__ . '/db.php';
if (isset($_GET['image_id'])) {
    //prepare query for select type and data, imageId is got from the showprofileimg.php
    $sql = "SELECT imageType,imageData FROM user_image WHERE imageId=?";
    $statement = $conn->prepare($sql);
    $statement->bind_param("i", $_GET['image_id']);
    $statement->execute() or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_connect_error());
    $result = $statement->get_result();

    $row = $result->fetch_assoc();
    header("Content-type: " . $row["imageType"]);
    echo $row["imageData"];
}
?>

