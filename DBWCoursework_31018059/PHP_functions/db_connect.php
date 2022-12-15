<?php
//This file is to check that the database is successfully
//connected to our page

$db = new SQLite3("C:\\xampp\\courseworkDB\\Coursework.db");

if($db)
{
    echo "Database is successfully connected";
}
else{
    echo "Failed to connect to the database";
}
?>