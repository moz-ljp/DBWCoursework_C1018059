
<?php
include("navbar.php");
include_once("PHP_functions/getMembershipRatePHP.php");
include_once("PHP_functions/getMembershipTypePHP.php");

?>

<div class="container pb-5">
    <main role="main" class="pb-3">
        <h2><center>Welcome to MiniGyms<?php if (isset($_SESSION["username"])){ 
            if(isset($_SESSION["Customer"]))
            {
                echo ": ".$_SESSION["Customer"][1];
            }
            else{
                echo ": ".$_SESSION["Staff"][1];
            }
            ;} ?></center></h2>

        <?php if(!(isset($_SESSION["username"])))
        { ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card mb-3">
                    <!--<img class="card-img-top" src="images/gymstocktwo.png" alt="Gym Image" >-->
                    <video style="margin-left:10%; margin-top:10px;" width="1080" height="520" autoplay="true" muted loop>
                        <source src="videos/video.mp4" type="video/mp4">
                    </video>
                    <div class="card-body">
                        <h5 class="card-title">About Us</h5>
                        <p class="card-text">MiniGyms is a new, for the user collective of people who want to improve their health
                            and support others.
                        </p>
                        <p class="card-text"><small class="text-muted">-MiniGyms CEO</small></p>
                    </div>
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <a style="margin-left:45%; margin-bottom:15%;" href=#talk style="text-decoration:none; margin-bottom:20%;" class="btn btn-success">Lets Go<br/>▼</a>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                        <img class="card-img-top" src="images/gymstocktwo.png" alt="Gym Image" >
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="row" style="margin-top:20px;">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Day Passes</h5>
                            <p class="card-text">Visit us for the day for just <b>£<?php echo getRate("Daily")?></b> and get familiar with the gym.</p>
                            <a href="customercreate.php" class="btn btn-primary">Get Started</a>
                        </div>
                    </div>
                </div>
            <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Monthly Contract</h5>
                    <p class="card-text">Dedicate yourself to your body, just <b>£<?php echo getRate("Monthly")?></b> a month!</p>
                    <a href="customercreate.php" class="btn btn-primary">Get Started</a>
                </div>
            </div>
            </div>

            <div class="row" style="margin-top:20px;">

                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Start Working</h5>
                            <p class="card-text">Join us to build up to a better version of yourself.</p>
                            <ul>
                                <li>Calorie and intake tracking using our partner app.</li>
                                <li>Automatic attendance tracking when you use the app on entry.</li>
                                <li>Frequent classes, included in your base monthly membership.</li>
                                <li>On site, high protein, low fat food available in our one stop protein shop.</li>
                            </ul>
                            <a href="findGym.php" class="btn btn-primary">Find our gym</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row" style="margin-top:10%;">
                    <div id="talk">

                    </div>
            </div>

        <?php } else if(isset($_SESSION["username"])){?>


            <div class="row">
            <div class="col-sm-12">
                <div class="card mb-3">
                <img class="card-img-top" src="images/gymstocktwo.png" alt="Gym Image" >
                <div class="card-body">
                    <h5 class="card-title">Thank you for being a member of the MiniGym</h5>
                    <p class="card-text">
                    </p>
                    <p class="card-text"><small class="text-muted">-MiniGyms CEO</small></p>
                </div>
            </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Current Gym Traffic</h5>
                        <p class="card-text">People in the gym: <b><?php echo(rand(0,100))?></b></p>
                        <a href="findGym.php" class="btn btn-primary">Find our gym</a>
                    </div>
                </div>
            </div>
        <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Your contract</h5>
                <p class="card-text">
                    <?php 
                    if($_SESSION["UserType"] == "Customer")
                    {
                        $membershipType = getMembership($_SESSION["username"]);
                        if($membershipType == "NA")
                        { ?>
                            <h5 class="card-title">No contract</h5>
                            <p class="card-text">You've signed up! Now lets get started. Only <b>£<?php echo getRate("Monthly")?></b> a month!</p>
                            <a href="customerManageAccount.php" class="btn btn-primary">Get Started</a>
                        <?php }
                        else
                        { 
                            if($membershipType == "Daily")
                            {
                                echo "A daily contract... one day at a time!";
                            }
                            else if($membershipType == "Monthly"){
                                echo "A monthly contact! Way to commit!";   
                            }
                            else{
                                echo "Congratulations on taking advantage of one of our promotional memberships!";
                            }
                        }
                    }
                    else{
                        echo "You are a staff member!";
                    }
                    ?>
                    

                </p>
                
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card" style="margin-top:20px;">
                    <div class="card-body">
                        <h5 class="card-title">Manage your account</h5>
                        <p class="card-text"> 
                        <a href="customerManageAccount.php" class="btn btn-primary">Manage Account</a>
                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>
       
        </div>

            
</div>

    </main>
</div>

<?php
    include("footer.php");
    ?>