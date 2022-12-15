<?php

//this function is used to get the current, up to date price for the memberships.
//returns the price of the membership based upon the string passed as an argument.

function getRate(string $membershipType)
{
    $created = false;
    $db = new SQLite3('C:\\xampp\\courseworkDB\\Coursework.db');
    $sql = 'SELECT * FROM MembershipRates WHERE MembershipType = :membershipType';
    $stmt = $db->prepare($sql);

    $mstype = $membershipType;

    $stmt->bindParam(':membershipType', $mstype, SQLITE3_TEXT);

    $result = $stmt->execute();

    while($row=$result->fetchArray(SQLITE3_NUM))
    {
        $arrayResult[] = $row;
        
    }

    return($arrayResult[0][1]);

}

?>