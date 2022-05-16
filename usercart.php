<?php 
if(session_status() == PHP_SESSION_NONE)
{
    include 'connection.php';
}

if(isset($_SESSION['uid']))
{
    $uid = $_SESSION['uid'];
    include "userheader.php";

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
    <?php 
    $sql1 = "SELECT * FROM shop_cart WHERE uid = '$uid'";
    $res1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_array($res1);
    if(!empty($row1['uid']))
    {
    ?>
    <div class="col-sm-10">
        <div class="row">
            <?php 
            $sc = 0;
            $sql = "SELECT * FROM shop_cart WHERE uid = '$uid'";
            $res = mysqli_query($con, $sql);
            foreach($res as $row)
            {
                $sc += 1;
            }
            ?>
            <h3 class="text-muted my-3">Shopping Cart : <span class="text-danger"><?php echo $sc; ?></span></h3>
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
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Price</th>
                        <th scope="col">Product Quantity</th>
                        <th scope="col">Total Product Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $subtotal = 0;
                    $gamount = 0;
                    $sql = "SELECT * FROM shop_cart WHERE uid = '$uid'";
                    $res = mysqli_query($con, $sql);
                    foreach($res as $row)
                    {
                        // $_SESSION['pstatus'] = $row['is_verified'];
                    ?>
                        <form action="db.php?updateucartquan=<?php echo $row['cid']; ?>" method="post">
                            <tr class="table-hover">
                                <!-- <td><input type="checkbox" name="selectnvp[]" value="<?php echo $row['pid']; ?>"></td> -->
                                <td><img src="<?php echo $row['pimage'] ?>" alt="Product_Photo" class="img-fluid" style="height: 100px;"></td>
                                <td><?php echo $row['pname'] ?></td>
                                <td><?php echo $row['pprice'] ?></td>
                                <td><input type="number" name="quan" value="<?php echo $row['pquantity']; ?>" class="form-control" min="1"></td>
                                <td><?php echo $row['pprice'] * $row['pquantity'] ?></td>
                                <td>
                                    <!-- <a href="db.php?updatequantity=<?php echo $row['pid']; ?>" class="btn btn-warning">UPDATE</a> -->
                                    <input type="submit" name="updateucartquan" value="UPDATE" class="btn btn-warning">
                                    <a href="db.php?delucartproduct=<?php echo $row['cid']; ?>" class="btn btn-danger">REMOVE</a>
                                </td>
                            </tr>
                        </form>
                    <?php 
                    $subtotal += ($row['pprice'] * $row['pquantity']);
                    $gamount = $subtotal + $subtotal * 0.18;
                    }
                    ?>
                    <tr class="table-hover">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td scope="col">SUBTOTAL :</td>
                        <td><?php echo $subtotal; ?></td>
                        <td></td>
                    </tr>
                    <tr class="table-hover">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td scope="col">GST (18%) :</td>
                        <td><?php echo $subtotal * 0.18; ?></td>
                        <td></td>
                    </tr>
                    <tr class="table-hover">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td scope="col">GRAND TOTAL :</td>
                        <td><?php echo $gamount; ?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div class="row my-4">
                <a href="db.php?userhome" class="btn btn-lg btn-primary mr-2 ml-auto">CONTINUE SHOPPING</a>
                <form action="db.php" method="post">
                    <input type="hidden" name="gamount" value="<?php echo $gamount; ?>">
                    <input type="submit" name="checkoutform" value="CHECKOUT" class="btn btn-lg btn-danger">
                </form>
            </div>
        
    </div>
</div>
    <?php 
    }
    else
    {
    ?>
        <h1 class="text-danger text-center ml-5 mt-5">YOUR CART IS EMPTY.</h1>
<?php
    }
    include "footer.php";
}
else
{
    header('Location: http://localhost/Projects/ecart/index.php');
    include "footer.php";
}
?>
