<?php
include("navbar.php");
include_once("PHP_functions/updatePassPHP.php");
include_once("PHP_functions/validatePasswordPHP.php");

//This page allows the user to set a new password if the values were validated on the previous page.

$updatePass = false;

$username = $_GET['username'];

if(isset($_POST['submit']))
{
    if(validatePassword($_POST['password']))
    {
        $updatePass = updatePass($username, $_POST['password']);
    }
    else{
        echo "password failed validation";
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
                <input type="text" class="form-control" placeholder="Jogs12" value=<?php echo $username ?> name="Username" disabled>
            </div>

        <div class="col-sm-6">
        <label>New Password</label>
                <input type="password" class="form-control" name="password">
        </div>
        </div>

        <div class="row" style="margin:20px;">

        <div class="col-sm-3">
            <button type="submit" class="btn btn-success" name="submit" style="margin-bottom: 5px;">Update</button>
            <button type="reset " class="btn btn-danger" style="margin-bottom: 5px;">Reset</button>
            </div>
        </div>

        <div class="col-sm-3">
            <label name="updated" style="margin:20px;"><?php 
            if($updatePass){echo ("Password updated");}
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