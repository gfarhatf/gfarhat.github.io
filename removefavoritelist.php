<?php
include_once('included_functions.php');

$message = "";
if (!empty($_GET['RegistryID']) && !empty($_SESSION['valid_user'])) {
	//query for delete the item from the db
	$query = "DELETE FROM favoritelist WHERE email=? AND RegistryID =?";
	  
	$stmt = $db->prepare($query);
	$stmt->bind_param('ss',$_SESSION['valid_user'],$_GET['RegistryID']);
	$stmt->execute();
			  
	$message = urlencode("The collection has been removed from to your <a href=\"favoriteList.php\">favoritelist</a>.");
}
//fetch the favoritelist for the user
redirect_to("favoriteList.php");
?>

