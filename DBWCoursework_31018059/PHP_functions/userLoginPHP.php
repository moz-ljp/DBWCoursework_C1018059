<?php
include_once("hashPasswordPHP.php");

//this function allows us to log a user in based upon their username and password and the type of user they are (staff or customer).

function loginUser(string $username, string $password, string $type)
{

    $hashPass = hashPass($password);
    if($type == "Customer")
    {   
        $sql = 'SELECT * FROM Customer WHERE (UserName = :username and Password = :password)';
    }
    else if($type == "Staff")
    {
        $sql = 'SELECT * FROM Staff WHERE (UserName = :username and Password = :password)';
    } 

    $created = false;
    $db = new SQLite3('C:\\xampp\\courseworkDB\\Coursework.db');
    $stmt = $db->prepare($sql);
    
    $uname = $username;
    $pword = $password;
    
    
    $stmt->bindParam(':username', $uname, SQLITE3_TEXT);
    $stmt->bindParam(':password', $hashPass, SQLITE3_TEXT);
    
    $result = $stmt->execute();
    
        //echo $username;
    
        $valuesValidated = false;
    
        if($stmt)
        {
            //$created = true;
            $row = $result->fetchArray();
            
    
            if($row != null)
            {
                $arrayResult [] = $row;
                $retrievedUsername = $row[0];
                $retrievedPassword = $row[3];
                if($retrievedUsername == $uname and $retrievedPassword = $pword)
                {
                    $valuesValidated = true;
                }
            }
            else{
                $valuesValidated = false;
            }
        }

    return $arrayResult;


}