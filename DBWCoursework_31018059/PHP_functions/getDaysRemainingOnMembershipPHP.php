<?php

//this function finds the membership type of a user and determines how many days they have left on their membership based off of that information and the saved date in the database from when they signed up.

function getRemainingDays($username)
{
    $db = new SQLite3('C:\\xampp\\courseworkDB\\Coursework.db');
    $sql = 'SELECT * FROM Membership WHERE UserName = :username';
    $stmt = $db->prepare($sql);

    $currentUsername = $username;

    $stmt->bindParam(':username', $currentUsername, SQLITE3_TEXT);

    $result = $stmt->execute();

    while($row=$result->fetchArray(SQLITE3_NUM))
    {
        $arrayResult[] = $row;
    }

    if($arrayResult[0][2] == "Monthly")
    {

        $todaysDate = new DateTime('NOW');
        $pastDate = new DateTime($arrayResult[0][1]);

        $interval = $todaysDate->diff($pastDate);

        return(30-($interval->days));
        
    }
    else if($arrayResult[0][2] == "Daily")
    {
        
        $todaysDate = new DateTime('NOW');
        $pastDate = new DateTime($arrayResult[0][1]);

        $interval = $todaysDate->diff($pastDate);

        return(1-($interval->days));
        

    }
    else{return(0);}

    

    return (0); 

}   

?>