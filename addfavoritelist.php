<?php
include_once('included_functions.php');

$RegistryID = !empty($_POST['RegistryID']) ? $_POST['RegistryID'] : "";

if(!isset($_SESSION['valid_user'])) {
	$_SESSION['callback_url'] = 'addfavoritelist.php';
	$_SESSION['RegistryID'] = $RegistryID;
	redirect_to('login.php');
} 

$email = $_SESSION['valid_user'];
if (isset($_SESSION['callback_url']) && $_SESSION['callback_url'] == 'addfavoritelist.php') {
	$RegistryID = $_SESSION['RegistryID'];
	unset($_SESSION['callback_url'],$_SESSION['RegistryID']);
}
//when user add favorite item, this php prepare insert query.
$message = "";
if (!is_in_favoritelist($RegistryID)) {
	$query = "INSERT INTO favoritelist (email, RegistryID) VALUES (?,?)";
	  
	$stmt = $db->prepare($query);
	$stmt->bind_param('ss',$email,$RegistryID);
	$stmt->execute();
			  
	$message = urlencode("The collection has been added to your <a href=\"favoriteList.php\">favoritelist</a>.");
}

//fetch the favoritelist for the user
redirect_to("collectiondetails.php?RegistryID=$RegistryID&message=$message");

?>