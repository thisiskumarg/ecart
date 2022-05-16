<?php 
$roleid = $_SESSION['roleid'];

if($roleid == '1')
{
    include "adminheader.php";
}

elseif($roleid == '2')
{
    include "managerheader.php";
}

elseif(isset($_GET['msg1']))
{
    $msg1 = $_GET['msg1'];
}

?>

<div class="col-sm-10 mt-3">

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

    <div class="card">
        <?php 
        if($rlid == '3')
        {
        ?>
        <div class="card-header text-center">Edit User Details</div>
        <?php 
        }
        elseif($rlid == '2')
        {
        ?>
        <div class="card-header text-center">Edit Vendor Details</div>
        <?php 
        }
        ?>
        <form action="db.php" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <h6 class="text-danger"><?php if(!empty($msg1)) echo $msg1; ?></h6>
                <div class="row">
                    <div class="col-sm-8 text-primary">
                        <div class="row col-sm-12 form-group">
                            <label class="col-sm-4 col-form-label">USER NAME</label>
                            <input type="text" name="unm1" value="<?php echo $uname; ?>" class="col-sm-8 form-control">
                        </div>
                        <div class="row col-sm-12 form-group">
                            <label class="col-sm-4 col-form-label">USER MOBILE</label>
                            <input type="tel" name="umb1" value="<?php echo $umobile; ?>" class="col-sm-8 form-control">
                        </div>
                        <div class="row col-sm-12 form-group">
                            <label class="col-sm-4 col-form-label">USER EMAIL</label>
                            <input type="email" name="uem1" value="<?php echo $uemail; ?>" class="col-sm-8 form-control">
                        </div>
                        <div class="row col-sm-12 form-group">
                            <label class="col-sm-4 col-form-label">USER EMAIL PASSWORD</label>
                            <input type="password" name="upwd1" value="<?php echo $upass; ?>" class="col-sm-8 form-control">
                        </div>
                        <div class="row col-sm-12 form-group">
                            <label class="col-sm-4 col-form-label">USER ADDRESS</label>
                            <textarea name="uadd1" cols="30" rows="6" class="col-sm-8 form-control"><?php echo $uadd; ?></textarea>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center text-primary">
                        <div class="row">USER IMAGE</div>
                        <img src="<?php echo $uimg; ?>" alt="Product-Photo" class="img-fluid mb-4" height="200" width="200">
                        <input type="file" name="uimg1" class="col-sm-12 form-control">
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <input type="hidden" name="id1" value="<?php echo $id; ?>">
                <input type="submit" value="UPDATE" name="editum" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<?php 
include "footer.php";
?>