<?php 
$roleid = $_SESSION['roleid'];

if($roleid == '1')
{
    include "adminheader.php";
}

elseif(isset($_GET['msg']))
{
    $msg = $_GET['msg'];
}

?>

    <!-- Modal-1 Start, Add Product Page -->

    <div class="modal fade" id="myModal1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <p class="text-danger"><?php if(!empty($msg)) echo $msg; ?></p>
                    <h3 class="modal-title text-white">NEW PRODUCT ENTRY</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="db.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body text-primary">
                        <div class="row col-sm-12 form-group">
                            <label class="col-sm-4 col-form-label">PRODUCT IMAGE</label>
                            <input type="file" name="pimg" class="col-sm-8 form-control">
                        </div>
                        <div class="row col-sm-12 form-group">
                            <label class="col-sm-4 col-form-label">PRODUCT NAME</label>
                            <input type="text" name="pnm" class="col-sm-8 form-control">
                        </div>
                        <div class="row col-sm-12 form-group">
                            <label class="col-sm-4 col-form-label">PRODUCT TYPE</label>
                            <input type="text" name="ptp" class="col-sm-8 form-control">
                        </div>
                        <div class="row col-sm-12 form-group">
                            <label class="col-sm-4 col-form-label">PRODUCT CATEGORY</label>
                            <input type="text" name="pcat" class="col-sm-8 form-control">
                        </div>
                        <div class="row col-sm-12 form-group">
                            <label class="col-sm-4 col-form-label">PRODUCT BRAND</label>
                            <input type="text" name="pbrd" class="col-sm-8 form-control">
                        </div>
                        <div class="row col-sm-12 form-group">
                            <label class="col-sm-4 col-form-label">PRODUCT PRICE</label>
                            <input type="number" name="pp" class="col-sm-8 form-control">
                        </div>
                        <div class="row col-sm-12 form-group">
                            <label class="col-sm-4 col-form-label">PRODUCT QUANTITY</label>
                            <input type="number" name="pq" class="col-sm-8 form-control">
                        </div>
                        <div class="row col-sm-12 form-group">
                            <label class="col-sm-4 col-form-label">PRODUCT DESCRIPTION</label>
                            <input type="text" name="pdes" class="col-sm-8 form-control">
                        </div>
                    </div>
                    <div class="modal-footer flex-start">
                        <input type="submit" value="SAVE PRODUCT" name="addproduct" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal-1 End, Add Product Page -->

    <div class="col-sm-10">
        <div class="row">
            <h5 class="text-muted my-3">Manage Products</h5>
            <hr>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header">
                        Total Products
                    </div>
                    <div class="card-body">
                        <?php 
                        $tp = 0;
                        $sql = "SELECT * FROM products";
                        $res = mysqli_query($con, $sql);
                        foreach($res as $row)
                        {
                            $tp += 1;
                            if($row['new_old'] == 'new')
                            {
                                $n3 += 1;
                            }
                        }
                        ?>
                        <h1 class="card-title"><?php echo $tp; ?></h1>
                        <a href="db.php?allproducts" class="btn btn-primary">Go to Total Products <span class="badge badge-light"><?php if(!empty($n3)) echo $n3; ?></span></a>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header">
                        Verified Products
                    </div>
                    <div class="card-body">
                        <?php 
                        $vp = 0;
                        $sql = "SELECT * FROM products WHERE is_verified = '1'";
                        $res = mysqli_query($con, $sql);
                        foreach($res as $row)
                        {
                            $vp += 1;
                        }
                        ?>
                        <h1 class="card-title"><?php echo $vp; ?></h1>
                        <a href="db.php?vp" class="btn btn-primary">Go to Verified Products</a>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header">
                        Non-Verified Products
                    </div>
                    <div class="card-body">
                        <?php 
                        $nvp = 0;
                        $sql = "SELECT * FROM products WHERE is_verified = '0'";
                        $res = mysqli_query($con, $sql);
                        foreach($res as $row)
                        {
                            $nvp += 1;
                        }
                        ?>
                        <h1 class="card-title"><?php echo $nvp; ?></h1>
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
                        <a href="db.php?nvp" class="btn btn-primary">Go to Non-Verified Products <span class="badge badge-light"><?php if(!empty($n1)) echo $n1; ?></span></a>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header">
                        Suspended Products
                    </div>
                    <div class="card-body">
                        <?php 
                        $sp = 0;
                        $sql = "SELECT * FROM products WHERE is_verified = '2'";
                        $res = mysqli_query($con, $sql);
                        foreach($res as $row)
                        {
                            $sp += 1;
                        }
                        ?>
                        <h1 class="card-title"><?php echo $sp; ?></h1>
                        <a href="db.php?sp" class="btn btn-primary">Go to Suspended Products</a>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h5 class="text-muted my-3">Manage Users</h5>
            <hr>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header">
                        Total Users
                    </div>
                    <div class="card-body">
                        <?php 
                        $tu = 0;
                        $sql = "SELECT * FROM users WHERE roleid = '3'";
                        $res = mysqli_query($con, $sql);
                        foreach($res as $row)
                        {
                            $tu += 1;
                            if($row['new_old'] == 'new')
                            {
                                $n4 += 1;
                            }
                        }
                        ?>
                        <h1 class="card-title"><?php echo $tu; ?></h1>
                        <a href="db.php?allusers" class="btn btn-primary">Go to Total Users <span class="badge badge-light"><?php if(!empty($n4)) echo $n4; ?></span></a>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header">
                        Verified Users
                    </div>
                    <div class="card-body">
                        <?php 
                        $vu = 0;
                        $sql = "SELECT * FROM users WHERE roleid = '3' and is_verified = '1'";
                        $res = mysqli_query($con, $sql);
                        foreach($res as $row)
                        {
                            $vu += 1;
                        }
                        ?>
                        <h1 class="card-title"><?php echo $vu; ?></h1>
                        <a href="db.php?vu" class="btn btn-primary">Go to Verified Users</a>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header">
                        Non-Verified Users
                    </div>
                    <div class="card-body">
                        <?php 
                        $nvu = 0;
                        $sql = "SELECT * FROM users WHERE roleid = '3' and is_verified = '0'";
                        $res = mysqli_query($con, $sql);
                        foreach($res as $row)
                        {
                            $nvu += 1;
                        }
                        ?>
                        <h1 class="card-title"><?php echo $nvu; ?></h1>
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
                        <a href="db.php?nvu" class="btn btn-primary">Go to Non-Verified Users <span class="badge badge-light"><?php if(!empty($n2)) echo $n2; ?></span></a>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h5 class="text-muted my-3">Manage Vendors</h5>
            <hr>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header">
                        Total Vendors
                    </div>
                    <div class="card-body">
                        <?php 
                        $tm = 0;
                        $sql = "SELECT * FROM users WHERE roleid = '2'";
                        $res = mysqli_query($con, $sql);
                        foreach($res as $row)
                        {
                            $tm += 1;
                        }
                        ?>
                        <h1 class="card-title"><?php echo $tm; ?></h1>
                        <a href="db.php?allmanagers" class="btn btn-primary">Go to Total Vendors</a>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header">
                        Verified Vendors
                    </div>
                    <div class="card-body">
                        <?php 
                        $vm = 0;
                        $sql = "SELECT * FROM users WHERE roleid = '2' and is_verified = '1'";
                        $res = mysqli_query($con, $sql);
                        foreach($res as $row)
                        {
                            $vm += 1;
                        }
                        ?>
                        <h1 class="card-title"><?php echo $vm; ?></h1>
                        <a href="db.php?vm" class="btn btn-primary">Go to Verified Vendors</a>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header">
                        Suspended Vendors
                    </div>
                    <div class="card-body">
                        <?php 
                        $sm = 0;
                        $sql = "SELECT * FROM users WHERE roleid = '2' and is_verified = '2'";
                        $res = mysqli_query($con, $sql);
                        foreach($res as $row)
                        {
                            $sm += 1;
                        }
                        ?>
                        <h1 class="card-title"><?php echo $sm; ?></h1>
                        <a href="db.php?sm" class="btn btn-primary">Go to Suspended Vendors</a>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal-4 Start, Add New Vendor -->

