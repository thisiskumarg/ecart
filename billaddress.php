<?php 
if(session_status() == PHP_SESSION_NONE)
{
    include "connection.php";
}
$roleid = $_SESSION['roleid'];
$uid = $_SESSION['uid'];
$sql = "SELECT * FROM users WHERE roleid = '$roleid' and uid = '$uid'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_array($res);
$user = $row['uname'];
include "userheader.php";

if(isset($_GET['msg']))
{
    $msg = $_GET['msg'];
}

?>

<div class="col-sm-12">
    <div class="row">
        <h5 class="text-muted my-3 mx-auto">Billing Address</h5>
    </div>
    <div class="row col-sm-12">
        <div class="col-sm-8">
            <h3 class="text-danger"><?php if(!empty($msg)) echo $msg; ?></h3>
            <form id="r" method="post" onsubmit="return false;">
                <?php  
                $sql = "SELECT * FROM bill_address WHERE uid = '$uid'";
                $res = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($res);
                $billadd = $row['baddress'];
                if(!empty($billadd))
                {
                ?>
                    <div class="row form-group">
                        <label class="col-sm-3 col-form-label">ADDRESS (DEFAULT) :</label>
                        <textarea name="billadd" cols="30" rows="6" class="col-sm-9 form-control" readonly required><?php echo $billadd; ?></textarea>
                        <label class="col-sm-3 col-form-control">ORDER AMOUNT (with 18% GST)</label>
                        <input type="text" name="amount" value="<?php echo $gamount; ?>" class="col-sm-9" style="outline: none; border: none; background-color: transparent" readonly required>
                    </div>
                    <div class="row my-4">
                        <div class="mx-auto">
                            <input type="submit" id="s" value="MAKE PAYMENT ONLINE" class="btn btn-lg btn-success">
                            <a href="db.php?cod=<?php echo $gamount; ?>" class="btn btn-lg btn-success">CASH ON DELIVERY</a>
                        </div>
                    </div>
                <?php 
                }
                ?>
            </form>
        </div>
        <div class="col-sm-4 mx-auto">
            <form action="db.php" method="post">
                <div class="form-group">
                    <label class="col-form-label">ADD ADDRESS / CHANGE ADDRESS :</label>
                    <textarea name="billadd" cols="30" rows="5" class="form-control" required></textarea>
                </div>
                <div class="row my-4">
                    <input type="submit" name="acbilladd" value="ADD / CHANGE ADDRESS" class="btn btn-sm btn-danger mx-auto">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(function(){
	$('#s').click(function(){
		var invalid = '';
		$('#r').find('.required').each(function(){
			var val = $.trim($(this).val());
			if(val == '')
			{
				invalid = 1;
				$(this).css('border-color','red');
			}
			else
				$(this).css('border-color','');
		});
		if(invalid == '')
		{
			$('#r').removeAttr('onsubmit');
			$('#r').attr('action','payment.php');
			$('#r').trigger('submit');
		}
	});
});
</script>