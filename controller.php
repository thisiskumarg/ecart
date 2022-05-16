<?php 
include "connection.php";

function register()
{
    global $con;

    $nm = $_POST['nm'];
    $mb = $_POST['mb'];
    $em = $_POST['em'];
    $pd = $_POST['pd'];
    $adr = $_POST['adr'];

    $im = 'images/'.basename($_FILES['im']['name']);
    $imFileType = strtolower(pathinfo($im, PATHINFO_EXTENSION));

	if(!empty($nm) && !empty($mb) && !empty($em) && !empty($pd) && !empty($adr))
	{
		$sql1 = "SELECT umobile FROM users WHERE umobile = '$mb'";
		$res1 = mysqli_query($con, $sql1);
		$row1 = mysqli_fetch_array($res1);
		$mob = $row1['umobile'];
		if($mob == $mb)
		{
			header('Location: http://localhost/Projects/ecart/index.php?msg1=***This mobile number is already taken!');
		}
		else
		{
			$sql2 = "SELECT uemail FROM users WHERE uemail = '$em'";
			$res2 = mysqli_query($con, $sql2);
			$row2 = mysqli_fetch_array($res2);
			$eml = $row2['uemail'];
			if($eml == $em)
			{
				header('Location: http://localhost/Projects/ecart/index.php?msg1=***This Email is already taken!');
			}
			else
			{
                if(!empty($imFileType))
                {
                    if($imFileType != 'jpg' && $imFileType != 'png' && $imFileType != 'jpeg' && $imFileType != 'gif' && $imFileType != 'webp')
                    {
                        header('Location: http://localhost/Projects/ecart/index.php?msg1=***Image should be in .jpg, .png, .webp, .jpeg or .gif format.');
                    }
                    else
                    {
                        if(move_uploaded_file($_FILES['im']['tmp_name'], $im))
                        {
                            $sql = "INSERT INTO users(uname, umobile, uemail, upassword, uaddress, uimage) VALUES('$nm', '$mb', '$em', '$pd', '$adr', '$im')";
                            $res = mysqli_query($con, $sql);
                            if ($res == true)
                            {
                                header("Location: http://localhost/Projects/ecart/index.php?logform");
                            }
                            else
                            {
                                header('Location: http://localhost/Projects/ecart/index.php?msg1=***Insertion Error!');
                            }
                        }
                        else
                        {
                            header('Location: http://localhost/Projects/ecart/index.php?msg1=***Not moved files!');
                        }
                    }
                }
			}
		}
	}
	else
	{
		header('Location: http://localhost/Projects/ecart/index.php?msg1=***All fields are mandatory');
	}
}

