
<?php
// logout php. if click the logout. then $_SESSION is destroy, and go to indexpage 

    //include the functions
    include('included_functions.php');

    //start the session
    session_start();

    //destroy the session
    session_destroy();

    //show a log out message
    $message = "log out";

    //redirect to the homepage
    redirect_to('index.php');

?>