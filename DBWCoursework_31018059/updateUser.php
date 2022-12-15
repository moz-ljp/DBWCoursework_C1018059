<?php
include("navbar.php");
include_once("PHP_functions/getUsersStaffPHP.php");
include_once("PHP_functions/getMembershipRatePHP.php");
include_once("PHP_functions/getDaysRemainingOnMembershipPHP.php");

$db = new SQLite3('C:\\xampp\\courseworkDB\\Coursework.db');

$arrayResult[] = getUser($_GET["username"], $_GET["staff"]);
$_SESSION["UpdatingUser"] = $arrayResult[0][0];

if($_GET["staff"] == false)
{
    $remainingDays = getRemainingDays($_SESSION["UpdatingUser"]["UserName"]);
    if($remainingDays <= 0)
    {
        $_SESSION["UpdatingUser"]["MembershipExpired"] = true;
    }
}


if(isset($_POST['submit']))
{
    if($_GET["staff"]) //if they are staff
    {
        $sql = "UPDATE Staff SET firstName = :fname, lastName = :lname, Email = :email, enabled = :enabled, Role = :role WHERE UserName = :username";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username',$_GET["username"], SQLITE3_TEXT); //discuss this
        $stmt->bindParam(':fname',$_POST['firstname'], SQLITE3_TEXT);
        $stmt->bindParam(':lname',$_POST['surname'], SQLITE3_TEXT);
        $stmt->bindParam(':email',$_POST['email'], SQLITE3_TEXT);
        $stmt->bindParam(':enabled',$_POST['staffEnabled'], SQLITE3_TEXT);
        $stmt->bindParam(':role',$_POST['role'], SQLITE3_TEXT);
        
        $stmt->execute();

        header('Location: updateUser.php?updated=true&staff='.$_GET["staff"].'&username='.$_GET["username"]); 
    }
    else //they aren't staff
    {
        $sql = "UPDATE Customer SET firstName = :fname, lastName = :lname, Email = :email, DOB = :dob, Postcode = :postcode WHERE UserName = :username";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username',$_GET["username"], SQLITE3_TEXT);
        $stmt->bindParam(':fname',$_POST['firstname'], SQLITE3_TEXT);
        $stmt->bindParam(':lname',$_POST['surname'], SQLITE3_TEXT);
        $stmt->bindParam(':email',$_POST['email'], SQLITE3_TEXT);
        $stmt->bindParam(':dob',$_POST['DOB'], SQLITE3_TEXT);
        $stmt->bindParam(':postcode',$_POST['postcode'], SQLITE3_TEXT);
        
        $stmt->execute();

        $sql = "UPDATE Membership SET Date = :date, MembershipType = :membershiptype, PaymentStatus = :paymentStatus WHERE UserName = :username";
        $stmt = $db->prepare($sql);

        $date = date("m/d/Y");
        $radioVal = $_POST['membershipType'];
        
        $stmt->bindParam(':username', $_GET["username"], SQLITE3_TEXT);
        $stmt->bindParam(':date', $date, SQLITE3_TEXT);
        $stmt->bindParam(':membershiptype', $radioVal, SQLITE3_TEXT);
        $stmt->bindParam(':paymentStatus', $_POST["paymentStatus"], SQLITE3_TEXT);

        $stmt->execute();

        header('Location: updateUser.php?updated=true&staff='.$_GET["staff"].'&username='.$_GET["username"]); 

    }
	
}

?>

