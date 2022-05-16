<?php 
if(session_status() == PHP_SESSION_ACTIVE)
{
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
}

elseif(!isset($_SESSION))
{
    include "connection.php";
    include "header.php";
    if(isset($_GET))
    {
        $pid = $_GET['user'];
        $page = $_GET['usr'];
    }
}

?>

    <div class="col-sm-12 pt-4">
        <?php 
        $sql = "SELECT * FROM products WHERE pid = '$pid'";
        $res = mysqli_query($con, $sql);
        foreach($res as $row)
        {
        ?>
            <div class="row">
                <div class="col-sm-6">
                    <div class="text-center">
                        <img src="<?php echo $row['pimage']; ?>" alt="Product_Image" class="img-fluid" style="height: 350px; width: 600px;">
                    </div>
                    <h4 class="col-sm-12 my-4 text-center">Price: <?php echo $row['pprice']; ?> INR</h4>
                    <?php 
                    if(!empty($roleid))
                    {
                        if($roleid == '3' && $page == '1')
                        {
                    ?>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <a href="db.php?addtocart=<?php echo $row['pid']; ?>" class="btn btn-lg btn-warning">ADD TO CART</a>
                            <a href="db.php?buynow=<?php echo ($row['pprice'] + $row['pprice'] * 0.18); ?>" class="btn btn-lg btn-danger">BUY NOW</a>
                        </div>
                    </div>
                    <?php 
                        }
                    }
                    ?>
                </div>
                <div class="col-sm-6">
                    <h3 class="row text-primary mb-4">PRODUCT DESCRIPTION</h3>
                    <div class="row form-group">
                        <label for="#" class="col-sm-4">Product Name</label>
                        <div class="col-sm-8">
                            <?php echo $row['pname']; ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="#" class="col-sm-4">Product Type</label>
                        <div class="col-sm-8">
                            <?php echo $row['ptype']; ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="#" class="col-sm-4">Product Category</label>
                        <div class="col-sm-8">
                            <?php echo $row['pcategory']; ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="#" class="col-sm-4">Product Brand</label>
                        <div class="col-sm-8">
                            <?php echo $row['pbrand']; ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="#" class="col-sm-4">Product Quantity</label>
                        <div class="col-sm-8">
                            <?php echo $row['pquantity']; ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="#" class="col-sm-4">Product Description</label>
                        <div class="col-sm-8">
                            <?php echo $row['pdiscription']; ?>
                        </div>
                    </div>
                    <h3 class="row text-primary my-4">LEAVE A REVIEW</h3>
                    <form action="db.php?pid=<?php echo $row['pid']; ?>" method="post" class="my-4">
                        <textarea name="rvw" cols="30" rows="8" class="form-control" required></textarea>
                        <input type="submit" name="srvw" value="SEND REVIEW" class="btn btn-primary mt-3">
                    </form>
                    <h3 class="row text-primary my-4">REVIEWS</h3>
                    <hr>
                    <div>
                        <?php 
                        $sql2 = "SELECT users.uname, reviews.rreview, reviews.rdate 
                        FROM reviews 
                        INNER JOIN users ON reviews.uid = users.uid WHERE reviews.pid = '$pid' ORDER BY reviews.rdate DESC";
                        $res2 = mysqli_query($con, $sql2);
                        foreach($res2 as $row2)
                        {
                        ?>
                            <div class="row col-sm-12">
                                <h4 class="text-primary"><?php echo $row2['uname']; ?></h4>
                            </div>
                            <h6 class="text-secondary"><?php echo $row2['rreview']; ?></h6>
                            <small class="text-secondary"><?php echo $row2['rdate']; ?></small>
                            <hr>
                        <?php 
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php 
        }
        ?>
    </div>
</div>

<?php 
include "footer.php";
?>