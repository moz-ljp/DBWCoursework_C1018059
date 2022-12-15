<?php

//This function will delete a customer/staff member from the relative table whilst also removing them from the membership table.

function deleteCustomer(string $username, $accountType)
{
    $db = new SQLite3('C:\\xampp\\courseworkDB\\Coursework.db');

    $userType = "Customer";
    $type = $accountType;

    $currentUser = $username;


    if($type == "customer")
    {
        $sql = 'DELETE FROM Customer WHERE (UserName = :username)';
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':username', $currentUser, SQLITE3_TEXT);

        $result = $stmt->execute();

        if($stmt)
        {
            $sql = 'DELETE FROM Membership WHERE (UserName = :username)';
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':username', $currentUser, SQLITE3_TEXT);

            $result = $stmt->execute();

            if($stmt)
            {
                $membershipDeleted = true;
                return($stmt);
            }
        }

    }
    else if($type == "staff")
    {
        $sql = 'DELETE FROM Staff WHERE (UserName = :username)';
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':username', $currentUser, SQLITE3_TEXT);

        $result = $stmt->execute();

        return($stmt);
    }

    /*
    $currentUser = $username;

    $db = new SQLite3('C:\\xampp\\courseworkDB\\Coursework.db');

    //check if the user is a customer or a staff member
    $sql = 'SELECT * FROM Customer WHERE UserName = :username';
    $stmt = $db->prepare($sql);
    
    $stmt->bindParam(':username', $currentUser, SQLITE3_TEXT);

    $result = $stmt->execute();

    if($stmt)
    {
        //$created = true;
        $row = $result->fetchArray();
        

        if($row != null)
        {
            $userType = "Customer";         
        }
        else{
            $sql = 'SELECT * FROM Staff WHERE UserName = :username';
            $stmt = $db->prepare($sql);
            
            $stmt->bindParam(':username', $currentUser, SQLITE3_TEXT);

            $result = $stmt->execute();
            if($stmt)
            {
                $row = $result->fetchArray();

                if($row != null)
                {
                    $userType = "Staff";
                }
                else{
                    $userType = "NA";
                }

            }
        }
        

    }

    $customerDeleted = false;
    $membershipDeleted = false;

    if($userType == "Customer")
    {
        $sql = 'DELETE FROM Customer WHERE (UserName = :username)';
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':username', $currentUser, SQLITE3_TEXT);

        $result = $stmt->execute();
    }
    else if($userType == "Staff")
    {
        $sql = 'DELETE FROM Staff WHERE (UserName = :username)';
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':username', $currentUser, SQLITE3_TEXT);

        $result = $stmt->execute();
    }
    else{
        return false;
    }

    $customerDeleted = true;
    if($customerDeleted)
    {
        $sql = 'DELETE FROM Membership WHERE (UserName = :username)';
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':username', $currentUser, SQLITE3_TEXT);

        $result = $stmt->execute();

        if($stmt)
        {
            $membershipDeleted = true;
        }
    }
    else{
        return false;
    }


    return($membershipDeleted and $customerDeleted);

    */

    

    

}

?>