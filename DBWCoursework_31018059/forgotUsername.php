<?php
include("navbar.php");
include_once("PHP_functions/retrieveUserByEmailAndMailPHP.php");

$emptyField = false;

if(isset($_POST['submit']))
{
    if($_POST['email'])
    {
        $email = $_POST['email'];
        $result = findUserAndMail($email);

    }
    else{
        $emptyField=true;
    }
    
}

?>

<div class="container pb-5">
    <main role="main" class="pb-3">
        <h2>Forgot username</h2><br>
        <p>Enter your email and, if you are in our system, your username will be retrieved.</p>

        <?php if($emptyField): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Please fill out the email field before submitting.
            <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif; ?>
        <?php if(isset($result)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Your username is: <?php echo($result) ?>
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
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="you@gmail.com" name="email">
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