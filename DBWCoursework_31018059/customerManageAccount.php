<?php
//session_start(); //start the session for this page so we can access superglobal variables
include("navbar.php");
include_once("PHP_functions/getMembershipTypePHP.php");
include_once("PHP_functions/getMembershipRatePHP.php");
include_once("PHP_functions/userLoginPHP.php");
include_once("PHP_functions/getDaysRemainingOnMembershipPHP.php");


$membType = "";

$staff = false;

if(isset($_SESSION["Customer"]))
{
    $username = $_SESSION["Customer"]["UserName"];
    $staff = false;
}
else if(isset($_SESSION["Staff"]))
{
    $username = $_SESSION["Staff"]["UserName"];
    $staff = true;
}
else
{
    header("Location: index.php");
}


if($username != null && !$staff){
    $loggedIn = true;
    $membType = getMembership($username);
}

if(!$staff)
{
    $db = new SQLite3("C:\\xampp\\courseworkDB\\Coursework.db");
    $sql = "SELECT * FROM Customer WHERE UserName = :uid";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':uid', $username, SQLITE3_TEXT);
    $result = $stmt->execute();

    while($row=$result->fetchArray(SQLITE3_TEXT))
    {
        $arrayResult[] = $row;
    }
    $_SESSION["Customer"] = $arrayResult[0]; //get the first row of the returned array, there should only ever be one row in this array.
}
else
{
    $db = new SQLite3("C:\\xampp\\courseworkDB\\Coursework.db");
    $sql = "SELECT * FROM Staff WHERE UserName = :uid";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':uid', $username, SQLITE3_TEXT);
    $result = $stmt->execute();

    while($row=$result->fetchArray(SQLITE3_TEXT))
    {
        $arrayResult[] = $row;
    }
    $_SESSION["Staff"] = $arrayResult[0]; //get the first row of the returned array, there should only ever be one row in this array.
}


if(isset($_POST['submit']))
{
    $staff = false;

    if(isset($_SESSION["Customer"]))
    {
        $username = $_SESSION["Customer"]["UserName"];
        $staff = false;
    }
    else if(isset($_SESSION["Staff"]))
    {
        $username = $_SESSION["Staff"]["UserName"];
        $staff = true;
    }
    else
    {
        header("Location: index.php");
    }

    if(!$staff)
    {
        if($_POST['membershipType'] == "NA" and $membType != "NA")
        {
            echo "<script type='text/javascript'>alert('Membership type must be selected before you can submit. Please go to the cancellation place to cancel your membership');</script>";
        }
        else
        {
            $db = new SQLite3("C:\\xampp\\courseworkDB\\Coursework.db");
            $sql = "UPDATE Customer SET firstName = :fname, lastName = :lname, Email = :email, DOB = :dob, Postcode = :postcode WHERE UserName = :username";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':username',$username, SQLITE3_TEXT); //discuss this
            $stmt->bindParam(':fname',$_POST['firstname'], SQLITE3_TEXT);
            $stmt->bindParam(':lname',$_POST['surname'], SQLITE3_TEXT);
            $stmt->bindParam(':email',$_POST['email'], SQLITE3_TEXT);
            $stmt->bindParam(':dob',$_POST['DOB'], SQLITE3_TEXT);
            $stmt->bindParam(':postcode',$_POST['postcode'], SQLITE3_TEXT);
            
            $stmt->execute();
    
            $sql = "UPDATE Membership SET Date = :date, MembershipType = :membershiptype WHERE UserName = :username";
            $stmt = $db->prepare($sql);
    
            $date = date("m/d/Y");
            $radioVal = $_POST['membershipType'];
            
            $stmt->bindParam(':username', $username, SQLITE3_TEXT);
            $stmt->bindParam(':date', $date, SQLITE3_TEXT);
            $stmt->bindParam(':membershiptype', $radioVal, SQLITE3_TEXT);
    
            $stmt->execute();
    
            header('Location: customerManageAccount.php?updated=true'); 
        }
    }
    else
    {
        $db = new SQLite3("C:\\xampp\\courseworkDB\\Coursework.db");
        $sql = "UPDATE Staff SET firstName = :fname, lastName = :lname, Email = :email WHERE UserName = :username";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username',$username, SQLITE3_TEXT); //discuss this
        $stmt->bindParam(':fname',$_POST['firstname'], SQLITE3_TEXT);
        $stmt->bindParam(':lname',$_POST['surname'], SQLITE3_TEXT);
        $stmt->bindParam(':email',$_POST['email'], SQLITE3_TEXT);
            
        $stmt->execute();
        header('Location: customerManageAccount.php?updated=true'); 
    }
    
	
}

