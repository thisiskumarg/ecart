<?php 
$roleid = $_SESSION['roleid'];
$uid = $_SESSION['uid'];

include "userheader.php";

?>

<div class="row col-sm-12">
    <div class="col-sm-2">
        <div class="list-group text-center my-5">
            <a href="#" class="list-group-item list-group-item-action active">Category</a>
            <a href="db.php?c=Jeans" class="list-group-item list-group-item-action">Jeans</a>
            <a href="db.php?c=T-Shirt" class="list-group-item list-group-item-action">T - Shirts</a>
            <a href="db.php?c=Shoes" class="list-group-item list-group-item-action">Shoes</a>
            <a href="db.php?c=Watch" class="list-group-item list-group-item-action">Watches</a>
            <a href="db.php?c=TV" class="list-group-item list-group-item-action">TV</a>
            <a href="db.php?c=Mobile" class="list-group-item list-group-item-action">Mobile</a>
        </div>
        <div class="list-group text-center">
            <a href="#" class="list-group-item list-group-item-action active">Brand</a>
            <a href="db.php?b=Nike" class="list-group-item list-group-item-action">Nike</a>
            <a href="db.php?b=Puma" class="list-group-item list-group-item-action">Puma</a>
            <a href="db.php?b=Samsung" class="list-group-item list-group-item-action">Samsung</a>
            <a href="db.php?b=MI" class="list-group-item list-group-item-action">MI</a>
            <a href="db.php?b=HP" class="list-group-item list-group-item-action">HP</a>
            <a href="db.php?b=Dell" class="list-group-item list-group-item-action">Dell</a>
        </div>
    </div>
    <div class="col-sm-10">
        <div class="row my-3">
            <div class="col-sm-4">
                <h3 class="text-primary">Latest Products</h3>
            </div>
            <div class="col-sm-8 ml-auto">
                <form action="db.php" method="POST" class="form-inline">
                    <input class="form-control mr-sm-2" name="key" type="search" placeholder="Search Product" aria-label="Search" style="width: 600px;">
                    <button class="btn btn-primary my-2 my-sm-0" name="search" type="submit">SEARCH</button>
                </form>
            </div>
        </div>
        <div class="row">
            <?php 
            if(!empty($c))
            {
                $sql = "SELECT * FROM products WHERE is_verified = '1' and pcategory = '$c'";
                $res = mysqli_query($con, $sql);
            }
            elseif(!empty($b))
            {
                $sql = "SELECT * FROM products WHERE is_verified = '1' and pbrand = '$b'";
                $res = mysqli_query($con, $sql);
            }
            elseif(!empty($key))
            {
                $sql = "SELECT * FROM products WHERE pname LIKE '$key%' 
                or pcategory LIKE '$key%' or ptype LIKE '$key%' 
                or pbrand LIKE '$key%' or pdiscription LIKE '$key%'";
                $res = mysqli_query($con, $sql);
            }
            else
            {
                $sql = "SELECT * FROM products WHERE is_verified = '1'";
                $res = mysqli_query($con, $sql);
            }
            foreach($res as $row)
            {
                $vpid = $row['pid'];
            ?>
            <!-- <div class="card-deck col-sm-12 mb-5"> -->
            <div class="col-sm-4 mb-4">
                <div class="card">
                    <a href="db.php?pdetail=<?php echo $row['pid']; ?>"><img src="<?php echo $row['pimage']; ?>" class="card-img-top" alt="..." style="height: 300px;"></a>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="card-title"><?php echo $row['pname']; ?></h6>
                            </div>
                            <div class="col-sm-6 text-right">
                                <h6 class="card-title"><?php echo $row['pprice'] ?> INR</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="db.php?addtocart=<?php echo $vpid; ?>" class="btn btn-sm btn-warning">ADD TO CART</a>
                            </div>
                            <div class="col-sm-6 text-right">
                                <a href="db.php?pdetail=<?php echo $row['pid']; ?>" class="btn btn-sm btn-danger">BUY NOW</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Last updated 3 mins ago</small>
                    </div>
                </div>
            </div>
            <?php 
            }
            ?>
        </div>
    </div>
</div>

<?php 
include "footer.php";
?>