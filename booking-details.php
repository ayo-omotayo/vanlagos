<?php ob_start(); session_start();
if (!isset($_SESSION['booking'])) header('Location: booking');
include_once('inc/header.nav.php');
?>
<style>
    #agreeTerms-error{text-align: center}
    .table{width: unset; !important;}
    .table th{padding: 0.4em; !important;}
    #seller_account_details {transition: all 200ms ease-in-out;transform-origin: top;}
    #payment_method_true {transition: all 200ms ease-in-out;transform-origin: top;}
    #seller_account_details.hide {position: absolute;right: 0;left: 0;transform: scaleY(0);opacity: 0; }
    #payment_method_true.hide {position: absolute;right: 0;left: 0;transform: scaleY(0);opacity: 0; }
</style>
<main class="user-profile-container mb-5">
    <section class="select-bus-page-header">
        <div class="container text-white py-2">
            <div class="clearfix">
                <span class="float-md-left">
                    <h5>Pick up location:&nbsp;<span><?= $_SESSION['booking']['pa']; ?> - <?= $_SESSION['booking']['ps']; ?></span></h5>
                    <p>Pick up date and time:&nbsp;<span><?= date("d F Y",strtotime($_SESSION['booking']['pd'])); ?>, <?= $_SESSION['booking']['pt']; ?></span></p>
                </span>
                <span class="float-md-right">
                    <h5>Destination location:&nbsp;<span><?= $_SESSION['booking']['da']; ?> - <?= $_SESSION['booking']['ds']; ?></span></h5>
                    <p>No of hours:&nbsp;<span>
                        <?php if ($_SESSION['booking']['nh']==8){ echo "Full Day";} else {echo $_SESSION['booking']['nh'];} ?>
                        </span>
                    </p>
                </span>
            </div>
        </div>
        <div class="select-bus-condition-wrapper py-2">
            <div class="container">
                <p class="m-0 text-white">
                    <?php
                    if ($_SESSION['booking']['st']=='van hire'){
                        echo "₦10,000 for 3hrs (<small>₦5000 for each additional hour</small>)";
                        echo "<p class='m-0 py-3 text-white'>Customers should ensure that the receipts/invoice of items transported is available and the Items being transported 
                        are not stolen or illegal and the customer will be held responsible if found in breach of this agreement and in possession 
                        of any stolen property</p>";
                    }
                    if ($_SESSION['booking']['st']=='bus hire'){ echo "₦15,000 for 3hrs (<small>₦5000 for each additional hour</small>)"; }
                    if ($_SESSION['booking']['st']=='car hire'){ echo "₦5,000 for 3hrs (<small>₦2000 for each additional hour</small>)"; }
                    ?>
                </p>
            </div>
        </div>
    </section>
    <section>
        <div class="container my-5">
            <form name="booking_details_form" id="booking_details_form">
                <div class="row my-2">
                    <div class="col-12 col-md-7 mb-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header leftspan">PERSONAL DETAILS</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="firstname" class="m-0 myLabel">Firstname</label>
                                                <input type="hidden" name="service_type" id="service_type" value="<?=$_SESSION['booking']['st']?>">
                                                <input type="text" name="firstname" id="firstname" value="<?=isset($_SESSION['user_login']['firstname'])?$_SESSION['user_login']['firstname']:'';?>">
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="lastname" class="m-0 myLabel">Lastname</label>
                                                <input type="text" name="lastname" id="lastname" value="<?=isset($_SESSION['user_login']['lastname'])?$_SESSION['user_login']['lastname']:'';?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-3 mb-3">
                                                <label for="gender" class="m-0 myLabel">Gender</label>
                                                <div class="select_drop_wrapper border fontawesome-pseudo py-1">
                                                    <select class="border-0" name="gender" id="gender">
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-5 mb-3">
                                                <label for="email" class="m-0 myLabel">Email Address</label>
                                                <input type="hidden" id="user_id" value="<?=isset($_SESSION['user_login']['user_id'])?$_SESSION['user_login']['user_id']:'';?>">
                                                <input type="email" name="email" id="email" value="<?=isset($_SESSION['user_login']['email'])?$_SESSION['user_login']['email']:'';?>">
                                            </div>
                                            <div class="col-12 col-md-4 mb-3">
                                                <label for="phone" class="m-0 myLabel">Phone number</label>
                                                <input type="text" name="phone" id="phone" value="<?=isset($_SESSION['user_login']['phone'])?$_SESSION['user_login']['phone']:'';?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($_SESSION['booking']['st']=='van hire'){ ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card mt-4">
                                    <div class="card-header">PACKAGE DETAILS</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label for="pac_desc"><span class="myLabel">Description</span>
                                                    <small>(kindly let us know the kind of product)</small></label>
                                                <input type="text" name="pac_desc" id="pac_desc">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label for="fragile" class="myLabel">Fragile</label>
                                                <div class="d-flex">
                                                    <div class="col-4 col-md-3 p-0">
                                                        <input type="radio" class="rej_radio" name="fragile" id="fragile_yes" value="Yes">
                                                        <label for="fragile_yes" class="d-flex"><span class="customRadio fontawesome-pseudo"></span>Yes</label>
                                                    </div>
                                                    <div class="col-4 col-md-3 p-0">
                                                        <input type="radio" class="rej_radio" name="fragile" id="fragile_no" value="No" checked>
                                                        <label for="fragile_no" class="d-flex"><span class="customRadio fontawesome-pseudo"></span>No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="checkbox" class="rej_checkbox" name="special_fee" id="special_fee">
                                                <label for="special_fee" class="d-flex" id="special_fee_label">
                                                    <span class="customCheck fontawesome-pseudo"></span>Help in loading and offloading (fee of ₦2,000)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-12 mt-4">
                                <div class="card border-0" style="background-color: unset">
                                    <div class="card-body">
                                        <input type="checkbox" class="rej_checkbox" name="agreeTerms" id="agreeTerms">
                                        <label for="agreeTerms" class="d-flex myLabel">
                                            <span class="customCheck fontawesome-pseudo"></span>I agree to the&nbsp;<a href="#" class="regular-link">terms & condition</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card my-2 rounded-0 hide" id="payment_method_true">
                            <div class="card-header bg-white">SELECT PAYMENT METHOD</div>
                            <div class="card-body">
                                <div>
                                    <input type="radio" class="rej_radio" name="payment_option" id="bankTransfer" value="bankTransfer" checked>
                                    <label for="bankTransfer" class="d-flex"><span class="customRadio fontawesome-pseudo"></span>Bank Transfer</label>

                                    <div class="row px-4 show" id="seller_account_details">
                                        <div class="col-12 col-sm-12">
                                            <table class="table table-borderless">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Bank Name:</th>
                                                    <th scope="col">Zenith Bank plc</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Account Name:</th>
                                                    <th scope="col">POSTMAILTRANSIT LTD</th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Account Number:</th>
                                                    <th scope="col">9846234563</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <input type="radio" class="rej_radio" name="payment_option" value="gtPay" id="gtPay">
                                    <label for="gtPay" class="d-flex"><span class="customRadio fontawesome-pseudo"></span>GT Pay</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div>
                            <div class="card rounded-top">
                                <div class="card-header leftspan">Summary</div>
                                <div class="card-body py-2">
                                    <div>
                                        <span class="font-weight-bold">Price </span>
                                        <span class="float-right font-weight-bolder">₦<?=number_format($_SESSION['booking']['price'],0)?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-0">
                                <div class="card-body py-2">
                                    <div class="font-weight-bold">Pick up date and time:</div>
                                    <div><span><?= date("d F Y",strtotime($_SESSION['booking']['pd'])); ?>, <?= $_SESSION['booking']['pt']; ?></span></div>
                                </div>
                            </div>
                            <div class="card rounded-0">
                                <div class="card-body py-2">
                                <div class="font-weight-bold">No of hours:</div>
                                <div><?php if ($_SESSION['booking']['nh']==8){ echo "Full Day";} else {echo $_SESSION['booking']['nh'];} ?></div>
                            </div>
                            <div class="card rounded-0">
                                <div class="card-body py-2">
                                    <div class="font-weight-bold">Service type:</div>
                                    <div><?=$_SESSION['booking']['st']?></div>
                                </div>
                            </div>
                            <div class="card rounded-0 offLoading d-none">
                                <div class="card-body">
                                    <div class="">
                                        <span>Load off-loader fee</span>
                                        <span class="float-right font-weight-bolder">₦ 2,000</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-0">
                                <div class="card-body">
                                    <div class="">
                                        <span class="font-weight-bold">Total to Pay</span>
                                        <span class="float-right font-weight-bolder">₦ <span id="totalPay"><?= number_format($_SESSION['booking']['price'],0); ?></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-7">
                        <button type="button" class="btn custom-form-btn" onclick="goBack()">Back</button>
                        <button type="submit" class="btn grey-btn float-right px-4" id="conBtn" disabled>
                            Continue
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>

