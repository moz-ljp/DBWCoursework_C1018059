<?php
include("navbar.php");
include_once("PHP_functions/getMembershipRatePHP.php");



if(isset($_POST["submit"]))
{
    $dailyPrice = $_POST["dailyprice"];
    $monthlyPrice = $_POST["monthlyprice"];

    $membershipType = "Daily";

    $dailyUpdated = false;
    $monthlyUpdated = false;

    $db = new SQLite3('C:\\xampp\\courseworkDB\\Coursework.db');
    $sql = 'UPDATE MembershipRates SET Rate=:rate WHERE MembershipType = :membershipType';
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':rate', $dailyPrice, SQLITE3_TEXT);
    $stmt->bindParam(':membershipType', $membershipType, SQLITE3_TEXT);

    $result = $stmt->execute();
    if($stmt)
    {
        $dailyUpdated = true;
    }

    $membershipType = "Monthly";

    $stmt->bindParam(':rate', $monthlyPrice, SQLITE3_TEXT);
    $stmt->bindParam(':membershipType', $membershipType, SQLITE3_TEXT);

    $result = $stmt->execute();

    if($stmt)
    {
        $monthlyUpdated=true;
    }

    if($dailyUpdated and $monthlyUpdated)
    {
        header("Location: adjustMembershipPrices.php?updated=true");
    }

}

?>

<div class="container pb-5">
    <main role="main" class="pb-3">
        <h2>Adjust Membership Prices</h2><br>

        <?php if(isset($_GET['updated'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Membership rates have been updated.
            <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-sm-12 signupbox">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="row" style="margin:20px;">
                    <div class="col-sm-6">
                        <label>Daily Price</label>
                        <input type="text" class="form-control" placeholder="Currently: <?php echo getRate("Daily") ?>" value="<?php echo getRate("Daily") ?>" name="dailyprice">
                    </div>
                    <div class="col-sm-6">
                        <label>Monthly Price</label>
                        <input type="text" class="form-control" placeholder="Currently: <?php echo getRate("Monthly") ?>" value="<?php echo getRate("Monthly") ?>" name="monthlyprice">
                    </div>
                </div>
                

                <div class="row" style="margin:20px;">
                <div class="col-sm-3">
                    <button type="submit" name="submit" class="btn btn-success" style="margin-bottom: 5px;">Submit</button>
                    </div>
                </div>


                </form>
            </div>
        </div>


    </main>
</div>


<?php
    include("footer.php");
    ?>