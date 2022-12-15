<?php
//session_start();
include("navbar.php");
include_once("PHP_functions/cancelMembershipPHP.php");

$username = $_SESSION["Customer"][0];

if(isset($_POST['submit']))
{
    $cancelled = cancelMembership();
    header('Location: customerManageAccount.php?updated=true'); 
}

?>

<div class="container pb-5">
    <main role="main" class="pb-3">
        <h2>Cancel your membership</h2><br>
        
        <div class="col-sm-12 signupbox">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <div class="row" style="margin:20px;">
            <div class="col-sm-6">
                <label>Username</label>
                <input type="text" class="form-control" placeholder="Jogs12" name="username" disabled value="<?php echo $_SESSION["Customer"][0] ?>">
            </div>
            <div class="col-sm-6">
                <br/>
                Click submit to cancel your membership.
            </div>
        </div>
        

        <div class="row" style="margin:20px;">
        <div class="col-sm-3">
            <button type="submit" name="submit" class="btn btn-success" style="margin-bottom: 5px;">Submit</button>
            <button class="btn btn-danger" style="margin-bottom: 5px;" href="customerManageAccount.php">Cancel</button>
            </div>
        </div>


        </form>


    </main>
</div>


<?php
    include("footer.php");
    ?>