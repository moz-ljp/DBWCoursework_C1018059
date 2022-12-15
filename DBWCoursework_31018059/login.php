<?php
//session_start();
include("navbar.php");
include_once("PHP_functions/userLoginPHP.php");

$firstlogin = false;

if(isset($_GET["loggedIn"]))
{
    $loggedIn = $_GET["loggedIn"];
}


if(isset($_GET["username"]))
{
    $curUsername = $_GET["username"];
    $firstlogin = true;
}

if(isset($_SESSION["Customer"]))
{
    header("Location:customerManageAccount.php");
}

if(isset($_POST['submit']))
{
    $resultValues = loginUser($_POST['username'], $_POST['password'], "Customer");
    if(isset($resultValues[0]))
    {
        $_SESSION["Customer"] = $resultValues[0];
        header("Location:customerManageAccount.php");
    }
    else{
        header("Location:login.php?loggedIn=false");
    }
    
}

?>

        <div class="container pb-5">
    <main role="main" class="pb-3">
        <h2>User Login</h2><br>

        <?php if($firstlogin): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Your account has been created, <?php echo $curUsername ?>, and your username has been auto-filled for you.
            <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif; ?>
        
        <?php if(isset($loggedIn)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Either your username or password was incorrect.
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