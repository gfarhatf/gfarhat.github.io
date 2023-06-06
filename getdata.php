<?php

$connect = new PDO("mysql:host=localhost;dbname=public_art", "root", "");

$output = '';

$query = '';

if(isset($_POST["query"]))
{
    // $_POST["query"] is a filter's value that format csv
    $search = $_POST["query"];
    //create array.
    $postdata = explode(",",$search);
    
    //and give them as query for search with using array 0->type, 1->neibourhood
    if(!empty($postdata[0]) && !empty($postdata[1])){
        //both filter working
        $query = "
        SELECT RegistryID, Type, Neighbourhood, PhotoURL FROM art WHERE 
        Type = '".$postdata[0]."' 
        AND Neighbourhood REGEXP '".$postdata[1]."' 
        ";
    }else if(empty($postdata[0])){
        //only neibhbourhood exist
        $query = "
        SELECT RegistryID, Type, Neighbourhood, PhotoURL FROM art WHERE 
         Neighbourhood = '".$postdata[1]."' 
        ";
    }else if(empty($postdata[1])){
        //only type exist
        $query = "
        SELECT RegistryID, Type, Neighbourhood, PhotoURL FROM art WHERE 
         Type = '".$postdata[0]."' 
        ";
    }

}
else{
    //if non of filter selected
 $query = "
 SELECT RegistryID, Type, Neighbourhood, PhotoURL FROM art ORDER BY YearOfInstallation DESC
 ";
}

$statement = $connect->prepare($query);
$statement->execute();

while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
    $data[] = $row;
}
echo json_encode($data);

?>