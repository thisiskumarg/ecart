<?php 
if(session_status() == PHP_SESSION_NONE)
{
    include 'connection.php';
}

$roleid = $_SESSION['roleid'];
$uid = $_SESSION['uid'];
$sql = "SELECT * FROM users WHERE roleid = '$roleid' and uid = '$uid'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_array($res);
$user = $row['uname'];
include "userheader.php";

if(!empty($cod) == 1)
{
    echo '<script type="text/javascript">
        $(window).on("load", function(){
            $("#myModal1").modal("show");
        });
    </script>';
}

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
    <div class="col-sm-10">
        <div class="row">
            <?php 
            $mo = 0;
            $sql = "SELECT * FROM orders WHERE uid = '$uid'";
            $res = mysqli_query($con, $sql);
            foreach($res as $row)
            {
                $mo += 1;
            }
            ?>
            <h3 class="text-muted my-3">My Orders : <span class="text-danger"><?php echo $mo; ?></span></h3>
        </div>
        <form action="db.php" method="post">
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
                        <th scope="col">Total Order Value</th>
                        <th scope="col">Order Status</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sql = "SELECT * FROM orders 
                    INNER JOIN products ON orders.pid = products.pid and orders.uid = '$uid' ORDER BY orders.odate DESC";
                    $res = mysqli_query($con, $sql);
                    foreach($res as $row)
                    {
                        // $_SESSION['pstatus'] = $row['is_verified'];
                    ?>
                        <tr class="table-hover">
                            <!-- <td><input type="checkbox" name="selectnvp[]" value="<?php echo $row['pid']; ?>"></td> -->
                            <td><?php echo $row['oid']; ?></td>
                            <td><img src="<?php echo $row['pimage']; ?>" alt="Product_Photo" class="img-fluid" style="height: 100px;"></td>
                            <td><?php echo $row['pname']; ?></td>
                            <td><?php echo $row['pprice']; ?></td>
                            <td><?php echo $row['ovalue'] ?></td>
                            <td>
                            <?php 
                            if($row['sid'] == '1' && $row['is_cancelled'] == 0)
                            {
                            ?>
                                <div class="text-info">Processed</div>
                            <?php 
                            }
                            elseif($row['sid'] == '2' && $row['is_cancelled'] == 0)
                            {
                            ?>
                                <div class="text-primary">Confirmed</div>
                            <?php 
                            }
                            elseif($row['sid'] == '3' && $row['is_cancelled'] == 0)
                            {
                            ?>
                                <div class="text-warning">Shipped</div>
                            <?php 
                            }
                            elseif($row['sid'] == '4' && $row['is_cancelled'] == 0)
                            {
                            ?>
                                <div class="text-success">Delivered</div>
                            <?php 
                            }
                            elseif($row['sid'] == '5'|| $row['sid'] == '6' || $row['is_cancelled'] == 1)
                            {
                            ?>
                                <div class="text-danger">Cancelled</div>
                            <?php 
                            }
                            ?>
                            </td>
                            <td><?php echo $row['odate']; ?></td>
                            <td>
                            <?php 
                            if($row['sid'] != 4 && $row['sid'] != 5 && $row['sid'] != 6 && $row['is_cancelled'] != 1)
                            {
                            ?>
                                <a href="db.php?ucancel=<?php echo $row['order_sno']; ?>" class="btn btn-danger">CANCEL</a>
                            <?php 
                            }
                            ?>
                            </td>
                        </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>
</div>

    <!-- Modal-1 Start, Order Product Message -->

    <div class="modal fade" id="myModal1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">User Orders Page says :</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-primary">
                    <p>Order is <span class="text-success">placed</span> successfully.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal-2 End, Order Product Message -->

<?php 
include "footer.php";
?>