<?php

/*
    This PHP retrieves a user based upon their username, postcode, date of birth and email in order to allow them to change their password.
    This is to be used in the forgotpass.php file, where we must check the users details against the values they provide.
*/

function retrieveUser(string $username, string $postcode, string $dob, string $email)
{
    $created = false;
    $db = new SQLite3('C:\\xampp\\courseworkDB\\Coursework.db');
    $sql = 'SELECT * FROM Customer WHERE (UserName = :username and Postcode = :postcode and DOB = :dob and Email = :email)';
    $stmt = $db->prepare($sql);

    $uname = $username;
    $Email = $email;
    $DOB = $dob;
    $PostCode = strtoupper($postcode);


    $stmt->bindParam(':username', $uname, SQLITE3_TEXT);
    $stmt->bindParam(':email', $Email, SQLITE3_TEXT);
    $stmt->bindParam(':postcode', $PostCode, SQLITE3_TEXT);
    $stmt->bindParam(':dob', $DOB, SQLITE3_TEXT);

    $result = $stmt->execute();

    //echo $username;

    $valuesValidated = false;

    if($stmt)
    {
        //$created = true;
        $row = $result->fetchArray();
        

        if($row != null)
        {
            $retrievedUsername = $row[0];
            $retrievedPostcode = $row[5];
            $retrievedDOB = $row[6];
            $retrievedEmail = $row[4];
            if($retrievedUsername == $uname and $retrievedPostcode == $PostCode and $retrievedDOB == $DOB and $retrievedEmail == $Email)
            {
            $valuesValidated = true;
            }
        }
        else{
            $valuesValidated = false;
        }
        

    }

    return $valuesValidated;


}