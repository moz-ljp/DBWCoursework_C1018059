<?php
include("navbar.php");
include_once("PHP_functions/getAllCustomersPHP.php");

$customer = getAllCustomers();

if(isset($_GET["deleted"]))
{
    $deleted = $_GET["deleted"];
}

if(isset($_SESSION["Staff"]))
{
    if($_SESSION["Staff"]["Role"] != "Staff")
    {
        header("Location: viewStaff.php?notPermitted=true");
    }
}
else
{
    header("Location: staffLogin.php");
}

if(isset($_POST['submit']))
{
    $firstname = "";
    $lastname = "";
    $username = "";
    if(isset($_POST['FirstName']))
    {
        $firstname = $_POST['FirstName'];
    }
    if(isset($_POST['LastName']))
    {
        $lastname = $_POST['LastName'];
    }
    if(isset($_POST['Username']))
    {
        $username = $_POST['Username'];
    }

    

    for($i=0; $i<count($customer);$i++)
    {
        $added = false;
        if(isset($username) and !$added)
        {
            if($username == $customer[$i]['UserName'])
            {
                $resultArray[] = $customer[$i];
                $added = true;
            }
        }
        if(isset($firstname) and !$added)
        {
            if($firstname == $customer[$i]['firstName'])
            {
                $resultArray[] = $customer[$i];
                $added = true;
            }
        }
        if(isset($lastname) and !$added)
        {
            if($lastname == $customer[$i]['lastName'])
            {
                $resultArray[] = $customer[$i];
                $added = true;
            }
        }
    }


    if(isset($resultArray))
    {
        $customer = $resultArray;
    }

}


?>

<div class="container pb-5">
    <main role="main" class="pb-3">
        <h2>Manage Customers</h2><br>

        <form method="post">
        <div class="row" style="margin-bottom:20px;">
            <div class="col-sm-3">
                <label>First Name</label><br />
                <input type="text" name="FirstName">
            </div>
            <div class="col-sm-3">
                <label>Last Name</label><br />
                <input type="text" name="LastName">
            </div>
            <div class="col-sm-3">
                <label>Username</label><br />
                <input type="text" name="Username">
            </div>
            
        </div>

        <div class="row" style="margin-bottom:20px;">
            <div class="col-sm-1"><button class="btn btn-success" type="submit" name="submit">Search</button></div>
            <div class="col-sm-2"><a class="btn btn-warning" href="viewCustomers.php?notPermitted=false">Reset Filters</a></div>
            <div class="col-sm-3"><a class="btn btn-success" href="customercreate.php?staffCreating=true">Create new customer</a></div>
        </div>
        </form>

        <?php if(isset($deleted)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            User has been deleted.
            <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif; ?>

        <?php if(isset($_GET["created"])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            User has been created
            <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif; ?>
        
        <div class="col-12">
            <table class="table table-striped">
                <thead class="table-dark">
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </thead>

            <?php
                for($i=0; $i<count($customer);$i++){ if(isset($customer[$i])){
            ?>

                <tr>
                    <td style="font-size:20px;"><?php echo $customer[$i]['firstName']?></td>
                    <td style="font-size:20px;"><?php echo $customer[$i]['lastName']?></td>
                    <td style="font-size:20px;"><?php echo $customer[$i]['UserName']?></td>
                    <td>
                    <a class="btn btn-success" href="updateUser.php?staff=0&username=<?php echo $customer[$i]['UserName'];?>">Update</a>
                    |
                    <a class="btn btn-danger" href="deleteUser.php?username=<?php echo $customer[$i]['UserName'];?>&source=customer">Delete</a>
                    </td>
                </tr>
            <?php }}?>
                </table>


    </main>
</div>


<?php
    include("footer.php");
    ?>