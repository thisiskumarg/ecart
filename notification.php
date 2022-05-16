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
elseif($roleid == '3')
{
    include "userheader.php";
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
                <a href="db.php?nform" class="list-group-item list-group-item-action">Notifications</a>
            </div>
        </div>
    <?php 
    }
    ?>
    <div class="col-sm-10">
        <div class="row">
            <?php 
            $l = 0;
            $sql = "SELECT lid FROM logs";
            $res = mysqli_query($con, $sql);
            foreach($res as $row)
            {
                $l += 1;
            }

            if(!empty($l))
            {
            ?>
            <h5 class="text-muted my-3">Notifications : <span class="text-danger"><?php echo $l; ?></span></h5>
            <hr>
        </div>
        <form action="#" method="post">
            <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Notification Date & Time</th>
                        <th scope="col">Notifications</th>
                        <?php 
                        if($roleid == '1' || $roleid == '2')
                        {
                        ?>
                            <th scope="col">By</th>
                        <?php 
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sql1 = "SELECT logs.log_date, logs.log_activity, logs.log_object, users.uname FROM logs
                    INNER JOIN users ON users.uid = logs.logged_by ORDER BY log_date DESC";
                    $res1 = mysqli_query($con, $sql1);
                    foreach($res1 as $row)
                    {
                    ?>
                    <tr class="table-hover">
                        <td><?php echo $row['log_date'] ?></td>
                        <?php 
                        echo '<td>One '.$row['log_object'].' '.$row['log_activity'].' Successfully.</td>';
                        echo '<td>'.$row['uname'].'</td>';
                        ?>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
        </form>
        <?php 
            }
            else
            {
                echo '<h2 class="text-danger ml-5 mt-5">There are no notifications.</h2>';
            }
        ?>
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
            </div>
        </div>
    </div>
</div>

<!-- Modal-4 End, Add New Vendor -->

<?php 
include "footer.php";
?>