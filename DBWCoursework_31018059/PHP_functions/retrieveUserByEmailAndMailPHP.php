<?php

//this function takes a user's email, locates their account and returns their username, in case the user has forgotten their username.

function findUserAndMail(string $email)
{
    $currentEmail = $email;
    $db = new SQLite3('C:\\xampp\\courseworkDB\\Coursework.db');
    $sql = 'SELECT * FROM Customer WHERE (Email = :email)';
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':email', $currentEmail, SQLITE3_TEXT);

    $result = $stmt->execute();

    if($stmt)
    {
        $row = $result->fetchArray();
        

        if($row != null)
        {
            $arrayResult [] = $row;
            $retrievedUsername = $row[0];
        }
        else{
            $valuesValidated = false;
        }
        

    }

    if($result)
    {
        return($retrievedUsername);
    }
    else{
        return(false);
    }
}

?>