<div class="modal fade" id="newvender">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="newvender">ADD NEW VENDOR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body text-primary">
                <!-- <div class="row">
                    <div class="col-sm-12"> -->
                        <form action="db.php" method="post">
                            <div class="row form-group">
                                <label class="col-sm-4 col-form-label">NAME</label>
                                <input type="text" name="nm1" class="col-sm-8 form-control" required>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-4 col-form-label">MOBILE</label>
                                <input type="tel" name="mb1" class="col-sm-8 form-control" required>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-4 col-form-label">EMAIL</label>
                                <input type="email" name="eml1" class="col-sm-8 form-control" required>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-4 col-form-label">PASSWORD</label>
                                <input type="password" name="pwd1" class="col-sm-8 form-control" required>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-4 col-form-label">ADDRESS</label>
                                <textarea name="adr1" cols="30" rows="4" class="col-sm-8 form-control" required></textarea>
                            </div>
                            <div class="card-footer text-center">
                                <input type="submit" value="ADD PROFILE" name="addvender" class="btn btn-primary">
                            </div>
                        </form>
                    <!-- </div> -->
                    <!-- <div class="col-sm-4 ">
                        <form action="db.php" method="post" enctype="multipart/form-data">
                            <img src="" alt="Profile-Photo" class="img-fluid mb-4" height="200" width="200">
                            <input type="file" name="img" class="col-sm-12 form-control" required>
                            <div class="card-footer text-center">
                                <input type="submit" value="ADD PROFILE PHOTO" name="addvenderphoto" class="btn btn-primary">
                            </div>
                        </form>
                    </div> -->
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>

<!-- Modal-4 End, Add New Vendor -->

<?php 
include "footer.php";
?>