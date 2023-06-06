<?php
//art collection that is shown in the homepage

//query to get the art details 

if(isset($_SESSION['valid_user'])){
	$type = $_SESSION['type'];

	$query_str = "SELECT art.RegistryID, art.PhotoURL, art.DescriptionOfWork, art.YearOfInstallation, art.Artists, art.Type FROM `art` WHERE art.Type = '$type'  LIMIT 5";
}else{
	$query_str = "SELECT art.RegistryID, art.PhotoURL, art.DescriptionOfWork, art.YearOfInstallation, art.Artists, art.Type FROM `art` LIMIT 10";
}


$res = $db->query($query_str);

//function to apply a link to the art items
function collection_name_as_link($art_id, $art_photo, $art_description, $art_year, $artists, $page) {
	echo "<a href=\"$page?RegistryID=$art_id\"> $art_photo $artists $art_description $art_year</a>";
}

?>

<div class="pages-wrapper">

<?php

//collections title
echo "<h2>Collections</h2><br><br>";

//carousel item information display starts
echo "<div class= \"carousel\">";
while ($row = $res->fetch_row()) {
	//create a new array to put the values of the artists column into it
	$artists= [];

	$item_id = $row[0];
	
	//check if there is a colon on the artist column
	if(strpos($row[4], ";")){
		//clear the artist_names variable to display the artist for each art and not a combination
		$artists_names = "";

		//get the individual values that are separated by the colon and put it into the array
		$artists = explode(";",$row[4]);
		$count_artists = count($artists);

		//loop through the array
		for( $i = 0; $i < $count_artists; $i++ ){

			//add the name and last name into a variable
			$artists_names .= getArtistName($artists[$i], $db);

			//if there are two artists that made an art, just put a comma after the first artist names and last names.
			if( $i < ($count_artists - 1))
				$artists_names .= ", ";
		}

	} else {
		//if theres not a colon on that column run the query to get the names and last names of the artist
		$artists_names = getArtistName($row[4], $db);
	}
	
	//put the values to display into variables for better readibility 
	$photo = $row[1];
	$description = $row[2];	
	$year = $row[3];	

	//display the values 
	echo "<div class= \"art-item\">";
		echo "<p>";
			collection_name_as_link($item_id, "<img src='".$photo."' ><br>" , "<br><br>". $description, "<br><br>".$year, $artists_names, "collectiondetails.php");
			
		echo "</p>";
	echo "</div>";
	
};
echo "</div>";

//carousel item information display ends


//free the result of the database
$res->free_result();

//close the database
$db->close();

?>

</div>