<?php

//this function returns an array of all the customers, for use for staff viewing customer accounts.

function getAllCustomers()
{
    $db = new SQLite3("C:\\xampp\\courseworkDB\\Coursework.db");
    $sql = "SELECT * FROM Customer";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();

    while($row = $result->fetchArray(SQLITE3_TEXT))
    {
        $arrayResult[] = $row;
    }

    return $arrayResult;

}


?>