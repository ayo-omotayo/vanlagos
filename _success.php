<?php
ob_start();
session_start();
//if (!isset($_SESSION['user_login'])) header('Location: login');
include_once("inc/header.nav.php");

if (!isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != "http://localhost/vanlagos/booking-details"){
    header('Location: booking');
}
?>
<div class="user-payment-response-container py-5 my-3">
    <div class="message-container bg-white text-center p-5">
        <h5 class="my-4" style="color: #161616; font-weight: bolder">THANK YOU FOR MAKING A RESERVATION</h5>
        <p>A mail will be sent to your email address </p>
        <p class="mb-2"><b>Note:</b> It can take upto one(1) hour to confirm your transfer</p><br>
        <p><a href='./' style="color: #A8B622" class='font-weight-bolder py-3'>GO BACK TO HOME PAGE</a></p>
    </div>
</div>
<?php include_once("inc/footer.nav.php"); ?>