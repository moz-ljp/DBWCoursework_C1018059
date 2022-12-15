<?php

//this function creates a new staff member in the staff table.

function createUser(string $username, string $hashedPass)
{
    //add user to Staff table
    $created = false;
    $db = new SQLite3('C:\\xampp\\courseworkDB\\Coursework.db');
    $sql = 'INSERT INTO Staff(UserName, firstName, lastName, Password, Role, Email, Enabled) VALUES (:username, :firstname, :surname, :password, :role, :email, :enabled)';
    $stmt = $db->prepare($sql);

    $uname = $username;
    $postcode = strtoupper($_POST['postcode']);
    $hashPass = $hashedPass;
    $enabled = "true";
    $role = "Staff";


    $stmt->bindParam(':username', $uname, SQLITE3_TEXT);
    $stmt->bindParam(':firstname', $_POST['firstname'], SQLITE3_TEXT);
    $stmt->bindParam(':surname', $_POST['surname'], SQLITE3_TEXT);
    $stmt->bindParam(':password', $hashPass, SQLITE3_TEXT);
    $stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);
    $stmt->bindParam(':role', $role, SQLITE3_TEXT);
    $stmt->bindParam(':enabled', $enabled, SQLITE3_TEXT);

    $stmt->execute();

    if($stmt)
    {
        $created = true;
    }

    return $created;


}