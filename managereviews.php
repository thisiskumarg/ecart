<?php 
$roleid = $_SESSION['roleid'];
$uid = $_SESSION['uid'];
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
            $r = 0;
            if($roleid == '1')
            {
                $sql = "SELECT rid FROM reviews";
                $res = mysqli_query($con, $sql);
            }
            elseif($roleid == '2')
            {
                $sql = "SELECT rid FROM reviews 
                INNER JOIN products ON reviews.pid = products.pid AND products.uid = '$uid'";
                $res = mysqli_query($con, $sql);
            }
            foreach($res as $row)
            {
                $r += 1;
            }
            ?>
            <h5 class="text-muted my-3">Manage Reviews / Total Reviews : <span class="text-danger"><?php echo $r; ?></span></h5>
            <hr>
        </div>
        <form action="#" method="post">
            <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">User Name</th>
                        <th scope="col">User Review Date</th>
                        <th scope="col">User Review</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if($roleid == '1')
                    {
                        $sql1 = "SELECT products.pimage, products.pname, users.uname, reviews.rdate, reviews.rreview 
                        FROM reviews 
                        INNER JOIN products ON reviews.pid = products.pid 
                        INNER JOIN users ON reviews.uid = users.uid ORDER BY reviews.rdate DESC";
                    }
                    elseif($roleid == '2')
                    {
                        $sql1 = "SELECT products.pimage, products.pname, users.uname, reviews.rdate, reviews.rreview 
                        FROM reviews 
                        INNER JOIN products ON (reviews.pid = products.pid AND products.uid = '$uid')
                        INNER JOIN users ON reviews.uid = users.uid ORDER BY reviews.rdate DESC";
                    }
                    $res1 = mysqli_query($con, $sql1);
                    foreach($res1 as $row)
                    {
                    ?>
                    <tr class="table-hover">
                        <td><img src="<?php echo $row['pimage']; ?>" alt="User_Photo" class="img-fluid" style="height: 100px; width: 130px;"></td>
                        <td><?php echo $row['pname'] ?></td>
                        <td><?php echo $row['uname'] ?></td>
                        <td><?php echo $row['rdate'] ?></td>
                        <td><?php echo $row['rreview'] ?></td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
        </form>
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