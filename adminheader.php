<?php 
$roleid = $_SESSION['roleid'];
$uid = $_SESSION['uid'];

if($roleid == '1')
{
    $sql = "SELECT * FROM users WHERE roleid = '$roleid' and uid = '$uid'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($res);
    $admin = $row['uname'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/dist/js/bootstrap.bundle.min.js">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="col-sm-12 p-1 bg-primary">
        <div class="row col-sm-12">
            <a href="db.php?dashboard"><img src="images/online-shopping-logo.jpg" alt="" class="img-fluid pl-3 my-2" style="height: 50px; width: 180px;"></a>
            <h5 class="ml-auto"><a href="db.php?index" class="text-white text-uppercase mr-5" style="line-height: 60px; text-decoration: none">Home</a></h5>
            <h5><a href="db.php?dashboard" class="text-white text-uppercase mr-5" style="line-height: 60px; text-decoration: none">Dashboard</a></h5>
            <h4 class="text-white text-uppercase pt-3 mr-5">Hello, <?php if(!empty($admin)) echo $admin; ?></h4>
            <h5><a href="db.php?logout" class="text-white text-uppercase" style="line-height: 60px; text-decoration: none">Logout</a></h5>
        </div>
    </div>

    <?php 
    if(!empty($page) != '1')
    {
    ?>
    <div class="row col-sm-12">
        <div class="col-sm-2 mt-3">
            <div class="list-group sticky-top">
                <a href="#" class="list-group-item list-group-item-action active">Admin Dashboard</a>
                <a href="db.php?profile" class="list-group-item list-group-item-action">Profile</a>
                <div class="dropright btn-group">
                    <a href="db.php?allproducts" class="list-group-item list-group-item-action">
                        Manage Products
                    </a>
                    <a href="#" class="list-group-item text-dark dropdown-toggle dropdown-toggle-split" role="button" id="manageproducts" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <div class="dropdown-menu col-sm-12" style="border: none;" aria-labelledby="manageproducts">
                        <!-- <a class=" list-group-item list-group-item-action" href="#" data-toggle="modal" data-target="#myModal1">Add Product</a> -->
                        <a class=" list-group-item list-group-item-action" href="db.php?vp">Verified Products</a>
                        <?php 
                        $n1 = 0;
                        $sql1 = "SELECT new_old FROM products WHERE is_verified = '0'";
                        $res1 = mysqli_query($con, $sql1);
                        foreach($res1 as $row1)
                        {
                            if($row1['new_old'] == 'new')
                            {
                                $n1 += 1;
                            }
                        }
                        ?>
                        <a class=" list-group-item list-group-item-action" href="db.php?nvp">
                            Non-Verified Products <span class="badge badge-primary"><?php if(!empty($n1)) echo $n1; ?></span>
                        </a>
                        <a class=" list-group-item list-group-item-action" href="db.php?sp">Suspended Products</a>
                    </div>
                </div>
                <div class="dropright btn-group">
                    <a href="db.php?allusers" class="list-group-item list-group-item-action">
                        Manage Users
                    </a>
                    <a href="#" class="list-group-item text-dark dropdown-toggle dropdown-toggle-split" role="button" id="manageusers" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <div class="dropdown-menu col-sm-12" style="border: none;" aria-labelledby="manageusers">
                        <!-- <a href="#" class="list-group-item list-group-item-action">Add New User</a> -->
                        <a class="list-group-item list-group-item-action" href="db.php?vu">Verified Users</a>
                        <?php 
                        $n2 = 0;
                        $sql2 = "SELECT new_old FROM users WHERE is_verified = '0'";
                        $res2 = mysqli_query($con, $sql2);
                        foreach($res2 as $row2)
                        {
                            if($row2['new_old'] == 'new')
                            {
                                $n2 += 1;
                            }
                        }
                        ?>
                        <a class=" list-group-item list-group-item-action" href="db.php?nvu">
                            Non-Verified Users <span class="badge badge-primary"><?php if(!empty($n2)) echo $n2; ?></span>
                        </a>
                        <!-- <a class="list-group-item list-group-item-action" href="#">Suspended Users</a> -->
                    </div>
                </div>
                <div class="dropright btn-group">
                    <a href="db.php?allmanagers" class="list-group-item list-group-item-action">
                        Manage Vendors
                    </a>
                    <a href="#" class="list-group-item text-dark dropdown-toggle dropdown-toggle-split" role="button" id="managemanagers" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <div class="dropdown-menu col-sm-12" style="border: none;" aria-labelledby="managemanagers">
                        <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#newvender">Add New Vendor</a>
                        <a class="list-group-item list-group-item-action" href="db.php?vm">Verified Vendors</a>
                        <a class="list-group-item list-group-item-action" href="db.php?sm">Suspended Vendors</a>
                    </div>
                </div>
                <?php 
                $n3 = 0;
                $sql3 = "SELECT a_new_old FROM orders";
                $res3 = mysqli_query($con, $sql3);
                foreach($res3 as $row3)
                {
                    if($row3['a_new_old'] == 'new')
                    {
                        $n3 += 1;
                    }
                }
                ?>
                <a href="db.php?manageordersform" class="list-group-item list-group-item-action">
                    Manage Orders <span class="badge badge-primary"><?php if(!empty($n3)) echo $n3; ?></span>
                </a>
                <?php 
                $n4 = 0;
                $sql4 = "SELECT a_new_old FROM reviews";
                $res4 = mysqli_query($con, $sql4);
                foreach($res4 as $row4)
                {
                    if($row4['a_new_old'] == 'new')
                    {
                        $n4 += 1;
                    }
                }
                ?>
                <a href="db.php?managereviewsform" class="list-group-item list-group-item-action">
                    Manage Reviews <span class="badge badge-primary"><?php if(!empty($n4)) echo $n4; ?></span>
                </a>
                <?php 
                $n5 = 0;
                $sql5 = "SELECT new_old FROM logs";
                $res5 = mysqli_query($con, $sql5);
                foreach($res5 as $row5)
                {
                    if($row5['new_old'] == 'new')
                    {
                        $n5 += 1;
                    }
                }
                ?>
                <a href="db.php?nform" class="list-group-item list-group-item-action">
                    Notifications <span class="badge badge-primary"><?php if(!empty($n5)) echo $n5; ?></span>
                </a>
            </div>
        </div>
    <?php 
    }
    ?>
