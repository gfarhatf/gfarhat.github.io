<?php
//this page displays the art details

//include the functions
include('included_functions.php');
no_SSL();

//get the registryId and the message and make sure there's no space between them
$code = trim($_GET['RegistryID']);
@$msg = trim($_GET['message']);

//query to select the details of the art which Registry ID depends on the art that is being clicked
$query_str = "SELECT RegistryID, DescriptionOfWork, ArtistProjectStatement, Type, Artists, Status, SiteName, PrimaryMaterial, URL, Ownership, Neighbourhood, LocationOnsite, YearOfInstallation, photoURL
			  FROM art
			  WHERE RegistryID = ?"; 
			  
//go through the query and execute it
$stmt = $db->prepare($query_str);
$stmt->bind_param('s',$code);
$stmt->execute();

//get the results of the database and add it to the smtm variable
$stmt->bind_result($rID, $artDescription, $projectStatement, $type, $artists_id, $status, $siteName, $primaryMaterial, $artURL, $ownership, $neighbourhood, $locationOnSite, $artYear, $photo);

//add the header
include('pages-header.php');

//display the query results
if($stmt->fetch()) {
	
	echo "<div class= \"details-image-wrapper\">";
		echo "<div class=\"details-image\">";
			echo "<img src='".$photo."'>";
		echo "</div>";
		echo "<p><strong>Art Description: </strong>$artDescription</p>";
		
		echo "<p><strong>Art year: </strong>$artYear</p>";
		echo "<p><strong>Artist Project Statement: </strong> $projectStatement</p>";

		echo "<p><strong>Type: </strong>$type</p>\n";
		echo "<p><strong>Status: </strong>$status</p>\n";
		echo "<p><strong>Site name: </strong>$siteName</p>\n";
		echo "<p><strong>Material: </strong> $primaryMaterial</p>\n";
		echo "<p><strong>URL with map location: </strong> <a href= '$artURL' class=\"details-url\"> URL can be found here</a></p>";
		echo "<p><strong>Ownership: </strong> $ownership</p>\n";
		echo "<p><strong>Neighbourhood: </strong>$neighbourhood</p>\n";
		echo "<p><strong>Location on site: </strong> $locationOnSite</p>\n";
	 
}
$stmt->free_result();

//display the artists' name (same code as in showcollection.php to get the names of the artists)
$artists= [];
if(strpos($artists_id, ";")){
	$artists_names = "";
		$artists = explode(";",$artists_id);
		$count_artists = count($artists);

		for( $i = 0; $i < $count_artists; $i++ ){
			$artists_names .= getArtistName($artists[$i], $db);
			if( $i < ($count_artists - 1))
				$artists_names .= ", ";
		}

} else {
	$artists_names = getArtistName($artists_id, $db);
}

//display the artist names
echo "<p><strong>Artist: </strong>$artists_names</p>\n";


//favourite list secction

//check if the user is logged and if the art is not in the favorite listand its already in the favorite list.
//if the art is in the favorite list, show a message that the art is already in the favorite list and provide the user with a link to the favoitelist page
//if the art is not in the favorite list, allow the user to click on the favorite list button

if(!is_logged_in() || !is_in_favoritelist($code) ) {
	echo "<form action=\"addfavoritelist.php\" method=\"post\">\n";
	echo "<input type=\"hidden\" name=\"RegistryID\" value=$code>\n";
	echo "<input type=\"submit\" value=\"Add To favoritelist\">\n";
	echo "</form>\n";
} else if (!empty($msg) ) {
	echo "<p>$msg</p>\n";
} else if (is_logged_in()) {
	echo "This collection is already in your <a class=\"action\" href=\"favoriteList.php\">favorite list</a>";
}
echo "</div>";
echo "</div>";

//add the footer
include('footer.php');

//close the database
$db->close();
?>

