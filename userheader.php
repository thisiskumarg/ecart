<?php 
$roleid = $_SESSION['roleid'];
$uid = $_SESSION['uid'];

if($roleid == '3')
{
    $sql = "SELECT * FROM users WHERE roleid = '$roleid' and uid = '$uid'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($res);
    $user = $row['uname'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/dist/js/bootstrap.bundle.min.js">
    <!-- <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button 
        {
            -webkit-appearance: none;
            margin: 0;
        }
    </style> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <a href="db.php?index" class="navbar-brand"><img src="images/online-shopping-logo.jpg" alt="" class="img-fluid pl-3" style="height: 50px; width: 180px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active px-4 py-2">
                    <a class="nav-link font-weight-bold py-2" href="db.php?index">HOME</a>
                </li>
                <!-- <li class="nav-item active px-4 py-2">
                    <div class="dropdown">
                        <a class="nav-link font-weight-bold text-white dropdown-toggle" href="#" role="button" id="dropdownCategories" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            TYPE
                        </a>
                        <div class="dropdown-menu bg-primary pl-2" style="width: 220px; border: none;" aria-labelledby="dropdownCategories">
                            <a class="nav-link font-weight-bold py-2" href="#">MEN</a><hr style="margin: 0;">
                            <a class="nav-link font-weight-bold py-2" href="#">WOMEN</a><hr style="margin: 0;">
                            <a class="nav-link font-weight-bold py-2" href="#">KIDS</a><hr style="margin: 0;">
                            <a class="nav-link font-weight-bold py-2" href="#">ELECTRONIC GADGETS</a><hr style="margin: 0;">
                            <a class="nav-link font-weight-bold py-2" href="#">HOME APPLIANCE</a>
                        </div>
                    </div>
                </li> -->
                <li class="nav-item active px-4 py-2">
                    <div class="dropdown">
                        <a class="nav-link font-weight-bold text-white dropdown-toggle text-uppercase" href="#" role="button" id="dropdownDashboard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hello, <?php if(!empty($user)) echo $user; ?>
                        </a>
                        <div class="dropdown-menu bg-primary pl-2" style="width: 220px; border: none;" aria-labelledby="dropdownDashboard">
                            <a class="nav-link font-weight-bold py-2" href="db.php?profile">PROFILE</a><hr style="margin: 0;">
                            <a class="nav-link font-weight-bold py-2" href="db.php?orderform">MY ORDERS</a><hr style="margin: 0;">
                            <a class="nav-link font-weight-bold py-2" href="db.php?addtocartform">MY CART</a><hr style="margin: 0;">
                            <a class="nav-link font-weight-bold py-2" href="db.php?reviewform">MY REVIEWS</a>
                            <!-- <?php 
                            // $n = 0;
                            // $sql = "SELECT u_new_old FROM logs";
                            // $res = mysqli_query($con, $sql);
                            // foreach($res as $row)
                            // {
                            //     if($row['u_new_old'] == 'new')
                            //     {
                            //         $n += 1;
                            //     }
                            // }
                            ?>
                            <a class="nav-link font-weight-bold py-2" href="db.php?nform">
                            NOTIFICATIONS <span class="badge badge-light text-primary"><?php //if(!empty($n)) echo $n; ?></a> -->
                        </div>
                    </div>
                </li>
                <li class="nav-item active px-4 py-2">
                    <a class="nav-link font-weight-bold" href="db.php?logout">LOGOUT <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
