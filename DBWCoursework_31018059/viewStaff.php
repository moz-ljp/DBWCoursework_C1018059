<?php
include("navbar.php");
include_once("PHP_functions/getAllStaffPHP.php");

$staff = getAllStaff();

if(isset($_GET["deleted"]))
{
    $deleted = $_GET["deleted"];
}

if(isset($_SESSION["Staff"]))
{
    if($_SESSION["Staff"]["Role"] != "Manager")
    {
        header("Location: viewCustomers.php?notPermitted=true");
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

    for($i=0; $i<count($staff);$i++)
    {
        $added = false;
        if(isset($username) and !$added)
        {
            if($username == $staff[$i]['UserName'])
            {
                $resultArray[] = $staff[$i];
                $added = true;
            }
        }
        if(isset($firstname) and !$added)
        {
            if($firstname == $staff[$i]['firstName'])
            {
                $resultArray[] = $staff[$i];
                $added = true;
            }
        }
        if(isset($lastname) and !$added)
        {
            if($lastname == $staff[$i]['lastName'])
            {
                $resultArray[] = $staff[$i];
                $added = true;
            }
        }
    }


    if(isset($resultArray))
    {
        $staff = $resultArray;
    }
}

?>

<div class="container pb-5">
    <main role="main" class="pb-3">
        <h2>Manage Staff</h2><br>

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
            <div class="col-sm-3"><a class="btn btn-success" href="createStaff.php">Create new Staff Member</a></div>
        </div>
        </form>

        <?php if(isset($deleted)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Staff member has been deleted.
            <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <?php endif; ?>

        <?php if(isset($_GET["created"])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Staff member has been created
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
                for($i=0; $i<count($staff);$i++):
            ?>

                <tr>
                    <td style="font-size:20px;"><?php echo $staff[$i]['firstName']?></td>
                    <td style="font-size:20px;"><?php echo $staff[$i]['lastName']?></td>
                    <td style="font-size:20px;"><?php echo $staff[$i]['UserName']?></td>
                    <td>
                    <a class="btn btn-success" href="updateUser.php?staff=1&username=<?php echo $staff[$i]['UserName'];?>">Update</a>
                    |
                    <a class="btn btn-danger" href="deleteUser.php?username=<?php echo $staff[$i]['UserName']."&source=staff";?>">Delete</a>
                    </td>
                </tr>
            <?php endfor;?>
                </table>


    </main>
</div>


<?php
    include("footer.php");
    ?>