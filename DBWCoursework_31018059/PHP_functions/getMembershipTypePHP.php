<?php

//this function will return the membership of a given user found by their username.

function getMembership(string $username)
{

    $db = new SQLite3("C:\\xampp\\courseworkDB\\Coursework.db");
    $sql = "SELECT * FROM Membership WHERE UserName = :uid";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':uid', $username, SQLITE3_TEXT);
    $result = $stmt->execute();


    while($row=$result->fetchArray(SQLITE3_NUM))
    {
    $arrayResult[] = $row;
    }

    return($arrayResult[0][2]);

}



?>