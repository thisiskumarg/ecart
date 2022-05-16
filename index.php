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

elseif(session_status() == PHP_SESSION_NONE)
{
    include "connection.php";
    include "header.php";
    if(isset($_GET['index']))
    {
        $key = $_GET['index'];
    }

    if(isset($_GET['b']))
    {
        $b = $_GET['b'];
    }

    if(isset($_GET['c']))
    {
        $c = $_GET['c'];
    }
}

if(isset($_GET['regform']))
{
    echo '<script type="text/javascript">
        $(window).on("load", function(){
            $("#myModal1").modal("show");
        });
    </script>';
}

elseif(isset($_GET['msg1']))
{
    $msg1 = $_GET['msg1'];
    echo '<script type="text/javascript">
        $(window).on("load", function(){
            $("#myModal1").modal("show");
        });
    </script>';
}

elseif(isset($_GET['msg2']))
{
    $msg2 = $_GET['msg2'];
    echo '<script type="text/javascript">
        $(window).on("load", function(){
            $("#myModal2").modal("show");
        });
    </script>';
}

elseif(isset($_GET['logform']))
{
    echo '<script type="text/javascript">
        $(window).on("load", function(){
            $("#myModal2").modal("show");
        });
    </script>';
}

?>

<!-- Modal-1 Start, Register Page -->

<div class="modal fade" id="myModal1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <p class="text-danger"><?php if(!empty($msg1)) echo $msg1; ?></p>
                <h3 class="modal-title text-white">REGISTER</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="db.php" method="post" enctype="multipart/form-data">
                <div class="modal-body text-primary">
                    <div class="row col-sm-12 form-group">
                        <label class="col-sm-4 col-form-label">NAME</label>
                        <input type="text" name="nm" class="col-sm-8 form-control text-primary">
                    </div>
                    <div class="row col-sm-12 form-group">
                        <label class="col-sm-4 col-form-label">MOBILE</label>
                        <input type="tel" name="mb" class="col-sm-8 form-control text-primary">
                    </div>
                    <div class="row col-sm-12 form-group">
                        <label class="col-sm-4 col-form-label">EMAIL</label>
                        <input type="email" name="em" class="col-sm-8 form-control text-primary">
                    </div>
                    <div class="row col-sm-12 form-group">
                        <label class="col-sm-4 col-form-label">PASSWORD</label>
                        <input type="password" name="pd" class="col-sm-8 form-control text-primary">
                    </div>
                    <div class="row col-sm-12 form-group">
                        <label class="col-sm-4 col-form-label">IMAGE</label>
                        <input type="file" name="im" class="col-sm-8 form-control text-primary">
                    </div>
                    <div class="row col-sm-12 form-group">
                        <label class="col-sm-4 col-form-label">ADDRESS</label>
                        <textarea name="adr" cols="30" rows="4" class="col-sm-8 form-control text-primary"></textarea>
                    </div>
                </div>
                <div class="modal-footer flex-start">
                    <h6><a href="?logform" class="form-link">LOGIN</a></h6>
                    <input type="submit" value="REGISTER" name="register" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal-1 End, Register Page -->

<!-- Modal-2 Start, Login Page -->

<div class="modal fade" id="myModal2">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <p class="text-danger"><?php if(!empty($msg2)) echo $msg2; ?></p>
                <h3 class="modal-title text-white">LOGIN</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="db.php" method="post">
                <div class="modal-body text-primary">
                    <div class="row form-group">
                        <label class="col-sm-4 col-form-label">EMAIL</label>
                        <input type="email" name="em" class="col-sm-8 form-control text-primary">
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-4 col-form-label">PASSWORD</label>
                        <input type="password" name="pd" class="col-sm-8 form-control text-primary">
                    </div>
                </div>
                <div class="modal-footer flex-start">
                    <span class="mr-auto"><h6 class="my-auto"><a href="#" class="form-link" style="line-height: 20px;">FORGOT PASSWORD</a></h6></span>
                    <h6><a href="?regform" class="form-link">NEW USER</a></h6>
                    <input type="submit" value="LOGIN" name="login" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal-2 End, Login Page -->

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
                    <input class="form-control mr-sm-2" name="key" type="search" placeholder="Search Product" aria-label="Search" style="width: 600px;" required>
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
                $sql = "SELECT * FROM products WHERE is_verified = '1' and (pname LIKE '$key%' 
                or pcategory LIKE '$key%' or ptype LIKE '$key%' 
                or pbrand LIKE '$key%' or pdiscription LIKE '$key%')";
                $res = mysqli_query($con, $sql);
            }
            else
            {
                $sql = "SELECT * FROM products WHERE is_verified = '1'";
                $res = mysqli_query($con, $sql);
            }
            foreach($res as $row)
            {
            ?>
            <div class="col-sm-4 mb-4">
                <div class="card">
                    <a href="db.php?pdetailform=<?php echo $row['pid']; ?>"><img src="<?php echo $row['pimage']; ?>" class="card-img-top" alt="..." style="height: 300px;"></a>
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
                                <a href="db.php?pdetailform=<?php echo $row['pid']; ?>" class="btn btn-sm btn-warning">ADD TO CART</a>
                            </div>
                            <div class="col-sm-6 text-right">
                                <a href="db.php?pdetailform=<?php echo $row['pid']; ?>" class="btn btn-sm btn-danger">BUY NOW</a>
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