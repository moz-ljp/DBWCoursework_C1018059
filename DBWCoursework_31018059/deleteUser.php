<?php
include("navbar.php");
include_once("PHP_functions/deleteCustomerPHP.php");
$username = $_GET["username"];

$source = $_GET["source"];

if(isset($_POST["cancel"]))
{
    header("Location:viewCustomers.php");
}

if(isset($_POST["submit"]))
{
    $result = deleteCustomer($username, $source);
    if($result)
    {
        header("Location:viewCustomers.php?deleted=true");
    }
}

?>

<div class="container pb-5">
    <main role="main" class="pb-3">
        <h2>Delete user : <?php echo $username ?></h2><br>
        
        <div class="row">
            <div class="col-sm-12 signupbox">
        <form method="post">
        <div class="row" style="margin:20px;">
            <div class="col-sm-6">
                <p>Are you sure you want to delete <?php echo $username ?>?</p>
                <p>All of their details will be removed from the database.</p>
            </div>
</div>
        

        <div class="row" style="margin:20px;">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-danger" name="submit" style="margin-bottom: 5px;">Delete</button>
            <button class="btn btn-warning" name="cancel" style="margin-bottom:5px;">Cancel</button>
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