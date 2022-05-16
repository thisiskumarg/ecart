<?php 
$roleid = $_SESSION['roleid'];
// $uid = $_SESSION['uid'];
if($roleid == '1')
{
    include "adminheader.php";
}
elseif($roleid == '2')
{
    include "managerheader.php";
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
        <?php 
        $o = 0;
        if($roleid == '1')
        {
            $sql = "SELECT pid FROM orders";
            $res = mysqli_query($con, $sql);
        }
        elseif($roleid == '2')
        {
            $sql = "SELECT orders.pid FROM orders 
            INNER JOIN products ON orders.pid = products.pid WHERE products.uid = '$uid'";
            $res = mysqli_query($con, $sql);
        }
        foreach($res as $row)
        {
            $o += 1;
        }
        ?>
        <h5 class="text-muted my-3">Manage Orders / Total Orders : <span class="text-danger"><?php echo $o; ?></span></h5>
    </div>
    <!-- <div class="row col-sm-12 mb-3">
        <input type="submit" value="VERIFY" name="vnvp" class="btn btn-success">
        <input type="submit" value="SUSPEND" name="snvp" class="btn btn-warning mx-2">
        <input type="submit" value="REMOVE" name="rnvp" class="btn btn-danger">
    </div> -->
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <!-- <th scope="col"><input type="checkbox" name="allcp"></th> -->
                <th scope="col">Order Id</th>
                <th scope="col">Product Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Price</th>
                <th scope="col">Order Value</th>
                <th scope="col">User Name</th>
                <th scope="col">Order Status</th>
                <th scope="col">Order Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if($roleid == '1')
            {
                $sql = "SELECT * FROM orders 
                INNER JOIN products ON orders.pid = products.pid
                INNER JOIN users ON orders.uid = users.uid
                INNER JOIN order_status ON orders.sid = order_status.sid ORDER BY orders.odate DESC";
                $res = mysqli_query($con, $sql);
            }
            elseif($roleid == '2')
            {
                $sql = "SELECT * FROM orders 
                INNER JOIN products ON orders.pid = products.pid AND products.uid = '$uid' 
                INNER JOIN users ON orders.uid = users.uid
                INNER JOIN order_status ON orders.sid = order_status.sid ORDER BY orders.odate DESC";
                $res = mysqli_query($con, $sql);
            }
            foreach($res as $row)
            {
                // $_SESSION['pstatus'] = $row['is_verified'];
            ?>
                <form action="db.php" method="post">
                    <tr class="table-hover">
                        <!-- <td><input type="checkbox" name="selectnvp[]" value="<?php //echo $row['pid']; ?>"></td> -->
                        <td><?php echo $row['oid']; ?></td>
                        <td><img src="<?php echo $row['pimage']; ?>" alt="Product_Photo" class="img-fluid" style="height: 100px;"></td>
                        <td><?php echo $row['pname']; ?></td>
                        <td><?php echo $row['pprice']; ?></td>
                        <td><?php echo $row['ovalue'] ?></td>
                        <td><?php echo $row['uname']; ?></td>
                        <td>
                            <?php 
                            if($row['ostatus'] == 'Cancelled by Admin' || $row['ostatus'] == 'Cancelled by Vendor')
                            {
                                $status = $row['ostatus'];
                                echo '<div class="text-danger">'.$status.'</div>';
                            }
                            elseif($row['is_cancelled'] == 1)
                            {
                                $status = 'Cancelled by User';
                                echo '<div class="text-danger">'.$status.'</div>';
                            }
                            else
                            {
                                if($row['ostatus'] == 'Processed')
                                {
                                    echo '<div class="text-info">'.$row['ostatus'].'</div>';
                                }
                                elseif($row['ostatus'] == 'Confirmed')
                                {
                                    echo '<div class="text-primary">'.$row['ostatus'].'</div>';
                                }
                                elseif($row['ostatus'] == 'Shipped')
                                {
                                    echo '<div class="text-warning">'.$row['ostatus'].'</div>';
                                }
                                elseif($row['ostatus'] == 'Delivered')
                                {
                                    echo '<div class="text-success">'.$row['ostatus'].'</div>';
                                }
                            }
                            ?>
                        </td>
                        <td><?php echo $row['odate']; ?></td>
                        <td>
                            <select name="amstatus" class="form-control text-info mb-1" required>
                                <option selected disabled>-Select Status-</option>
                                <option value="1">Processed</option>
                                <option value="2">Confirmed</option>
                                <option value="3">Shipped</option>
                                <option value="4">Delivered</option>
                            </select>
                            <input type="hidden" name="osno" value="<?php echo $row['order_sno']; ?>">
                            <button type="submit" name="amostatus" class="btn btn-info"><i class="bi bi-arrow-repeat"></i></button>
                            <?php 
                            if($row['sid'] != 4 && $row['sid'] != 5 && $row['sid'] != 6 && $row['is_cancelled'] != 1)
                            {
                            ?>
                                <a href="db.php?amocancel=<?php echo $row['order_sno']; ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                            <?php 
                            }
                            ?>
                        </td>
                    </tr>
                </form>
            <?php 
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal-4 Start, Add New Vender -->

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