<?php 
include "controller.php";

if(isset($_POST['register']))
{
    register();
}

elseif(isset($_POST['login']))
{
    login();
}

elseif(isset($_GET['logout']))
{
    logout();
}

elseif(isset($_GET['profile']))
{
    profile();
}

elseif(isset($_GET['editprofileform']))
{
    editprofileform();
}

elseif(isset($_POST['changep']))
{
    changep();
}

elseif(isset($_POST['editprofile']))
{
    editprofile();
}

elseif(isset($_POST['editprofilephoto']))
{
    editprofilephoto();
}

elseif(isset($_POST['addvender']))
{
    addvender();
}

elseif(isset($_POST['addproduct']))
{
    addproduct();
}

elseif(isset($_GET['dashboard']))
{
    dashboard();
}

elseif(isset($_GET['nvp']))
{
    nvp();
}

elseif(isset($_GET['vp']))
{
    vp();
}

elseif(isset($_GET['sp']))
{
    sp();
}

// Verify Non-Verified Products - Start

elseif(isset($_POST['vnvp']))
{
    vnvp();
}

// Verify Non-Verified Products - End

// Verify Suspended Products - Start

elseif(isset($_POST['vsp']))
{
    vnvp();
}

// Verify Suspended Products - End

elseif(isset($_POST['usp']))
{
    usp();
}

// Suspend Verified Products - Start

elseif(isset($_POST['svp']))
{
    snvp();
}

// Suspend Verified Products - End

// Suspend Non-Verified Products - Start

elseif(isset($_POST['snvp']))
{
    snvp();
}

// Suspend Non-Verified Products - End

// Remove Verified Products - Start

elseif(isset($_POST['rvp']))
{
    rp();
}

// Remove Verified Products - End

// Remove Non-Verified Products - Start

elseif(isset($_POST['rnvp']))
{
    rp();
}

// Remove Non-Verified Products - End

// Remove Suspended Products - Start

elseif(isset($_POST['rsp']))
{
    rp();
}

// Remove Suspended Products - End

elseif(isset($_GET['allproducts']))
{
    allproducts();
}

elseif(isset($_GET['nvu']))
{
    nvu();
}

elseif(isset($_GET['vu']))
{
    vu();
}

elseif(isset($_GET['allusers']))
{
    allusers();
}

elseif(isset($_GET['sm']))
{
    sm();
}

elseif(isset($_GET['vm']))
{
    vm();
}

elseif(isset($_GET['allmanagers']))
{
    allmanagers();
}

elseif(isset($_POST['rvu']))
{
    rurm();
}

elseif(isset($_POST['vsm']))
{
    vsm();
}

elseif(isset($_POST['rsm']))
{
    rurm();
}

elseif(isset($_POST['rvm']))
{
    rurm();
}

elseif(isset($_POST['rnvu']))
{
    rurm();
}

elseif(isset($_POST['vnvu']))
{
    vnvu();
}

// elseif(isset($_POST['vamnvu']))
// {
//     vamnvu();
// }

elseif(isset($_POST['svm']))
{
    svm();
}

elseif(isset($_GET['pdetailform']))
{
    pdetailform();
}

elseif(isset($_GET['editproductform']))
{
    editproductform();
}

elseif(isset($_POST['editproduct']))
{
    editproduct();
}

elseif(isset($_GET['addtocartform']))
{
    addtocartform();
}

elseif(isset($_GET['addtocart']))
{
    addtocart();
}

elseif(isset($_GET['buynow']))
{
    buynow();
}

elseif(isset($_POST['checkoutform']))
{
    checkoutform();
}

elseif(isset($_POST['acbilladd']))
{
    acbilladd();
}

elseif(isset($_POST['paymentdash']))
{
    paymentdash();
}

elseif(isset($_GET['editumform']))
{
    editumform();
}

elseif(isset($_POST['editum']))
{
    editum();
}

elseif(isset($_POST['srvw']))
{
    rvw();
}

elseif(isset($_GET['managereviewsform']))
{
    managereviewsform();
}

elseif(isset($_GET['reviewform']))
{
    reviewform();
}

elseif(isset($_GET['orderform']))
{
    orderform();
}

elseif(isset($_GET['cod']))
{
    cod();
}

elseif(isset($_GET['manageordersform']))
{
    manageordersform();
}

elseif(isset($_POST['updateucartquan']))
{
    updateucartquan();
}

elseif(isset($_GET['delucartproduct']))
{
    delucartproduct();
}

elseif(isset($_GET['index']))
{
    index();
}

elseif(isset($_POST['amostatus']))
{
    amostatus();
}

elseif(isset($_GET['amocancel']))
{
    amocancel();
}

elseif(isset($_GET['ucancel']))
{
    ucancel();
}

elseif(isset($_GET['c']))
{
    c();
}

elseif(isset($_GET['b']))
{
    b();
}

elseif(isset($_POST['search']))
{
    search();
}

elseif(isset($_GET['nform']))
{
    nform();
}

?>