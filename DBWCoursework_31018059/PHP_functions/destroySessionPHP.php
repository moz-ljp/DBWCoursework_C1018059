<?php 

//this function simply destroys the current session and is called when a user logs out of their account.

function destroySession()
{
    session_destroy();
    header('Location: index.php'); 
}

?>