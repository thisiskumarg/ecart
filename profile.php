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

elseif($roleid == '3')
{
    include "userheader.php";
}

if(!empty($changep))
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

<?php 
if($roleid == '1' || $roleid == '2')
{
?>
<div class="row col-sm-10">
<?php 
}
?>
<?php 
if($roleid == '3')
{
?>
<div class="row col-sm-12">
    <div class="col-sm-2 mt-3">
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active">User Dashboard</a>
            <a href="db.php?profile" class="list-group-item list-group-item-action">Profile</a>
            <a href="db.php?orderform" class="list-group-item list-group-item-action">My Orders</a>
            <a href="db.php?addtocartform" class="list-group-item list-group-item-action">My Cart</a>
            <a href="db.php?reviewform" class="list-group-item list-group-item-action">My Reviews</a>
        </div>
    </div>
    <div class="col-sm-10 mt-3">
<?php 
}
?>
    <?php 
    if($roleid == '1' || $roleid == '2')
    {
    ?>
    <div class="col-sm-12 mt-3">
    <?php 
    }
    ?>
        <div class="card">
            <div class="card-header text-center">
            <?php 
            if($roleid == '1')
            {
            ?>
                Admin Profile
            <?php 
            }
            elseif($roleid == '2')
            {
            ?>
                Vendor Profile
            <?php 
            }
            elseif($roleid == '3')
            {
            ?>
                User Profile
            <?php 
            }
            ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <form action="db.php" method="post">
                            <div class="row form-group">
                                <label class="col-sm-4">NAME</label>
                                <!-- <input type="text" name="nm1" value="" class="col-sm-8"
                                style="outline: none; border: none; background-color: transparent;" readonly> -->
                                <div class="col-sm-8">
                                    <?php echo $nm; ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-4">MOBILE</label>
                                <!-- <input type="tel" name="mb1" class="col-sm-8" value=""
                                style="outline: none; border: none; background-color: transparent;" readonly> -->
                                <div class="col-sm-8">
                                    <?php echo $mb; ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-4">EMAIL</label>
                                <!-- <input type="email" name="eml1" class="col-sm-8" value=""
                                style="outline: none; border: none; background-color: transparent;" readonly> -->
                                <div class="col-sm-8">
                                    <?php echo $eml; ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-4">ADDRESS</label>
                                <!-- <input type="text" name="adr1" class="col-sm-8" value=""
                                style="outline: none; border: none; background-color: transparent;" readonly> -->
                                <div class="col-sm-8">
                                    <?php echo $adr; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4 text-center">
                        <form action="db.php" method="post" enctype="multipart/form-data">
                            <img src="<?php echo $im; ?>" alt="Profile-Photo" class="img-fluid mb-4" height="200" width="200">
                            <input type="file" name="im1" class="col-sm-12 form-control" required>
                            <div class="card-footer text-center">
                                <input type="submit" value="UPDATE PROFILE PHOTO" name="editprofilephoto" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="db.php?editprofileform" class="btn btn-primary">EDIT PROFILE</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal2">
                    CHANGE PASSWORD
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal-2, Change Password Start -->

<div class="modal fade" id="myModal2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="myModal2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="myModal2">CHANGE PASSWORD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="db.php" method="post">
                <div class="modal-body text-primary">
                    <div class="row form-group">
                        <label class="col-sm-5 col-form-label">OLD PASSWORD</label>
                        <input type="password" name="oldp" class="col-sm-7 form-control" required>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-5 col-form-label">NEW PASSWORD</label>
                        <input type="password" name="newp" class="col-sm-7 form-control" required>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-5 col-form-label">CONFIRM PASSWORD</label>
                        <input type="password" name="conp" class="col-sm-7 form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="changep" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal-2, Change Password End -->

<!-- Modal-3 Start, Remove Message -->

<div class="modal fade" id="myModal3">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Profile Page says :</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-primary">
                <?php 
                if($changep == '1')
                {
                ?>
                <p>Password is <span class="text-success">changed</span> successfully.</p>
                <?php 
                }
                else
                {
                ?>
                <p><?php echo $changep; ?></p>
                <?php 
                }
                ?>
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

<?php 
include "footer.php";
?>