<?php
include "connection.php";
$uid = $_SESSION['uid'];

$sql1 = "SELECT * FROM users WHERE uid = '$uid'";
$res1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_array($res1);
$n = $row1['uname'];
$e = $row1['uemail'];

$key = "LviBIEgL";	
$salt = "iHv6IIpBFy";
$amount = $_POST['amount'];
$productinfo = 'Donation';
$surl = 'http://localhost/Projects/ecart/success.php';
$furl = 'http://localhost/Projects/ecart/failure.php';
$action  = "https://secure.payu.in/_payment";
$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

$hashSequence  = "$key|$txnid|$amount|$productinfo||||||||||||";
$hash_string = $hashSequence.'|'.$salt;
$hash = strtolower(hash('sha512', $hash_string));

$sql = "INSERT INTO trans(TransactionId, ProductType, ProductInfo, UserId)
VALUES ('$txnid', '$productinfo', '$productinfo', '$uid')";

if (mysqli_query($con, $sql)) 
{
    echo "Please Wait...";
}
else 
{
    echo "Error. Please tyr later...";
	die;
}

?>

<html>

<script type='text/javascript'>
	window.onload = function()
					{
						window.document.forms[0].submit();
					}; 
</script>

<form action="<?php echo $action; ?>" method="post" name="payuForm" style="display:none">
	<input type="hidden" name="key" value="<?php echo $key; ?>" />
	<input type="hidden" name="hash" value="<?php echo $hash; ?>"/>
	<input type="hidden" name="txnid" value="<?php echo $txnid; ?>" />

	<table>
		<tr>
			<td><b>Mandatory Parameters</b></td>
		</tr>
		<tr>
			<td>Amount:</td>
			<td><input name="amount" type="hidden" value="<?php echo $amount; ?>" /></td>
		</tr>
		<tr>
			<td>Product Info:</td>
			<td colspan="3"><textarea name="productinfo" style="display:none"><?php echo $productinfo; ?></textarea></td>
		</tr>
		<tr>
			<td>Success URI: </td>
			<td colspan="3"><input name="surl" value="<?php echo $surl; ?>"  type="hidden"/></td>
		</tr>
		<tr>
			<td>Failure URI: </td>
			<td colspan="3"><input name="furl" value="<?php echo $furl; ?>" type="hidden"/></td>
		</tr>
		<tr>
			<td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa"  /></td>
		</tr>
		<tr>
			<?php 
			if($hash)
			{
			?>
				<td colspan="4"><input type="submit" value="Submit" /></td>
			<?php 
			}
			?>
		</tr>
	</table>

</form>

<div align="center">
	<img src="load.gif" style="height:100px;"/>
	<h3>Please wait while you are redirected to <br>payment gateway..</h3>
</div>

</html>