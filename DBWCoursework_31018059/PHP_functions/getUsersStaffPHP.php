<?php //This page will be used to retrieve a customer's information for the staff


    function getUser(string $username, bool $isStaff)
    {

        $db = new SQLite3('C:\\xampp\\courseworkDB\\Coursework.db');

        $currentUser = $username;

        if(!($isStaff))
        {
            $sql = 'SELECT Customer.UserName, Customer.firstName, Customer.lastName, Customer.Password, Customer.Email, Customer.Postcode, Customer.DOB, Membership.MembershipType, Membership.PaymentStatus FROM Customer INNER JOIN Membership on (Customer.UserName = Membership.UserName) WHERE Customer.UserName = :username';
        }
        else if($isStaff)
        {
            $sql = 'SELECT * FROM Staff WHERE UserName = :username';  
        }

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':username', $currentUser, SQLITE3_TEXT);

        $result = $stmt->execute();
            
        while($row=$result->fetchArray(SQLITE3_TEXT))
            {
                $arrayResult[] = $row;
            }

        return $arrayResult;
    }
    


?>