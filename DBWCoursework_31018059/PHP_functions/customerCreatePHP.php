<?php

//This page creates a new user from a given username and password. The password is hashed before being passed to this function.

function createUser(string $username, string $hashedPass)
{
    //add user to Customers table
    $created = false;
    $db = new SQLite3('C:\\xampp\\courseworkDB\\Coursework.db');
    $sql = 'INSERT INTO Customer(UserName, firstName, lastName, Password, Email, Postcode, DOB) VALUES (:username, :firstname, :surname, :password, :email, :postcode, :DOB)';
    $stmt = $db->prepare($sql);

    $uname = $username;
    $postcode = strtoupper($_POST['postcode']);
    $hashPass = $hashedPass;


    $stmt->bindParam(':username', $uname, SQLITE3_TEXT);
    $stmt->bindParam(':firstname', $_POST['firstname'], SQLITE3_TEXT);
    $stmt->bindParam(':surname', $_POST['surname'], SQLITE3_TEXT);
    $stmt->bindParam(':password', $hashPass, SQLITE3_TEXT);
    $stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);
    $stmt->bindParam(':postcode', $postcode, SQLITE3_TEXT);
    $stmt->bindParam(':DOB', $_POST['DOB'], SQLITE3_TEXT);

    $stmt->execute();

    if($stmt)
    {
        $created = true;
    }

    if($created)
    {
        //add user to membership table
        $created = false;
        $sql = 'INSERT INTO Membership(UserName, Date, MembershipType, PaymentStatus) VALUES (:username, :date, :membershiptype, :paymentstatus)';
        $stmt = $db->prepare($sql);
        $date = date("m/d/Y");
        $defaultMembershipType = 'NA';
        $defaultPaymentType = 'Pending';

        $stmt->bindParam(':username', $uname, SQLITE3_TEXT);
        $stmt->bindParam(':date',   $date, SQLITE3_TEXT);
        $stmt->bindParam(':membershiptype', $defaultMembershipType, SQLITE3_TEXT);
        $stmt->bindParam(':paymentstatus', $defaultPaymentType, SQLITE3_TEXT);

        $stmt->execute();

        if($stmt)
        {
            $created = true;
        }


    }

    return $created;


}