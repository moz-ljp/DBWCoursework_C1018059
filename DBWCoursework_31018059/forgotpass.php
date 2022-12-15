<?php
include("navbar.php");
include_once("PHP_functions/validateUserDetails.php");

//This page allows the user to reset their password if and only if all of the values provided match the ones receieved from the database.

$valuesValidated = false;
$submitted = false;

if(isset($_POST['submit']))
{
    $submitted = true;
    $valuesValidated = retrieveUser($_POST['Username'], $_POST['postcode'], $_POST['DOB'], $_POST['email']);
    if($valuesValidated == true)
    {
        //echo "validated";
        
        header("Location:setNewPass.php?username=".$_POST['Username']);
    }


}

?>

        
        <div class="container pb-5">
    <main role="main" class="pb-3">
        <h2>Reset Password</h2><br>

        <row>
            <div class="col-sm-12 signupbox">
        <form method="post">
        <div class="row" style="margin:20px;">
            <div class="col-sm-6">
                <label>Username</label>
                <input type="text" class="form-control" placeholder="Jogs12" name="Username">
            </div>
            <div class="col-sm-6">
            <label>Postcode</label>
                <input type="text" placeholder="Postcode" class="form-control" name="postcode">
            </div>
        </div>
        <div class="row" style="margin:20px;">
        <div class="col-sm-6">
                <label>Date of Birth</label>
                <input type="date" class="form-control" name="DOB"> <!-- Does this need to be month? Or can it just be the whole DOB?? Seems pointless to make it the month-->
            </div>
            <div class="col-sm-6">
            <label>Email Address</label>
                <input type="email" placeholder="you@something.com" class="form-control" name="email">
            </div>
        </div>

        <div class="row" style="margin:20px;">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-success" name="submit" style="margin-bottom: 5px;">Check Details</button>
            <button type="reset " class="btn btn-danger" style="margin-bottom: 5px;">Reset</button>
            </div>
        </div>

        <div class="col-sm-3">
            <label name="validated" style="margin:20px;"><?php 
            if(!$valuesValidated and $submitted){echo ("Sorry, some of your details were incorrect");}
            ?></label>
            </div>
        </div>

        </form>
        </div>
        </row>



    </main>
</div>


<?php
    include("footer.php");
    ?>