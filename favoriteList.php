<?php
include_once('included_functions.php');
no_SSL();

if(!isset($_SESSION['valid_user'])) {
	$_SESSION['callback_url'] = 'favoriteList.php';
	redirect_to('login.php');
} 

$email = $_SESSION['valid_user'];
if (isset($_SESSION['callback_url']) && $_SESSION['callback_url'] == 'favoriteList.php') {
	unset($_SESSION['callback_url']);
}
//prepare query for select
$query_str = "SELECT A.RegistryID, A.Type ";
$query_str .= "FROM art A INNER JOIN favoritelist F ON A.RegistryID = F.RegistryID ";
$query_str .= "WHERE F.email='$email'";
$res = $db->query($query_str);
//this function from the Assignment 4
function format_collection_name_as_link($id,$name,$page) {
	echo "<a href=\"$page?RegistryID=$id\"> Collection:$id, $name</a>";
	}
function format_favoritelist_action_link($id,$name,$page) {
	echo "<a class=\"action\" href=\"$page?RegistryID=$id\">$name</a>";
	}

include_once('pages-header.php');

if (isset($message)) echo "<p>$message</p>";

echo "<h2>Your Favourite List</h2>\n";
echo "<ul>\n";
while ($row = $res->fetch_row()) {
	echo "<li class= \"favouriteList-items\">";
	//use function to get link
	format_collection_name_as_link($row[0], $row[1],"collectiondetails.php");
	echo " ";
	format_favoritelist_action_link($row[0],"<span class=\"pc\">Remove</span>","removefavoritelist.php");
	echo "</li>\n";
};
echo "</ul>\n";
echo "</div>";
include_once('footer.php');

$res->free_result();
$db->close();
?>