<!-- Modal -->
<div class="modal fade" id="payWithTransfer" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="staticBackdropLabel">Enter sender account name( If transfer has been made)</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="pay_with_transfer" id="pay_with_transfer">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="account_name" class="col-form-label">Sender Account Name:</label>
                        <input type="text" class="form-control" id="account_name" name="account_name">
                    </div>
                    <div class="form-group">
                        <label for="amount_transferred" class="col-form-label">Amount</label>
                        <input readonly type="text" class="form-control" id="amount_transferred" name="amount_transferred" value="<?= $_SESSION['booking']['price']; ?>">
                    </div>
                </div>
                <input type="hidden" name="booking_num" id="booking_num" value="<?= (isset($_SESSION['booking']['bn']))? $_SESSION['booking']['bn']:null; ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn custom-form-btn px-4" id="transferBtn">
                        <i class="fa fa-spinner fa-pulse mr-3 d-none"></i>Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once('inc/footer.nav.php'); ?>
<script>
    function removeHide(firstArg, secondArg) {
        if (firstArg) {
            if (secondArg.hasClass("hide")) {secondArg.removeClass("hide")}
        } else {secondArg.addClass("hide"); }
    }
    function addHide(firstArg, secondArg) {
        if (firstArg) {
            if (!secondArg.hasClass("hide")) {secondArg.addClass("hide");}
        } else {secondArg.removeClass("hide")}
    }

    var agreeCheckButton = document.getElementById("agreeTerms");
    var paymentOption = $("#payment_method_true");

    $("#agreeTerms").on("click", function () {
        if (agreeCheckButton.checked === true) {
            removeHide(agreeCheckButton, paymentOption);
            $("#conBtn").attr("disabled",false); $("#conBtn").addClass("custom-form-btn"); $("#conBtn").removeClass("grey-btn");
        } else {
            addHide(agreeCheckButton, paymentOption);
            $("#conBtn").attr("disabled",true); $("#conBtn").removeClass("custom-form-btn"); $("#conBtn").addClass("grey-btn");
        }
    });

    var bankAccountRadioButton = $("#bankTransfer");
    var thirdPartyRadioButton = $("#gtPay");
    var checkedThirdPartyRadioButton = $("#gtPay:checked");
    var checkedBankAccountRadioButton = $("#bankTransfer:checked");
    var sellerBankDetails = $("#seller_account_details");

    bankAccountRadioButton.on("click", function () {removeHide(checkedBankAccountRadioButton, sellerBankDetails)});
    thirdPartyRadioButton.on("click", function () {addHide(checkedThirdPartyRadioButton, sellerBankDetails)});
</script>
<script>
    $.fn.digits = function(){
        return this.each(function () {
            $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );
        });
    };

    $(document).ready(function () {
        $("#special_fee").on("click", function () {
            if ($("#special_fee").is(":checked") === true) {
                $(this).val("Yes");
                if ($(".offLoading").hasClass("d-none")) {
                    $(".offLoading").removeClass("d-none");
                }
                var total = parseFloat($('#totalPay').text().replace(",", ""));
                var totalPay = total + 2000;
                $('#totalPay').html(totalPay).digits();
                $("input[name='amount_transferred']", '#pay_with_transfer').val(totalPay);
            } else {
                $(this).val("No");
                $(".offLoading").addClass("d-none");
                var total = parseFloat($('#totalPay').text().replace(",", ""));
                var totalPay = total - 2000;
                $('#totalPay').html(totalPay).digits();
                $("input[name='amount_transferred']", '#pay_with_transfer').val(totalPay);
            }
        });
    });
</script>
