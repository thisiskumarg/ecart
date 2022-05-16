<?php 
$roleid = $_SESSION['roleid'];
$uid = $_SESSION['uid'];
if($roleid == '3')
{
    $sql = "SELECT * FROM users WHERE roleid = '$roleid' and uid = '$uid'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($res);
    $user = $row['uname'];

    include "userheader.php";
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
            $total_reviews = 0;
            $sql1 = "SELECT * FROM reviews WHERE uid = '$uid'";
            $res1 = mysqli_query($con, $sql1);
            foreach($res1 as $row1)
            {
                $total_reviews += 1;
            }
            ?>
            <h3 class="text-muted my-3">REVIEWS : <span class="text-danger"><?php echo $total_reviews; ?></span></h3>
        </div>
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th scope="col">Product Photo</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Review Date</th>
                    <th scope="col">Review</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT * FROM products 
                INNER JOIN reviews WHERE reviews.pid = products.pid and reviews.uid = '$uid' ORDER BY rdate DESC";
                $res = mysqli_query($con, $sql);
                foreach($res as $row)
                {
                ?>
                <tr class="table-hover">
                    <td><img src="<?php echo $row['pimage']; ?>" alt="Product_Photo" class="img-fluid" style="height: 100px; width: 130px;"></td>
                    <td><?php echo $row['pname'] ?></td>
                    <td><?php echo $row['rdate'] ?></td>
                    <td><?php echo $row['rreview'] ?></td>
                </tr>
                <?php 
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php 
include "footer.php";
?>