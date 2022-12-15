<?php

//This page uses the current session to cancel a user's membership and, as it is using sessions, does not require any parameters.

function cancelMembership()
{
    $username = $_SESSION["Customer"][0];
    $date = date("m/d/Y");
    $defaultMsType = "NA";
    $defaultPaymentStatus = "Suspended";

    $db = new SQLite3("C:\\xampp\\courseworkDB\\Coursework.db");
    $sql = "UPDATE Membership SET MembershipType = :msType, Date = :date, PaymentStatus = :paymentStatus WHERE UserName = :username";

    $stmt = $db->prepare($sql);

    $stmt->bindParam(':username', $username, SQLITE3_TEXT);
    $stmt->bindParam(':msType', $defaultMsType, SQLITE3_TEXT);
    $stmt->bindParam(':date', $date, SQLITE3_TEXT);
    $stmt->bindParam(':paymentStatus', $defaultPaymentStatus);

    $result = $stmt->execute();

    return($result);
}