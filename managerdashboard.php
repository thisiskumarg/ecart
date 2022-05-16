<?php 
$roleid = $_SESSION['roleid'];
$uid = $_SESSION['uid'];
if($roleid == '2')
{
    include "managerheader.php";
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
                        $sql = "SELECT * FROM products WHERE uid = '$uid'";
                        $res = mysqli_query($con, $sql);
                        foreach($res as $row)
                        {
                            $tp += 1;
                        }
                        ?>
                        <h1 class="card-title"><?php echo $tp; ?></h1>
                        <a href="db.php?allproducts" class="btn btn-primary">Go to Total Products</a>
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
                        $sql = "SELECT * FROM products WHERE is_verified = '1' AND uid = '$uid'";
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
                        $sql = "SELECT * FROM products WHERE is_verified = '0' AND uid = '$uid'";
                        $res = mysqli_query($con, $sql);
                        foreach($res as $row)
                        {
                            $nvp += 1;
                        }
                        ?>
                        <h1 class="card-title"><?php echo $nvp; ?></h1>
                        <a href="db.php?nvp" class="btn btn-primary">Go to Non-Verified Products</a>
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
                        $sql = "SELECT * FROM products WHERE is_verified = '2' AND uid = '$uid'";
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
            <h5 class="text-muted my-3">Manage Notifications</h5>
            <hr>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header">
                        Total Orders
                    </div>
                    <div class="card-body">
                        <?php 
                        $to = 0;
                        $sql = "SELECT orders.oid FROM orders
                        INNER JOIN products ON orders.pid = products.pid WHERE products.uid = '$uid'";
                        $res = mysqli_query($con, $sql);
                        foreach($res as $row)
                        {
                            $to += 1;
                        }
                        ?>
                        <h1 class="card-title"><?php echo $to; ?></h1>
                        <a href="db.php?manageordersform" class="btn btn-primary">Go to Orders</a>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header">
                        Total Reviews
                    </div>
                    <div class="card-body">
                        <?php 
                        $tr = 0;
                        $sql = "SELECT reviews.rid FROM reviews
                        INNER JOIN products ON reviews.pid = products.pid WHERE products.uid = '$uid'";
                        $res = mysqli_query($con, $sql);
                        foreach($res as $row)
                        {
                            $tr += 1;
                        }
                        ?>
                        <h1 class="card-title"><?php echo $tr; ?></h1>
                        <a href="db.php?managereviewsform" class="btn btn-primary">Go to Reviews</a>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h5 class="text-muted my-3">Manage Revenue</h5>
            <hr>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header">
                        Total Product Worth
                    </div>
                    <div class="card-body">
                        <?php 
                        $tpw = 0;
                        $sql = "SELECT pprice FROM products WHERE uid = '$uid'";
                        $res = mysqli_query($con, $sql);
                        foreach($res as $row)
                        {
                            $tpw += $row['pprice'];
                        }
                        ?>
                        <h1 class="card-title"><?php echo $tpw; ?></h1>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header">
                        Total Revenue
                    </div>
                    <div class="card-body">
                        <?php 
                        $tr = 0;
                        $sql = "SELECT orders.ovalue FROM orders
                        INNER JOIN products ON orders.pid = products.pid 
                        INNER JOIN users ON products.uid = users.uid WHERE users.uid = '$uid'";
                        $res = mysqli_query($con, $sql);
                        foreach($res as $row)
                        {
                            $tr += $row['ovalue'];
                        }
                        ?>
                        <h1 class="card-title"><?php echo $tr; ?></h1>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header">
                        Daily Revenue
                    </div>
                    <div class="card-body">
                        <?php 
                        $dr = 0;
                        $sql = "SELECT orders.ovalue FROM orders
                        INNER JOIN products ON orders.pid = products.pid 
                        INNER JOIN users ON products.uid = users.uid WHERE users.uid = '$uid' and 
                        orders.odate > DATE_SUB(NOW(), INTERVAL 1 DAY)";
                        $res = mysqli_query($con, $sql);
                        foreach($res as $row)
                        {
                            $dr += $row['ovalue'];
                        }
                        ?>
                        <h1 class="card-title"><?php echo $dr; ?></h1>
                        <!-- <a href="db.php?nvu" class="btn btn-primary">Go to Non-Verified Users</a> -->
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header">
                        Yearly Revenue
                    </div>
                    <div class="card-body">
                        <?php 
                        $yr = 0;
                        $sql = "SELECT orders.ovalue FROM orders
                        INNER JOIN products ON orders.pid = products.pid 
                        INNER JOIN users ON products.uid = users.uid WHERE users.uid = '$uid' and 
                        orders.odate > DATE_SUB(NOW(), INTERVAL 1 YEAR)";
                        $res = mysqli_query($con, $sql);
                        foreach($res as $row)
                        {
                            $yr += $row['ovalue'];
                        }
                        ?>
                        <h1 class="card-title"><?php echo $yr; ?></h1>
                        <!-- <a href="db.php?nvu" class="btn btn-primary">Go to Non-Verified Users</a> -->
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include "footer.php";
?>