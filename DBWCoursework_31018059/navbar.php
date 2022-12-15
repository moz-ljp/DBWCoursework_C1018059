<?php
session_start();

if(isset($_SESSION["Customer"]))
{
    if($_SESSION["Customer"][0] != null)
    {
        $_SESSION["UserType"] = "Customer";
        $username = $_SESSION["Customer"][0];
    }
    $_SESSION["username"] = $username;
}
if(isset($_SESSION["Staff"]))
{
    if($_SESSION["Staff"][4] == "Staff")
    {
        $_SESSION["UserType"] = "Staff";
        $username = $_SESSION["Staff"][0];
    }
    else if($_SESSION["Staff"][4] == "Manager")
    {
        $_SESSION["UserType"] = "Manager";
        $username = $_SESSION["Staff"][0];
    }
    $_SESSION["username"] = $username;
}



if(isset($_GET["killSession"]))
{
    session_destroy();
    header('Location: index.php'); 
}

?>


<!DOCTYPE html>

<html lang="en">

    <head>

    <title> | MiniGym |
        <?php 
        
        if(isset($username))
        {
            echo $username;
        }

        ?>
    </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


    </head>

    <body>

    
        <header>
    
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" class="smallspace" href="index.php" style="margin-left:40%;">MiniGyms</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="index.php">Home <span class="sr-only"></span></a>
                    <?php if(!isset($_SESSION["username"])){ ?><a class="nav-item nav-link" href="customercreate.php">Join</a><?php ;}?>
                    <?php if(!(isset($_SESSION["username"]))){ ?><a class="nav-item nav-link" href="login.php">Login</a><?php ;}?>  
                    <?php if(!(isset($_SESSION["username"]))){ ?><a class="nav-item nav-link" href="staffLogin.php">Staff Login</a><?php ;}?>
                    <?php if(isset($_SESSION["username"]) and isset($_SESSION["Customer"])){ ?><a class="nav-item nav-link" href="customerManageAccount.php">Manage Account</a><?php ;}?>
                    <?php if(isset($_SESSION["Staff"]))
                    {
                        if($_SESSION["Staff"]["Role"] == "Manager"){ ?><a class="nav-item nav-link" href="viewStaff.php">Manage Staff</a><?php ;}
                        else if($_SESSION["Staff"]["Role"] == "Staff") {?><a class="nav-item nav-link" href="viewCustomers.php">Manage Customers</a><?php ;}
                        
                    }?>
                    <?php if(isset($_SESSION["Staff"])) {?><a class="nav-item nav-link" href="adjustMembershipPrices.php">Adjust Prices</a><?php ;} ?>
                    <?php if(isset($_SESSION["username"])){ ?><a class="nav-item nav-link" href="?killSession">Log Out</a><?php ;}?>
                </div>
            </div>
        </nav>
        </row>

        </header>

    </body>

</html>