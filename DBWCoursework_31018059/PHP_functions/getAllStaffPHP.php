<?php

//this function returns an array of all staff accounts, for use by managers viewing staff accounts.

function getAllStaff()
{
    $db = new SQLite3("C:\\xampp\\courseworkDB\\Coursework.db");
    $sql = "SELECT * FROM Staff WHERE (Role = :role)";
    $stmt = $db->prepare($sql);
    $role = "Staff";
    $stmt->bindParam(":role", $role, SQLITE3_TEXT);
    $result = $stmt->execute();

    while($row = $result->fetchArray(SQLITE3_TEXT))
    {
        $arrayResult[] = $row;
    }

    return $arrayResult;

}


?>