<?php
//session_start();
include("navbar.php");
include_once("PHP_functions/userLoginPHP.php");
include_once("PHP_functions/destroySessionPHP.php");

if(isset($_GET["loggedIn"]))
{
    $loggedIn = $_GET["loggedIn"];
}


if(isset($_SESSION["Customer"]))
{
    header("Location:customerManageAccount.php");
}

if(isset($_POST['submit']))
{
    $resultValues = loginUser($_POST['username'], $_POST['password'], "Staff");
    if(isset($resultValues[0]))
    {
        //destroySession();
        $_SESSION["Staff"] = $resultValues[0];
        if($_SESSION["Staff"]["Enabled"] == "true")
        {
            if($_SESSION["Staff"]["Role"] == "Staff")
            {
                header("Location:viewCustomers.php?");
            }
            else if($_SESSION["Staff"]["Role"] == "Manager")
            {
                header("Location:viewStaff.php?");
            }
        }
        else
        {
            header("Location:staffLogin.php?accountDisabled=true");
        }
        
        
    }
    else{
        header("Location:staffLogin.php?loggedIn=false");
    }
    
}

?>

        <div class="container pb-5">
    <main role="main" class="pb-3">
        <h2>Staff Login</h2><br>
        
        <?php if(isset($loggedIn)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Either your username or password was incorrect.
            <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif; ?>

        <?php if(isset($_GET["accountDisabled"])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Sorry, but your account has been disabled. Please contact your Manager.
            <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif; ?>

        <row>
            <div class="col-sm-12 signupbox">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <div class="row" style="margin:20px;">
            <div class="col-sm-6">
                <label>Username</label>
                <input type="text" class="form-control" placeholder="Jogs12" name="username" value=<?php if(isset($curUsername)){echo $curUsername;} ?>>
            </div>
            <div class="col-sm-6">
            <label>Password</label>
                <input type="password" placeholder="Password" class="form-control" name="password">
            </div>
        </div>

        <div class="row" style="margin:20px;">
            <div class="col-sm-6">
            <a href="forgotpass.php">I Forgot My Password</a>
            </div>
            <div class="col-sm-6">
            <a href="forgotUsername.php">I Forgot My Username</a>
            </div>
        </div>
        

        <div class="row" style="margin:20px;">
        <div class="col-sm-3">
            <button type="submit" name="submit" class="btn btn-success" style="margin-bottom: 5px;">Log In</button>
            <button type="reset " class="btn btn-danger" style="margin-bottom: 5px;">Reset</button>
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