function login()
{
    global $con;

    $em = $_POST['em'];
    $pd = $_POST['pd'];

    if(!empty($em) && !empty($pd))
    {
        $sql1 = "SELECT uemail FROM users WHERE uemail = '$em'";
        $res1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_array($res1);
        $eml = $row1['uemail'];
        if($em == $eml)
        {
            $sql2 = "SELECT upassword, uid, roleid, is_verified FROM users WHERE upassword = '$pd'";
            $res2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_array($res2);
            $pwd2 = $row2['upassword'];
            $_SESSION['uid'] = $row2['uid'];
            $urole = $row2['roleid'];
            $_SESSION['roleid'] = $urole;
            $isv = $row2['is_verified'];

            $sql3 = "SELECT rolename FROM role WHERE roleid = '$urole'";
            $res3 = mysqli_query($con, $sql3);
            $row3 = mysqli_fetch_array($res3);
            $_SESSION['role'] = $row3['rolename'];

            if($isv == 1)
            {
                if($pd == $pwd2)
                {
                    if($urole == '1')
                    {
                        require 'admindashboard.php';
                    }
                    elseif($urole == '2')
                    {
                        require 'managerdashboard.php';
                    }
                    elseif($urole == '3')
                    {
                        require "index.php";
                    }
                }
                else
                {
                    header('Location: http://localhost/Projects/ecart/index.php?msg2=***Enter valid Password!');
                }
            }
            else
            {
                header('Location: http://localhost/Projects/ecart/index.php?msg2=***You are not verified! Please verify it...');
            }
        }
        else
        {
            header('Location: http://localhost/Projects/ecart/index.php?msg2=***Enter valid Email or Password!');
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php?msg2=***All fields are mandatory!');
    }
}

function dashboard()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $roleid = $_SESSION['roleid'];
        if($roleid == '1')
        {
            require "admindashboard.php";
        }
        elseif($roleid == '2')
        {
            require "managerdashboard.php";
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function profile()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        if(!empty($_GET['profile']))
        {
            $changep = $_GET['profile'];
        }
        $uid = $_SESSION['uid'];
        $sql = "SELECT uname, umobile, uemail, uaddress, uimage FROM users WHERE uid = '$uid'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($res);
        $nm = $row['uname'];
        $mb = $row['umobile'];
        $eml = $row['uemail'];
        $adr = $row['uaddress'];
        $im = $row['uimage'];

        require "profile.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function editprofileform()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $sql = "SELECT uname, umobile, uemail, upassword, uaddress, uimage FROM users WHERE uid = '$uid'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($res);
        $nm = $row['uname'];
        $mb = $row['umobile'];
        $eml = $row['uemail'];
        $adr = $row['uaddress'];
        $im = $row['uimage'];

        require "editprofile.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function changep()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $oldp = $_POST['oldp'];
        $newp = $_POST['newp'];
        $conp = $_POST['conp'];

        $sql1 = "SELECT upassword FROM users WHERE uid = '$uid'";
        $res1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_array($res1);
        $upass = $row1['upassword'];
        if($oldp == $upass)
        {
            if($newp == $conp)
            {
                $sql2 = "UPDATE users SET upassword = '$conp' WHERE uid = '$uid'";
                $res2 = mysqli_query($con, $sql2);
                if($res2 == true)
                {
                    $changep = 1;
                    header('Location: http://localhost/Projects/ecart/db.php?profile='.$changep);
                }
            }
            else
            {
                header('Location: http://localhost/Projects/ecart/db.php?profile=***New and Confirm Password are not same!');
            }
        }
        else
        {
            header('Location: http://localhost/Projects/ecart/db.php?profile=***Enter Valid Previous Password!');
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function editprofile()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $nm1 = $_POST['nm1'];
        $mb1 = $_POST['mb1'];
        $eml1 = $_POST['eml1'];
        $adr1 = $_POST['adr1'];

        if(!empty($nm1) && !empty($mb1) && !empty($eml1) && !empty($adr1))
        {
            $sql = "UPDATE users SET uname = '$nm1', umobile = '$mb1', uemail = '$eml1', uaddress = '$adr1' WHERE uid = '$uid'";
            $res = mysqli_query($con, $sql);
            if($res == true)
            {
                header('Location: http://localhost/Projects/ecart/db.php?profile');
            }
        }
        else
        {
            header('Location: http://localhost/Projects/ecart/editprofile.php?msg1=***All fields are mandatory');
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function editprofilephoto()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $im1 = 'images/'.basename($_FILES['im1']['name']);
        $im1FileType = strtolower(pathinfo($im1, PATHINFO_EXTENSION));

        if(!empty($im1FileType))
        {
            if($im1FileType != 'jpg' && $im1FileType != 'png' && $im1FileType != 'jpeg' && $im1FileType != 'gif' && $im1FileType != 'webp')
            {
                header('Location: http://localhost/Projects/ecart/editprofile.php?msg1=***Image should be in .jpg, .png, .jpeg, .webp or .gif format.');
            }
            else
            {
                if(move_uploaded_file($_FILES['im1']['tmp_name'], $im1))
                {
                    $sql = "UPDATE users SET uimage = '$im1' WHERE uid = '$uid'";
                    $res = mysqli_query($con, $sql);
                    if($res == true)
                    {
                        header('Location: http://localhost/Projects/ecart/db.php?profile');
                    }
                }
            }
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function addvender()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $roleid = $_SESSION['roleid'];
        $nm1 = $_POST['nm1'];
        $mb1 = $_POST['mb1'];
        $eml1 = $_POST['eml1'];
        $pwd1 = $_POST['pwd1'];
        $adr1 = $_POST['adr1'];
        $rlid = '2';
        $status = '1';

        if(!empty($nm1) && !empty($mb1) && !empty($eml1) && !empty($pwd1) && !empty($adr1))
        {
            $sql = "INSERT INTO users(uname, umobile, uemail, upassword, uaddress, roleid, is_verified)
            VALUES('$nm1', '$mb1', '$eml1', '$pwd1', '$adr1', '$rlid', '$status')";
            $res = mysqli_query($con, $sql);
            if($res == true)
            {
                if($roleid == '1')
                {
                    $log_a = 'Added';
                    $log_o = 'Vendor';
                    $sql1 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                    VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                    $res1 = mysqli_query($con, $sql1);
                }
                require 'vmanagers.php';
            }
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function addproduct()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $roleid = $_SESSION['roleid'];
        $pnm = $_POST['pnm'];
        $ptp = $_POST['ptp'];
        $pcat = $_POST['pcat'];
        $pbrd = $_POST['pbrd'];
        $pp = $_POST['pp'];
        $pq = $_POST['pq'];
        $pdes = $_POST['pdes'];

        $pimg = 'images/'.basename($_FILES['pimg']['name']);
        $pimgFileType = strtolower(pathinfo($pimg, PATHINFO_EXTENSION));

        if(!empty($pimgFileType) && !empty($pnm) && !empty($ptp) && !empty($pcat) && !empty($pbrd) && !empty($pp) && !empty($pq) && !empty($pdes))
        {
            if($pimgFileType != 'jpg' && $pimgFileType != 'png' && $pimgFileType != 'jpeg' && $pimgFileType != 'gif' && $pimgFileType != 'webp')
            {
                header('Location: http://localhost/Projects/ecart/?msg1=***Image should be in .jpg, .png, .jpeg, .webp or .gif format.');
            }
            else
            {
                if(move_uploaded_file($_FILES['pimg']['tmp_name'], $pimg))
                {
                    $sql = "INSERT INTO products(pimage, pname, ptype, pcategory, pbrand, pprice, pquantity, pdiscription, uid) 
                    VALUES('$pimg', '$pnm', '$ptp', '$pcat', '$pbrd', '$pp', '$pq', '$pdes', '$uid')";
                    $res = mysqli_query($con, $sql);
                    if($res == true)
                    {
                        if($roleid == '2')
                        {
                            $log_a = 'Added';
                            $log_o = 'Product';
                            $sql1 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                            VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                            $res1 = mysqli_query($con, $sql1);
                        }
                        require "nvproducts.php";
                    }
                }
            }
        }
        else
        {
            if($roleid == '1')
            {
                header('Location: http://localhost/Projects/ecart/admindashboard.php?msg=***All fields are mandatory!');
            }
            elseif($roleid == '2')
            {
                header('Location: http://localhost/Projects/ecart/managerdashboard.php?msg=***All fields are mandatory!');
            }
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function allproducts()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        require "manageproducts.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

// Non-Verified Products Page - Start

function nvp()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $sql1 = "SELECT new_old FROM products WHERE is_verified = '0' and new_old = 'new'";
        $res1 = mysqli_query($con, $sql1);
        foreach($res1 as $row1)
        {
            $sql2 = "UPDATE products SET new_old = 'old'";
            $res2 = mysqli_query($con, $sql2);
        }
        require "nvproducts.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

// Non-Verified Products Page - End

// Verified Products Page - Start

function vp()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        require "vproducts.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

// Non-Verified Products Page - End

// Suspended Products Page - Start

function sp()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        require "sproducts.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

// Suspended Products Page - End

function vu()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        require "vusers.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function nvu()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $sql1 = "SELECT new_old FROM users WHERE is_verified = '0' and new_old = 'new'";
        $res1 = mysqli_query($con, $sql1);
        foreach($res1 as $row1)
        {
            $sql2 = "UPDATE users SET new_old = 'old'";
            $res2 = mysqli_query($con, $sql2);
        }
        require "nvusers.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function allusers()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        require "manageusers.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function sm()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        require "smanagers.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function vm()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        require "vmanagers.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function allmanagers()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        require "managemanagers.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

// Verify Non-Verified Products - Start
// Verify Suspended Products - Start

function vnvp()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $roleid = $_SESSION['roleid'];
        $status = $_POST['pstatus'];
        if($status == '0' && !empty($_POST['selectnvp']))
        {
            $pid = $_POST['selectnvp'];
            foreach($pid as $id)
            {
                $sql1 = "UPDATE products SET is_verified = '1' WHERE pid = '$id'";
                $res1 = mysqli_query($con, $sql1);
                $log_a = 'Verified';
                $log_o = 'Non-Verified Product';
                $sql2 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                $res2 = mysqli_query($con, $sql2);
            }
            if($res1 == true)
            {
                $nvv = 1;
                require "nvproducts.php";
            }
        }
        elseif($status == '2' && !empty($_POST['selectsp']))
        {
            $pid = $_POST['selectsp'];
            foreach($pid as $id)
            {
                $sql1 = "UPDATE products SET is_verified = '1' WHERE pid = '$id'";
                $res1 = mysqli_query($con, $sql1);
                $log_a = 'Verified';
                $log_o = 'Suspended Product';
                $sql2 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                $res2 = mysqli_query($con, $sql2);
            }
            if($res1 == true)
            {
                $sv = 1;
                require "sproducts.php";
            }
        }
        else
        {
            $stmt = 'Please select any product to verify it!';
            if($status == '0')
            {
                require "nvproducts.php";
            }
            elseif($status == '2')
            {
                require "sproducts.php";
            }
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

// Verify Non-Verified Products - End
// Verify Suspended Products - End

function usp()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $roleid = $_SESSION['roleid'];
        if(!empty($_POST['selectsp']))
        {
            $pid = $_POST['selectsp'];
            foreach($pid as $id)
            {
                $sql1 = "UPDATE products SET is_verified = '0' WHERE pid = '$id'";
                $res1 = mysqli_query($con, $sql1);
                $log_a = 'Unsuspended';
                $log_o = 'Suspended Product';
                $sql3 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                $res3 = mysqli_query($con, $sql3);
            }
            if($res1 == true)
            {
                require "sproducts.php";
            }
        }
        else
        {
            $stmt = 'Please select any product to unsuspend it!';
            require "sproducts.php";
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function vsm()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $roleid = $_SESSION['roleid'];
        $status = $_POST['mstatus'];
        if($status == '2' && !empty($_POST['selectsm']))
        {
            $idm = $_POST['selectsm'];
            foreach($idm as $id)
            {
                $sql = "UPDATE users SET is_verified = '1' WHERE uid = '$id'";
                $res = mysqli_query($con, $sql);
            }
            if($res == true)
            {
                if($roleid == '1')
                {
                    $log_a = 'Verified';
                    $log_o = 'Suspended Vendor';
                    $sql1 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                    VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                    $res1 = mysqli_query($con, $sql1);
                }
                $sv = 1;
                require "smanagers.php";
            }
        }
        else
        {
            $stmt = 'Please select any vendor to verify it!';
            require 'smanagers.php';
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

// Suspend Non-Verified Products - Start
// Suspend Verified Products - Start

function snvp()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $roleid = $_SESSION['roleid'];
        $status = $_POST['pstatus'];
        if($status == '0' && !empty($_POST['selectnvp']))
        {
            $pid = $_POST['selectnvp'];
            foreach($pid as $id)
            {
                $sql1 = "UPDATE products SET is_verified = '2' WHERE pid = '$id'";
                $res1 = mysqli_query($con, $sql1);
                $log_a = 'Suspended';
                $log_o = 'Non-Verified Product';
                $sql3 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                $res3 = mysqli_query($con, $sql3);
            }
            if($res1 == true)
            {
                $nvs = 1;
                require "nvproducts.php";
            }
        }

        elseif($status == '1' && !empty($_POST['selectvp']))
        {
            $pid = $_POST['selectvp'];
            foreach($pid as $id)
            {
                $sql1 = "UPDATE products SET is_verified = '2' WHERE pid = '$id'";
                $res1 = mysqli_query($con, $sql1);
                if($roleid == '1')
                {
                    $log_a = 'Suspended';
                    $log_o = 'Verified Product';
                    $sql3 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                    VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                    $res3 = mysqli_query($con, $sql3);
                }
                elseif($roleid == '2')
                {
                    $log_a = 'Suspended';
                    $log_o = 'Verified Product';
                    $sql3 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                    VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                    $res3 = mysqli_query($con, $sql3);
                }
            }
            if($res1 == true)
            {
                $vs = 1;
                require "vproducts.php";
            }
        }
        else
        {
            $stmt = 'Please select any product to suspend it!';
            if($status == '0')
            {
                require "nvproducts.php";
            }
            elseif($status == '1')
            {
                require "vproducts.php";
            }
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

// Suspend Non-Verified Products - End
// Suspend Verified Products - End

// Remove Non-Verified Products - Start,
// Remove Verified Products - Start, and
// Remove Suspended Products - Start

function rp()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $roleid = $_SESSION['roleid'];
        $status = $_POST['pstatus'];
        if($status >= '0')
        {
            if($status == '0' && !empty($_POST['selectnvp']))
            {
                $pid = $_POST['selectnvp'];
                foreach($pid as $id)
                {
                    $sql1 = "DELETE FROM products WHERE pid = '$id'";
                    $res1 = mysqli_query($con, $sql1);
                    if($roleid == '1')
                    {
                        $log_a = 'Removed';
                        $log_o = 'Non-Verified Product';
                        $sql3 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                        VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                        $res3 = mysqli_query($con, $sql3);
                    }
                    elseif($roleid == '2')
                    {
                        $log_a = 'Removed';
                        $log_o = 'Non-Verified Product';
                        $sql3 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                        VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                        $res3 = mysqli_query($con, $sql3);
                    }
                }
                if($res1 == true)
                {
                    $nvr = 1;
                    require "nvproducts.php";
                }
            }

            elseif($status == '1' && !empty($_POST['selectvp']))
            {
                $pid = $_POST['selectvp'];
                foreach($pid as $id)
                {
                    $sql1 = "DELETE FROM products WHERE pid = '$id'";
                    $res1 = mysqli_query($con, $sql1);
                    if($roleid == '1')
                    {
                        $log_a = 'Removed';
                        $log_o = 'Verified Product';
                        $sql3 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                        VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                        $res3 = mysqli_query($con, $sql3);
                    }
                    elseif($roleid == '2')
                    {
                        $log_a = 'Removed';
                        $log_o = 'Verified Product';
                        $sql3 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                        VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                        $res3 = mysqli_query($con, $sql3);
                    }
                }
                if($res1 == true)
                {
                    $vr = 1;
                    require "vproducts.php";
                }
            }

            elseif($status == '2' && !empty($_POST['selectsp']))
            {
                $pid = $_POST['selectsp'];
                foreach($pid as $id)
                {
                    $sql1 = "DELETE FROM products WHERE pid = '$id'";
                    $res1 = mysqli_query($con, $sql1);
                    if($roleid == '1')
                    {
                        $log_a = 'Removed';
                        $log_o = 'Suspended Product';
                        $sql3 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                        VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                        $res3 = mysqli_query($con, $sql3);
                    }
                    elseif($roleid == '2')
                    {
                        $log_a = 'Removed';
                        $log_o = 'Suspended Product';
                        $sql3 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                        VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                        $res3 = mysqli_query($con, $sql3);
                    }
                }
                if($res1 == true)
                {
                    $sr = 1;
                    require "sproducts.php";
                }
            }
            else
            {
                $stmt = 'Please select any product to remove it!';
                if($status == '0')
                {
                    require "nvproducts.php";
                }
                elseif($status == '1')
                {
                    require "vproducts.php";
                }
                elseif($status == '2')
                {
                    require "sproducts.php";
                }
            }
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

// Remove Non-Verified Products - End,
// Remove Verified Products - End, and
// Remove Suspended Products - End

function rurm()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $roleid = $_SESSION['roleid'];
        $rid = $_POST['rid'];

        if($rid == '3')
        {
            $status = $_POST['ustatus'];

            if($status == '0' && !empty($_POST['selectnvu']))
            {
                $idu = $_POST['selectnvu'];
                foreach($idu as $id)
                {
                    $sql = "DELETE FROM users WHERE uid = '$id'";
                    $res = mysqli_query($con, $sql);
                }
                if($res == true)
                {
                    if($roleid == '1')
                    {
                        $log_a = 'Removed';
                        $log_o = 'Non-Verified User';
                        $sql1 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                        VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                        $res1 = mysqli_query($con, $sql1);
                    }
                    $nvr = 1;
                    require "nvusers.php";
                }
            }
            elseif($status == '1' && !empty($_POST['selectvu']))
            {
                $idu = $_POST['selectvu'];
                foreach($idu as $id)
                {
                    $sql = "DELETE FROM users WHERE uid = '$id'";
                    $res = mysqli_query($con, $sql);
                }
                if($res == true)
                {
                    if($roleid == '1')
                    {
                        $log_a = 'Removed';
                        $log_o = 'Verified User';
                        $sql1 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                        VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                        $res1 = mysqli_query($con, $sql1);
                    }
                    $vr = 1;
                    require "vusers.php";
                }
            }
            else
            {
                $stmt = 'Please select any user to remove it!';
                if($status == '0')
                {
                    require "nvusers.php";
                }
                elseif($status == '1')
                {
                    require "vusers.php";
                }
            }
        }

        elseif($rid == '2')
        {
            $status = $_POST['mstatus'];
            
            if($status == '1' && !empty($_POST['selectvm']))
            {
                $idm = $_POST['selectvm'];
                foreach($idm as $id)
                {
                    $sql = "DELETE FROM users WHERE uid = '$id'";
                    $res = mysqli_query($con, $sql);
                }
                if($res == true)
                {
                    if($roleid == '1')
                    {
                        $log_a = 'Removed';
                        $log_o = 'Verified Vendor';
                        $sql1 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                        VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                        $res1 = mysqli_query($con, $sql1);
                    }
                    $vr = 1;
                    require "vmanagers.php";
                }
            }
            elseif($status == '2' && !empty($_POST['selectsm']))
            {
                $idm = $_POST['selectsm'];
                foreach($idm as $id)
                {
                    $sql = "DELETE FROM users WHERE uid = '$id'";
                    $res = mysqli_query($con, $sql);
                }
                if($res == true)
                {
                    if($roleid == '1')
                    {
                        $log_a = 'Removed';
                        $log_o = 'Suspended Vendor';
                        $sql1 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                        VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                        $res1 = mysqli_query($con, $sql1);
                    }
                    $sr = 1;
                    require "smanagers.php";
                }
            }
            else
            {
                $stmt = 'Please select any vendor to remove it!';
                if($status == '1')
                {
                    require "vmanagers.php";
                }
                elseif($status == '2')
                {
                    require "smanagers.php";
                }
            }
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function vnvu()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $roleid = $_SESSION['roleid'];
        $status = $_POST['ustatus'];
        if($status == '0' && !empty($_POST['selectnvu']))
        {
            $idu = $_POST['selectnvu'];
            foreach($idu as $id)
            {
                $sql = "UPDATE users SET is_verified = '1' WHERE uid = '$id'";
                $res = mysqli_query($con, $sql);
            }
            if($res == true)
            {
                if($roleid == '1')
                {
                    $log_a = 'Verified';
                    $log_o = 'Non-Verified User';
                    $sql1 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                    VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                    $res1 = mysqli_query($con, $sql1);
                }
                $nvv = 1;
                require "nvusers.php";
            }
        }
        else
        {
            $stmt = 'Please select any user to verify it!';
            require 'nvusers.php';
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

// function vamnvu()
// {
//     if(isset($_SESSION['uid']))
//     {
//         global $con;

//         $status = $_SESSION['ustatus'];
//         if($status == '0')
//         {
//             $uid = $_POST['selectnvu'];
//             foreach($uid as $id)
//             {
//                 $sql = "UPDATE users SET roleid = '2', is_verified = '1' WHERE uid = '$id'";
//                 $res = mysqli_query($con, $sql);
//             }
//             if($res == true)
//             {
//                 $nvvm = 1;
//                 require "nvusers.php";
//             }
//         }
//     }
//     else
//     {
//         header('Location: http://localhost/Projects/ecart/index.php');
//     }
// }

function svm()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $roleid = $_SESSION['roleid'];
        $status = $_POST['mstatus'];
        if($status == '1' && !empty($_POST['selectvm']))
        {
            $idm = $_POST['selectvm'];
            foreach($idm as $id)
            {
                $sql = "UPDATE users SET is_verified = '2' WHERE uid = '$id'";
                $res = mysqli_query($con, $sql);
            }
            if($res == true)
            {
                if($roleid == '1')
                {
                    $log_a = 'Suspended';
                    $log_o = 'Verified Vendor';
                    $sql1 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                    VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                    $res1 = mysqli_query($con, $sql1);
                }
                $vs = 1;
                require "vmanagers.php";
            }
        }
        else
        {
            $stmt = 'Please select any vendor to suspend it!';
            require 'vmanagers.php';
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function pdetailform()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $page = 1;
        $pid = $_GET['pdetailform'];
        require "productdetail.php";
    }
    else
    {
        $page = 1;
        $pid = $_GET['pdetailform'];
        header('Location: http://localhost/Projects/ecart/productdetail.php?user='.$pid.'&usr='.$page);
    }
}

function editproductform()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $_SESSION['pid'] = $_GET['editproductform'];
        $pid = $_SESSION['pid'];
        $sql1 = "SELECT * FROM products WHERE pid = '$pid'";
        $res1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_array($res1);
        $pimg = $row1['pimage'];
        $pname = $row1['pname'];
        $ptype = $row1['ptype'];
        $pcat = $row1['pcategory'];
        $pbrd = $row1['pbrand'];
        $pprc = $row1['pprice'];
        $pqnt = $row1['pquantity'];
        $pdes = $row1['pdiscription'];

        require "editproduct.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function editproduct()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $roleid = $_SESSION['roleid'];
        $pid = $_SESSION['pid'];
        $pnm1 = $_POST['pnm1'];
        $ptp1 = $_POST['ptp1'];
        $pcat1 = $_POST['pcat1'];
        $pbrd1 = $_POST['pbrd1'];
        $pp1 = $_POST['pp1'];
        $pq1 = $_POST['pq1'];
        $pdes1 = $_POST['pdes1'];

        $pimg1 = 'images/'.basename($_FILES['pimg1']['name']);
        $pimg1FileType = strtolower(pathinfo($pimg1, PATHINFO_EXTENSION));

        if(!empty($pnm1) && !empty($ptp1) && !empty($pcat1) && !empty($pbrd1) && !empty($pp1) && !empty($pq1) && !empty($pdes1))
        {
            if(!empty($pimg1FileType))
            {
                if($pimg1FileType != 'jpg' && $pimg1FileType != 'png' && $pimg1FileType != 'jpeg' && $pimg1FileType != 'gif' && $pimg1FileType != 'webp')
                {
                    header('Location: http://localhost/Projects/ecart/editprofile.php?msg1=***Image should be in .jpg, .png, .jpeg, .webp or .gif format.');
                }
                else
                {
                    if(move_uploaded_file($_FILES['pimg1']['tmp_name'], $pimg1))
                    {
                        $sql1 = "UPDATE products SET pimage = '$pimg1' WHERE pid = '$pid'";
                        $res1 = mysqli_query($con, $sql1);
                    }
                }
            }
            $sql2 = "UPDATE products SET pname = '$pnm1', ptype = '$ptp1', pcategory = '$pcat1', pbrand = '$pbrd1', pprice = '$pp1', pquantity = '$pq1', pdiscription = '$pdes1' WHERE pid = '$pid'";
            $res2 = mysqli_query($con, $sql2);
            if($res2 == true)
            {
                $sql3 = "SELECT is_verified FROM products WHERE pid = '$pid'";
                $res3 = mysqli_query($con, $sql3);
                $row3 = mysqli_fetch_array($res3);
                $status = $row3['is_verified'];
                if($status == '1')
                {
                    $log_a = 'Edited';
                    $log_o = 'Verified Product';
                    $sql1 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                    VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                    $res1 = mysqli_query($con, $sql1);
                    require "vproducts.php";
                }
                elseif($status == '0')
                {
                    $log_a = 'Edited';
                    $log_o = 'Non-Verified Product';
                    $sql1 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                    VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                    $res1 = mysqli_query($con, $sql1);
                    require "nvproducts.php";
                }
                elseif($status == '2')
                {
                    $log_a = 'Edited';
                    $log_o = 'Suspended Product';
                    $sql1 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                    VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                    $res1 = mysqli_query($con, $sql1);
                    require "sproducts.php";
                }
            }
        }
        else
        {
            header('Location: http://localhost/Projects/ecart/editprofile.php?msg1=***All fields are mandatory');
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function editumform()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $id = $_GET['editumform'];
    
        $sql = "SELECT * FROM users WHERE uid = '$id'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($res);
        $uname = $row['uname'];
        $umobile = $row['umobile'];
        $uemail = $row['uemail'];
        $upass = $row['upassword'];
        $uadd = $row['uaddress'];
        $rlid = $row['roleid'];
        $uimg = $row['uimage'];
    
        require "editum.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function editum()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $roleid = $_SESSION['roleid'];
        $id1 = $_POST['id1'];
        $unm1 = $_POST['unm1'];
        $umb1 = $_POST['umb1'];
        $uem1 = $_POST['uem1'];
        $upwd1 = $_POST['upwd1'];
        $uadd1 = $_POST['uadd1'];

        $uimg1 = 'images/'.basename($_FILES['uimg1']['name']);
        $uimg1FileType = strtolower(pathinfo($uimg1, PATHINFO_EXTENSION));

        if(!empty($unm1) && !empty($umb1) && !empty($uem1) && !empty($upwd1) && !empty($uadd1))
        {
            if(!empty($uimg1FileType))
            {
                if($uimg1FileType != 'jpg' && $uimg1FileType != 'png' && $uimg1FileType != 'jpeg' && $uimg1FileType != 'gif' && $uimg1FileType != 'webp')
                {
                    header('Location: http://localhost/Projects/ecart/editum.php?msg1=***Image should be in .jpg, .png, .jpeg, .webp or .gif format.');
                }
                else
                {
                    if(move_uploaded_file($_FILES['uimg1']['tmp_name'], $uimg1))
                    {
                        $sql1 = "UPDATE users SET uimage = '$uimg1' WHERE uid = '$id1'";
                        $res1 = mysqli_query($con, $sql1);
                    }
                }
            }
            $sql2 = "UPDATE users SET uname = '$unm1', umobile = '$umb1', uemail = '$uem1', upassword = '$upwd1', uaddress = '$uadd1' WHERE uid = '$id1'";
            $res2 = mysqli_query($con, $sql2);
            if($res2 == true)
            {
                $sql3 = "SELECT roleid, is_verified FROM users WHERE uid = '$id1'";
                $res3 = mysqli_query($con, $sql3);
                $row3 = mysqli_fetch_array($res3);
                $status = $row3['is_verified'];
                $role = $row3['roleid'];
                if($status == '1')
                {
                    if($role == '3')
                    {
                        if($roleid == '1')
                        {
                            $log_a = 'Edited';
                            $log_o = 'Verified User';
                            $sql1 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                            VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                            $res1 = mysqli_query($con, $sql1);
                        }
                        require "vusers.php";
                    }
                    elseif($role == '2')
                    {
                        if($roleid == '1')
                        {
                            $log_a = 'Edited';
                            $log_o = 'Verified Vendor';
                            $sql1 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                            VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                            $res1 = mysqli_query($con, $sql1);
                        }
                        require 'vmanagers.php';
                    }
                }
                elseif($status == '0')
                {
                    if($roleid == '1')
                    {
                        $log_a = 'Edited';
                        $log_o = 'Non-Verified User';
                        $sql1 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                        VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                        $res1 = mysqli_query($con, $sql1);
                    }
                    require "nvusers.php";
                }
                elseif($status == '2')
                {
                    if($roleid == '1')
                    {
                        $log_a = 'Edited';
                        $log_o = 'Suspended Vendor';
                        $sql1 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                        VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                        $res1 = mysqli_query($con, $sql1);
                    }
                    require "smanagers.php";
                }
            }
        }
        else
        {
            header('Location: http://localhost/Projects/ecart/editum.php?msg1=***All fields are mandatory');
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function index()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $page = 1;
        require "index.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function addtocartform()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        require "usercart.php";
    }
    else
    {
        $pid = $_GET['addtocartform'];
        header('Location: http://localhost/Projects/ecart/productdetail.php?user='.$pid);
    }
}

function addtocart()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $pid = $_GET['addtocart'];
        $sql1 = "SELECT * FROM products WHERE pid = '$pid'";
        $res1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_array($res1);
        $pimg = $row1['pimage'];
        $pnm = $row1['pname'];
        $pp = $row1['pprice'];
        
        if(!empty($uid) && !empty($pid) && !empty($pimg) && !empty($pnm) && !empty($pp))
        {
            $sql3 = "INSERT INTO shop_cart(uid, pid, pimage, pname, pprice) VALUES('$uid', '$pid', '$pimg', '$pnm', '$pp')";
            $res3 = mysqli_query($con, $sql3);
        }
        header('Location: http://localhost/Projects/ecart/usercart.php');
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php?logform');
    }
}

function buynow()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $gamount = $_GET['buynow'];
        require "billaddress.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php?logform');
    }
}

function checkoutform()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $gamount = $_POST['gamount'];
        $uid = $_SESSION['uid'];
        $sql1 = "SELECT * FROM users WHERE uid = '$uid'";
        $res1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_array($res1);
        $address = $row1['uaddress'];
        if(!empty($uid) && !empty($address))
        {
            $sql3 = "SELECT * FROM bill_address WHERE uid = '$uid'";
            $res3 = mysqli_query($con, $sql3);
            $row3 = mysqli_fetch_array($res3);
            $baddress = $row3['baddress'];
            if($baddress == $address)
            {
                require "billaddress.php";
            }
            else
            {
                $sql2 = "INSERT INTO bill_address(uid, baddress) VALUES('$uid', '$address')";
                $res2 = mysqli_query($con, $sql2);
                if($res2 == true)
                {
                    require "billaddress.php";
                }
            }
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function acbilladd()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $badd = $_POST['billadd'];
        if(!empty($uid) && !empty($badd))
        {
            $sql1 = "SELECT baddress FROM bill_address WHERE uid = '$uid'";
            $res1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_array($res1);
            $baddress = $row1['baddress'];
            if($baddress == $badd)
            {
                header('Location: http://localhost/Projects/ecart/billaddress.php?msg2=This address is already exist!');
            }
            else
            {
                $sql = "UPDATE bill_address SET baddress = '$badd' WHERE uid = '$uid'";
                $res = mysqli_query($con, $sql);
                if($res == true)
                {
                    require "billaddress.php";
                }
            }
        }
        else
        {
            header('Location: http://localhost/Projects/ecart/billaddress.php?msg2=Fields are Mandatory!');
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function paymentdash()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        require "paymentdash.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function rvw()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $page = 1;
        $uid = $_SESSION['uid'];
        $rvw = $_POST['rvw'];
        $pid = $_GET['pid'];
        if(!empty($rvw))
        {
            $sql = "INSERT INTO reviews(pid, uid, rreview) VALUES('$pid', '$uid', '$rvw')";
            $res = mysqli_query($con, $sql);
            if($res == true)
            {
                // header('Location: http://localhost/Projects/ecart/productdetail.php?user='.$pid);
                require "productdetail.php";
            }
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php?logform');
    }
}

function managereviewsform()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $roleid = $_SESSION['roleid'];
        $sql1 = "SELECT new_old, a_new_old FROM reviews";
        $res1 = mysqli_query($con, $sql1);
        foreach($res1 as $row1)
        {
            if($roleid == '2')
            {
                $sql2 = "UPDATE reviews INNER JOIN products ON reviews.pid = products.pid 
                SET reviews.new_old = 'old' WHERE products.uid = '$uid'";
            }
            elseif($roleid == '1')
            {
                $sql2 = "UPDATE reviews SET a_new_old = 'old'";
            }
            $res2 = mysqli_query($con, $sql2);
        }
        require "managereviews.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function reviewform()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        require "userreviews.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function orderform()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        require "userorders.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function cod()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $value = $_GET['cod'];
        $uid = $_SESSION['uid'];
        $x = 'KUSHOP';
        $y = rand(0, 1000000);
        date_default_timezone_set('Asia/Kolkata');
        $z = date('dmyhis');
        $xyz = $x.$y.$z;
    
        $sql1 = "SELECT * FROM shop_cart WHERE uid = '$uid'";
        $res1 = mysqli_query($con, $sql1);
        foreach($res1 as $row1)
        {
            $pid = $row1['pid'];
    
            $sql2 = "INSERT INTO orders(oid, ovalue, pid, uid) VALUES('$xyz', '$value', '$pid', '$uid')";
            $res2 = mysqli_query($con, $sql2);
        }
        $sql3 = "DELETE FROM shop_cart WHERE uid = '$uid'";
        $res3 = mysqli_query($con, $sql3);
    
        $cod = 1;
        require "userorders.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function manageordersform()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $roleid = $_SESSION['roleid'];
        $sql1 = "SELECT new_old, a_new_old FROM orders";
        $res1 = mysqli_query($con, $sql1);
        foreach($res1 as $row1)
        {
            if($roleid == '2')
            {
                $sql2 = "UPDATE orders INNER JOIN products ON products.pid = orders.pid 
                SET orders.new_old = 'old' WHERE products.uid = '$uid'";
            }
            elseif($roleid == '1')
            {
                $sql2 = "UPDATE orders SET a_new_old = 'old'";
            }
            $res2 = mysqli_query($con, $sql2);
        }
        require "manageorders.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function updateucartquan()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $cid = $_GET['updateucartquan'];
        $quan = $_POST['quan'];
    
        $sql1 = "UPDATE shop_cart SET pquantity = '$quan' WHERE cid = '$cid' and uid = '$uid'";
        $res1 = mysqli_query($con, $sql1);
        if($res1 == true)
        {
            require "usercart.php";
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function delucartproduct()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $cid = $_GET['delucartproduct'];
        $uid = $_SESSION['uid'];
    
        $sql1 = "DELETE FROM shop_cart WHERE cid = '$cid' and uid = '$uid'";
        $res1 = mysqli_query($con, $sql1);
        if($res1 == true)
        {
            require "usercart.php";
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function amostatus()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $roleid = $_SESSION['roleid'];
        $amstatus = $_POST['amstatus'];
        $osno = $_POST['osno'];

        $sql1 = "UPDATE orders SET sid = '$amstatus' WHERE order_sno = '$osno'";
        $res1 = mysqli_query($con, $sql1);
        if($res1 == true)
        {
            if($amstatus == '1')
            {
                $log_a = 'Processed';
                $log_o = 'Order';
                $sql2 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                $res2 = mysqli_query($con, $sql2);
            }
            elseif($amstatus == '2')
            {
                $log_a = 'Confirmed';
                $log_o = 'Order';
                $sql2 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                $res2 = mysqli_query($con, $sql2);
            }
            elseif($amstatus == '3')
            {
                $log_a = 'Shipped';
                $log_o = 'Order';
                $sql2 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                $res2 = mysqli_query($con, $sql2);
            }
            elseif($amstatus == '4')
            {
                $log_a = 'Delivered';
                $log_o = 'Order';
                $sql2 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
                VALUES('$log_a', '$uid', '$log_o', '$roleid')";
                $res2 = mysqli_query($con, $sql2);
            }
            require "manageorders.php";
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function amocancel()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $uid = $_SESSION['uid'];
        $roleid = $_SESSION['roleid'];
        $osno = $_GET['amocancel'];
        if($roleid == '1')
        {
            $sql1 = "UPDATE orders SET sid = '5' WHERE order_sno = '$osno'";
            $res1 = mysqli_query($con, $sql1);
        }
        elseif($roleid == '2')
        {
            $sql1 = "UPDATE orders SET sid = '6' WHERE order_sno = '$osno'";
            $res1 = mysqli_query($con, $sql1);
        }
        if($res1 == true)
        {
            $log_a = 'Cancelled';
            $log_o = 'Order';
            $sql2 = "INSERT INTO logs(log_activity, logged_by, log_object, roleid) 
            VALUES('$log_a', '$uid', '$log_o', '$roleid')";
            $res2 = mysqli_query($con, $sql2);
            require "manageorders.php";
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function ucancel()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $osno = $_GET['ucancel'];
    
        $sql1 = "UPDATE orders SET is_cancelled = '1' WHERE order_sno = '$osno'";
        $res1 = mysqli_query($con, $sql1);
        if($res1 == true)
        {
            require "userorders.php";
        }
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function c()
{
    if(isset($_SESSION['uid']))
    {
        global $con; 

        $page = 1;
        $c = $_GET['c'];
        require "index.php";
    }
    else
    {
        global $con; 

        $c = $_GET['c'];
        header('Location: http://localhost/Projects/ecart/index.php?c='.$c);
    }
}

function b()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $page = 1;
        $b = $_GET['b'];
        require "index.php";
    }
    else
    {
        global $con;

        $b = $_GET['b'];
        header('Location: http://localhost/Projects/ecart/index.php?b='.$b);
    }
}

function search()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $page = 1;
        $key = $_POST['key'];
        require "index.php";
    }
    else
    {
        global $con;

        $key = $_POST['key'];
        header('Location: http://localhost/Projects/ecart/index.php?index='.$key);
    }
}

function nform()
{
    if(isset($_SESSION['uid']))
    {
        global $con;

        $sql1 = "SELECT new_old FROM logs";
        $res1 = mysqli_query($con, $sql1);
        foreach($res1 as $row1)
        {
            $sql2 = "UPDATE logs SET new_old = 'old'";
            $res2 = mysqli_query($con, $sql2);
        }
        require "notification.php";
    }
    else
    {
        header('Location: http://localhost/Projects/ecart/index.php');
    }
}

function logout()
{
    global $con;

    session_unset();
    session_destroy();
    header("Location: http://localhost/Projects/ecart/index.php");
}

?>