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

<div class="row col-sm-12 mt-3">
    <div class="col-sm-2">
        <div class="list-group sticky-top">
            <a href="#" class="list-group-item list-group-item-action active">Payment Options</a>
            <div class="nav flex-column nav-tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link list-group-item list-group-item-action active" id="v-pills-cc-tab" data-toggle="pill" href="#v-pills-cc" role="tab" aria-controls="v-pills-cc" aria-selected="true">Credit Card</a>
                <a class="nav-link list-group-item list-group-item-action" id="v-pills-dca-tab" data-toggle="pill" href="#v-pills-dca" role="tab" aria-controls="v-pills-dca" aria-selected="false">Debit Card / ATM</a>
                <a class="nav-link list-group-item list-group-item-action" id="v-pills-nb-tab" data-toggle="pill" href="#v-pills-nb" role="tab" aria-controls="v-pills-nb" aria-selected="false">Net Banking</a>
                <a class="nav-link list-group-item list-group-item-action" id="v-pills-upi-tab" data-toggle="pill" href="#v-pills-upi" role="tab" aria-controls="v-pills-upi" aria-selected="false">BHIM UPI</a>
            </div>
        </div>
    </div>
    <div class="col-sm-10">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-cc" role="tabpanel" aria-labelledby="v-pills-cc-tab">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-primary">Enter Credit Card Details</h2>
                    </div>
                    <form action="db.php" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Credit Card Number</label>
                                        <input type="number" name="cnum" class="form-control" min="1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Expiry Date</label>
                                        <div class="row col-sm-12">
                                            <input type="number" name="cexpm" class="col-sm-5 form-control mr-2" placeholder="MM" min="01" max="12" minlength="2" maxlength="2" pattern="\d{2}">
                                            <input type="number" name="cexpy" class="col-sm-5 form-control" placeholder="YYYY" pattern="[0-9]{4}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">CVV Code</label>
                                        <input type="number" name="ccvv" class="form-control" min="100" max="999" pattern="[0-9]{3}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Name on Credit Card</label>
                                        <input type="text" name="ccnm" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" name="ccd" value="MAKE AN ORDER" class="btn btn-lg btn-primary">
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-dca" role="tabpanel" aria-labelledby="v-pills-dca-tab">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-primary">Enter Debit Card Details</h2>
                    </div>
                    <form action="db.php" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Debit Card Number</label>
                                        <input type="number" name="dnum" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Expiry Date</label>
                                        <div class="row col-sm-12">
                                            <input type="number" name="dexpm" class="col-sm-5 form-control mr-2" placeholder="MM" min="01" max="12" pattern="[0-9]{2}">
                                            <input type="number" name="dexpy" class="col-sm-5 form-control" placeholder="YYYY" min="1900">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">CVV Code</label>
                                        <input type="number" name="dcvv" class="form-control" min="100" max="999" pattern="[0-9]{3}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Name on Debit Card</label>
                                        <input type="text" name="dcnm" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" name="dcd" value="MAKE AN ORDER" class="btn btn-lg btn-primary">
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-nb" role="tabpanel" aria-labelledby="v-pills-nb-tab">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-primary">Enter Net Banking Details</h2>
                    </div>
                    <form action="#" method="post">
                        <div class="card-body">
                            <div class="row form-group">
                                <label class="col-sm-4 col-form-label">Your Bank Name</label>
                                <select name="bnm" class="col-sm-8 form-control">
                                    <option value="#">-- Choose Bank --</option>
                                    <option value="sbi">SBI - State Bank of India</option>
                                    <option value="pnb">PNB - Punjab National Bank</option>
                                    <option value="boi">BOI - Bank Of India</option>
                                    <option value="cb">CB - Canara Bank</option>
                                    <option value="bob">BOB - Bank Of Baroda</option>
                                    <option value="ab">AXIS - Axis Bank</option>
                                    <option value="hb">HDFC - HDFC Bank</option>
                                    <option value="yb">YES - Yes Bank</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" name="nbd" value="MAKE AN ORDER" class="btn btn-lg btn-primary">
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-upi" role="tabpanel" aria-labelledby="v-pills-upi-tab">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-primary">Enter BHIM UPI Details</h2>
                    </div>
                    <form action="#" method="post">
                        <div class="card-body">
                            <div class="row form-group">
                                <label class="col-sm-4 col-form-label">Enter Your BHIM UPI ID</label>
                                <input type="text" name="upi" class="col-sm-8 form-control" placeholder="username@bankcode">
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" name="upid" value="MAKE AN ORDER" class="btn btn-lg btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>