?>

<!-- 
    This page is where the user is sent after they have logged in.
    It allows them to update their details.
-->

<div class="container pb-5">

    <main role="main" class="pb-3">
        <h2>Edit Your Details</h2><br>

        
        <?php if(isset($_GET['updated'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Your account has been updated
            <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif; ?>

        <?php if(!$staff): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            You have <?php echo getRemainingDays($username); ?> days left on your membership/until you have to renew your membership.   
            <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif; ?>

        
            <div class="col-sm-12 signupbox">
        <form method="post">
        <div class="row" style="margin:20px;">
            <div class="col-sm-6">
                <label>First Name</label>
                <input type="text" class="form-control" placeholder="Forename" name="firstname" value="<?php if(!$staff){echo $_SESSION["Customer"]["firstName"];}else{ echo $_SESSION["Staff"]["firstName"];} ?>">
            </div>
            <div class="col-sm-6">
            <label>Surname</label>
                <input type="text" placeholder="Surname" class="form-control" name="surname" value="<?php if(!$staff){echo $_SESSION["Customer"]["lastName"];}else{echo $_SESSION["Staff"]["lastName"];} ?>">
            </div>
        </div>
        <div class="row" style="margin:20px;">
        <?php if(!$staff ){ ?>
        <div class="col-sm-6">
                <label>Date of Birth</label>
                <input type="date" class="form-control" name="DOB" value="<?php echo $_SESSION["Customer"]["DOB"]; ?>">
            </div>
        <?php } ?>
            <div class="col-sm-6">
            <label>Email Address</label>
                <input type="email" placeholder="you@something.com" class="form-control" name="email" value="<?php if(!$staff){echo $_SESSION["Customer"]["Email"];}else{echo $_SESSION["Staff"]["Email"];} ?>">
            </div>
        </div>
        <div class="row" style="margin:20px;">
        <?php if(!$staff ){ ?>
        <div class="col-sm-6">
                <label>Postcode</label>
                <input type="postcode" placeholder="S1 1BX" class="form-control" name="postcode" value="<?php echo $_SESSION["Customer"]["Postcode"]; ?>">
        </div>
        <?php } ?>
        <div class="col-sm-6">
                <label>Username</label>
                <input type="text" placeholder="xyz" class="form-control" name="username" value="<?php if(!$staff){echo $_SESSION["Customer"]["UserName"];}else{echo $_SESSION["Staff"]["UserName"];}?>" disabled>
        </div>
        </div>

        <?php if(!$staff){ ?>
        <div class="row" style="margin:20px;">
        <div class="col-sm-3">
        <select name="membershipType" class="btn btn-secondary dropdown-toggle">
            <option value="NA">Choose an option</option>
            <option value="Daily" id="Daily">Daily Pass £<?php echo getRate("Daily")?></option>
            <option value="Monthly" id="Monthly">Monthly Subscription £<?php echo getRate("Monthly")?></option>
        </select>
        </div>
        </div>
        <?php } ?>

        <div class="row" style="margin:20px;">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-success" value="Update Customer" name="submit" style="margin-bottom: 5px;">Update</button>
            <button type="reset " class="btn btn-danger" style="margin-bottom: 5px;">Reset</button>
            </div>
        </div>

        <?php if(!$staff) { ?>
        <div class="row" style="margin:20px;">
            <div class="col-sm-6">
                <a style="color:grey; text-decoration:none;" href="cancelMembership.php">I want to cancel my membership</a>
            </div>
        </div>
        <?php } else{?>
            <a href="viewCustomers.php" class="btn btn-warning">Go Back</a> <?php } ?>


        </form>
        </div>


    </main>
</div>


<?php
    include("footer.php");
?>