<div class="container pb-5">
    <main role="main" class="pb-3">
        <h2>Update User</h2><br>

        <?php if(isset($_GET['updated'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            The  account has been updated
            <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION["UpdatingUser"]["MembershipExpired"])): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            The user's membership has expired.
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
                <input type="text" class="form-control" placeholder="Forename" name="firstname" value="<?php echo $_SESSION["UpdatingUser"]["firstName"]; ?>">
            </div>
            <div class="col-sm-6">
            <label>Surname</label>
                <input type="text" placeholder="Surname" class="form-control" name="surname" value="<?php echo $_SESSION["UpdatingUser"]["lastName"]; ?>">
            </div>
        </div>
        <div class="row" style="margin:20px;">
        <?php if(!($_GET["staff"])) { ?>
        
        <div class="col-sm-6">
                <label>Date of Birth</label>
                <input type="date" class="form-control" name="DOB" value="<?php echo $_SESSION["UpdatingUser"]["DOB"];?>">
            </div>
        <?php } else {?>
            <div class="col-sm-6">
                <label>Staff Member Enabled</label>
                <input type="checkbox"
                
                <?php
                    if($_SESSION["UpdatingUser"]["Enabled"] == "true")
                    {
                        ?> checked <?php
                    }

                    ?>>
                
                <!--<input type="text" class="form-control" name="staffEnabled" value="<//?php echo $_SESSION["UpdatingUser"]["Enabled"];?>">-->
                <br /><select name="staffEnabled" class="btn btn-secondary dropdown-toggle">
                    <option value="true">Enabled</option>
                    <option value="false" >Disabled</option>
                </select>
            </div>
            <?php } ?>
            <div class="col-sm-6">
            <label>Email Address</label>
                <input type="email" placeholder="you@something.com" class="form-control" name="email" value="<?php echo $_SESSION["UpdatingUser"]["Email"]; ?>">
            </div>
        </div>


        <div class="row" style="margin:20px;">
        <?php if(!($_GET["staff"])) { ?>
        <div class="col-sm-6">
                <label>Postcode</label>
                <input type="postcode" placeholder="S1 1BX" class="form-control" name="postcode" value="<?php echo $_SESSION["UpdatingUser"]["Postcode"]; ?>">
            </div>
        <?php } else {?>
            <div class="col-sm-6">
                <label>Role</label><br />
                <select name="role" class="btn btn-secondary dropdown-toggle">
                <option value="Staff">Staff</option>
                <option value="Manager" >Manager</option>
            </select>
            </div>
        <?php } ?>
        <div class="col-sm-6">
                <label>Username</label>
                <input type="text" placeholder="xyz" class="form-control" name="username" value="<?php echo $_SESSION["UpdatingUser"]["UserName"];?>" disabled>
        </div>
        </div>

        <div class="row" style="margin:20px;">
        <?php if(!($_GET["staff"])) { ?>
        <div class="col-sm-6">
        <label>Set Membership (Currently: <?php echo $_SESSION["UpdatingUser"]["MembershipType"]?>)</label><br />
        <select name="membershipType" class="btn btn-secondary dropdown-toggle">
            <option value="NA">No Membership</option>
            <option value="Daily" id="Daily">Daily Pass £<?php echo getRate("Daily")?></option>
            <option value="Monthly" id="Monthly">Monthly Subscription £<?php echo getRate("Monthly")?></option>
        </select>
        </div>
        <div class="col-sm-6">
        <label>Set Payment Status (Currently: <?php echo $_SESSION["UpdatingUser"]["PaymentStatus"]?>)</label><br />
        <select name="paymentStatus" class="btn btn-secondary dropdown-toggle">
            <option value="Pending">Pending</option>
            <option value="Active" id="Daily">Active</option>
            <option value="Suspended" id="Monthly">Suspended</option>
        </select>
        </div>
        <?php } ?>

        </div>

        <div class="row" style="margin:20px;">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-success" value="Update Customer" name="submit" style="margin-bottom: 5px;">Update</button>
            <button type="reset " class="btn btn-danger" style="margin-bottom: 5px;">Reset</button>
            </div>
        </div>

        <div class="row" style="margin:20px;">
        <div class="col-sm-3">
            <a style="text-decoration:none;" class="btn btn-warning" href=
            <?php if ($_GET["staff"])
            {
                echo "viewStaff.php";
            }
            else{
                echo "viewCustomers.php";
            }
            ?>>Go Back</a>
        </div>
        </div>


        </form>
        </div>


    </main>
</div>


<?php
    include("footer.php");
    ?>