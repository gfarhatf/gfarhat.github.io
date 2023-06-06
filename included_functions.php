<?php

//reference from lab code.
//The webpage is secured
function no_SSL() {
	if(isset($_SERVER['HTTPS']) &&  $_SERVER['HTTPS']== "on") {
		header("Location: http://" . $_SERVER['HTTP_HOST'] .
			$_SERVER['REQUEST_URI']);
		exit();
	}
}

//the webpage is not secured, request to the server to be secured.
function require_SSL() {
	if($_SERVER['HTTPS'] != "on") {
		header("Location: https://" . $_SERVER['HTTP_HOST'] .
			$_SERVER['REQUEST_URI']);
		exit();
	}
}

//start the session
session_start();

//connect to the database
$db =  connectToDB('localhost', 'root', '', 'public_art'); 

//take the user to this page with the $url parameter
function redirect_to($url) {
    header('Location: ' . $url);
    exit;
}

//connect to the database
function connectToDB($dbhost, $dbuser, $dbpass, $dbname) {
    $dbection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    //if it failed, show an error
    if (mysqli_connect_errno()) {
        die("Database connection failed:" .
            mysqli_connect_error() .
            " (" . mysqli_connect_errno() . ")"
        );
    }
    return $connection;
}

//see if the user is logged in.
function is_logged_in() {
	return isset($_SESSION['valid_user']);
}

//check if an art is in the favorite list. Only if the user is logged in.
function is_in_favoritelist($code) {
	global $db;
	if (isset($_SESSION['valid_user'])) {
		$query = "SELECT COUNT(*) FROM favoritelist WHERE RegistryID=? AND email=?";
		$stmt = $db->prepare($query);
		$stmt->bind_param('ss',$code, $_SESSION['valid_user']);
		$stmt->execute();
		$stmt->bind_result($count);
	    return ($stmt->fetch() && $count > 0);
	}
	return false;
}

//get the artists both first name and last name from the database to display them on the carousel and on the art details page.
//combine the first name and last names of artists and put it into a variable

function getArtistName($artistId, $db){

    //query to get the first name and last name of the artists which artistId comes from the selected art
	$query_artist = "SELECT FirstName, LastName FROM artist WHERE  ArtistID = " . $artistId;
	$res_artist = $db->query($query_artist);

    //read the results and put it into the artists_names variables
	while ($row_artists = $res_artist->fetch_row()) {
		$artists_names = $row_artists[0] . " " . $row_artists[1];
		
	}

	return $artists_names;
}

?>