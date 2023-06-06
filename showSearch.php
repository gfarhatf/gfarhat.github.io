<?php
include('included_functions.php');
require_SSL();

require('pages-header.php');
?>


<div class="collections-header">
    <h2> Collections </h2>
    <h3> Art Search </h3>

<!-- we have type and neighbourhood filter! -->   

    <div class="search-collection-select">
        <select name="Type" id="Type" value="<?php echo $_POST['Type'] ; ?>">
            <option value="">Select Artwork Type</option>
            <option value="Sculpture">Sculpture</option>
            <option value="Fountain or water feature">Fountain or water feature</option>
            <option value="Figurative">Figurative</option>
            <option value="Memorial or monument">Memorial or monument</option>
            <option value="Relief">Relief</option>
            <option value="Totem pole">Totem pole</option>
            <option value="Mural">Mural</option>
            <option value="Site-integrated work">Site-integrated work</option>
        </select>

      
        <select name="Neighbourhood" id="Neighbourhood" value="<?php echo $_POST['Neighbourhood']; ?>">
            <option value="">Select Artwork Neighbourhood</option>
            <option value="West End"> West End </option>
            <option value="Mount Pleasant"> Mount Pleasant </option>
            <option value="Grandview-Woodland"> Grandview-Woodland </option>
            <option value="Downtown"> Downtown </option>
            <option value="West Point Grey"> West Point Grey </option>
            <option value="Stanley Park"> Stanley Park </option>
            <option value="Kitsilano"> Kitsilano </option>
            <option value="Strathcona"> Strathcona </option>
            <option value="South Cambie"> South Cambie </option>
            <option value="Sunset"> Sunset </option>
            <option value="Shaughnessy"> Shaughnessy </option>
            <option value="Dunbar-Southlands"> Dunbar-Southlands </option>
        </select>
    </div>

    <div class="search-button-collection">
        <button type="button" name="search" class="" id="search">Search</button>
    </div>

</div>

<div>
    <div>  
        <p><b>Total Collections - <span id="total_collection"></span></b></p>
    </div>
    <div id= "item">
    
    </div>
</div>
</div>
<?php
$db->close();
require('footer.php');
    
?>
<!-- reference: https://www.webslesson.info/2019/03/php-ajax-live-search-with-multiple-value.html -->
<script>
    
$(document).ready(function(){
 
 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"getdata.php",
   method:"POST",
   data:{query:query},
   dataType:"json",
   success:function(data)
   {
    //total how many collection in here.
    $('#total_collection').text(data.length);
    var html = '';
    if(data.length > 0)
    {
     for(var count = 0; count < data.length; count++)
    {


        html += "<div class=\"item-search\">";
        html += "<a href = collectiondetails.php?RegistryID="+data[count].RegistryID + ">" +

        "<img src="+ data[count].PhotoURL +
        "> <br>Type: " + data[count].Type +
        "<br> Neighbourhood: "+ data[count].Neighbourhood + 
        "</a>";
         html += "</div>";
        
        
     }
    }
    else
    {
        html = '<p> No Data Found </p>';
    }
    $('#item').html(html);
   }
  })
 }

 $('#search').click(function(){
    //get all filter's data in one string(csv)
    var query = $('#Type').val();
    query += "," + $('#Neighbourhood').val();
    load_data(query);
 
    console.log(query);


 });

});
</script>