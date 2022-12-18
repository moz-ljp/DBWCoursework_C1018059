<?php
include_once("PHP_functions/hashPasswordPHP.php");


function updatePass(string $username, string $newPass)
{
    $created = false;
    $db = new SQLite3('C:\\xampp\\courseworkDB\\Coursework.db');
    $sql = 'UPDATE Customer SET Password = :password WHERE UserName = :username';
    $stmt = $db->prepare($sql);

    $uname = $username;
    $newpass = $newPass;
    $newpass = hashPass($newPass);


    $stmt->bindParam(':username', $uname, SQLITE3_TEXT);
    $stmt->bindParam(':password', $newpass, SQLITE3_TEXT);

    $result = $stmt->execute();


    if($stmt)
    {
        $updated = true;
    }

    return $updated;


}