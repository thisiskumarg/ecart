<?php 
$roleid = $_SESSION['roleid'];
if($roleid == '1')
{
    include "adminheader.php";
}

if(!empty($sv) == 1)
{
    echo '<script type="text/javascript">
        $(window).on("load", function(){
            $("#myModal2").modal("show");
        });
    </script>';
}

elseif(!empty($sr) == 1)
{
    echo '<script type="text/javascript">
        $(window).on("load", function(){
            $("#myModal3").modal("show");
        });
    </script>';
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
        <h6 class="text-danger"><?php if(!empty($stmt)) echo $stmt; ?></h6>
        <div class="row">
            <?php 
            $sv = 0;
            $sql = "SELECT * FROM users WHERE roleid = '2' and is_verified = '2'";
            $res = mysqli_query($con, $sql);
            foreach($res as $row)
            {
                $sv += 1;
            }
            ?>
            <h5 class="text-muted my-3">Suspended Vendors : <span class="text-danger"><?php echo $sv; ?></span></h5>
            <hr>
        </div>
        <form action="db.php" method="post">
            <div class="row col-sm-12 mb-3">
                <?php 
                $rid = '2';
                $status = '2';
                echo '<input type="hidden" name="rid" value='.$rid.'>';
                echo '<input type="hidden" name="mstatus" value='.$status.'>';
                ?>
                <input type="submit" value="VERIFY" name="vsm" class="btn btn-success mr-2">
                <input type="submit" value="REMOVE" name="rsm" class="btn btn-danger">
            </div>
            <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th scope="col"><input type="checkbox" onclick="selectAll(this)"></th>
                        <th scope="col">Vendor Image</th>
                        <th scope="col">Vendor Name</th>
                        <th scope="col">Vendor Mobile</th>
                        <th scope="col">Vendor Email</th>
                        <th scope="col">Vendor Registration Date</th>
                        <th scope="col">Vendor Address</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sql = "SELECT * FROM users WHERE roleid = '2' and is_verified = '2'";
                    $res = mysqli_query($con, $sql);
                    foreach($res as $row)
                    {
                    ?>
                        <tr class="table-hover">
                            <td><input type="checkbox" name="selectsm[]" value="<?php echo $row['uid']; ?>"></td>
                            <td><img src="<?php echo $row['uimage']; ?>" alt="User_Photo" class="img-fluid" style="height: 100px; width: 130px;"></td>
                            <td><?php echo $row['uname'] ?></td>
                            <td><?php echo $row['umobile'] ?></td>
                            <td><?php echo $row['uemail'] ?></td>
                            <td><?php echo $row['usignup_date'] ?></td>
                            <td><?php echo $row['uaddress'] ?></td>
                            <td><a href="db.php?editumform=<?php echo $row['uid']; ?>" class="btn btn-primary">EDIT</a></td>
                        </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>

    <!-- Modal-2 Start, Verify Message -->

    <div class="modal fade" id="myModal2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Suspended Vendors Page says :</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-primary">
                    <p>Vendor is <span class="text-success">verified</span> successfully.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal-2 End, Verify Message -->

    <!-- Modal-3 Start, Remove Message -->

    <div class="modal fade" id="myModal3">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Suspended Vendors Page says :</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-primary">
                    <p>Vendor is <span class="text-danger">removed</span> successfully.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal-3 End, Remove Message -->

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

<script>
function selectAll(source)
{
    checkboxes=document.getElementsByName('selectsm[]');
    for(var i in checkboxes)
    checkboxes[i].checked=source.checked;
}
</script>

<?php 
include "footer.php";
?>