<?php
include("navbar.php");
include_once("PHP_functions/staffCreatePHP.php");
include_once("PHP_functions/validatePasswordPHP.php");
include_once("PHP_functions/hashPasswordPHP.php");

//make a username

$errorfname = $errorlname = $errordob = $erroremail = $errorpostcode = $errorpassword  = "";
$allfields = true;
$created = false;

if(isset($_POST['submit']) and $_SESSION["Staff"]["Role"] == "Manager")
{

    if($_POST['firstname'] == null)
    {
        $errorfname = "First name is mandatory";
        $allfields = false;
    }
    if($_POST['surname'] == null)
    {
        $errorlname = "Last name is mandatory";
        $allfields = false;
    }
    if($_POST['email'] == null)
    {
        $erroremail = "Email is mandatory";
        $allfields = false;
    }
    if($_POST['password'] == null)
    {
        $errorpassword = "Password is mandatory";
        $allfields = false;
    }


    if($allfields == true)
    {
        $firstname = $_POST['firstname'];
        $firstnameusername = substr($firstname, 0, 3);
        $surname = $_POST['surname'];
        $surnameusername = substr($surname, -2);
        $numbers = rand(10,99);
        $username = $firstnameusername.$surnameusername.$numbers;
        //echo $username;
        if(validatePassword($_POST['password']))
        {
            $hashedPass = hashPass($_POST['password']);
            $createUser = createUser($username, $hashedPass);
            //echo "User successfully created";
            $created = true;
            if($createUser)
            {
                header('Location: viewStaff.php?created=true'); 
                
            }
        }
        else{
            echo "Password failed validation";
        }
        
    }
    
}

/*
if(isset($_POST['submit']))
{
    $createUser = createUser($username);
    echo "User successfully created";
}
*/

?>

<div class="container pb-5">
    <main role="main" class="pb-3">
    <h2>Create Staff Member</h2>
        

        <row>
            <div class="col-sm-12 signupbox">
        <form method="post">
        <div class="row" style="margin:20px;">
            <div class="col-sm-6">
                <label>First Name</label>
                <input type="text" class="form-control" placeholder="Forename" name="firstname">
                <span class="text-danger"><?php echo $errorfname;?></span>
            </div>
            <div class="col-sm-6">
            <label>Surname</label>
                <input type="text" placeholder="Surname" class="form-control" name="surname">
                <span class="text-danger"><?php echo $errorlname;?></span>
            </div>
        </div>
        <div class="row" style="margin:20px;">
        <div class="col-sm-6">
        <label>Email Address</label>
                <input type="email" placeholder="you@something.com" class="form-control" name="email">
                <span class="text-danger"><?php echo $erroremail;?></span>
                
            </div>
            <div class="col-sm-6">
            <label>Password</label>
                <input type="password" placeholder="" class="form-control" name="password">
                <span class="text-danger"><?php echo $errorpassword;?></span>
            </div>
        </div>

        <div class="row" style="margin:20px;">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-success" value="Create Customer" name="submit" style="margin-bottom: 5px;">Sign Up</button>
            <button type="reset " class="btn btn-danger" style="margin-bottom: 5px;">Reset</button>
            </div>
        </div>

        <div class="col-sm-3">
            <label name="username" style="margin:20px;"><?php 
            if($created){echo ("Welcome to MiniGyms, your username is: ".$username);}
            ?></label>
            </div>
        </div>

        </form>
        </div>
        </row>


    </main>


<?php
    include("footer.php");
    ?>