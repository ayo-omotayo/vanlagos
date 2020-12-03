<?php
ob_start(); session_start();
header("Content-type: application/json; charset=UTF-8");
include_once('config/database.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $_SESSION['booking']['fn'] = htmlspecialchars(strip_tags($_POST['firstname']));
    $_SESSION['booking']['ln'] = htmlspecialchars(strip_tags($_POST['lastname']));
    $_SESSION['booking']['gd'] = htmlspecialchars(strip_tags($_POST['gender']));
    $_SESSION['booking']['em'] = htmlspecialchars(strip_tags($_POST['email']));
    $_SESSION['booking']['ph'] = htmlspecialchars(strip_tags($_POST['phone']));
    $_SESSION['booking']['po'] = htmlspecialchars(strip_tags($_POST['payment_option']));
    if ($_SESSION['booking']['st']=='van hire') {
        $_SESSION['booking']['pac_d'] = htmlspecialchars(strip_tags($_POST['pac_desc']));
        $_SESSION['booking']['fra'] = htmlspecialchars(strip_tags($_POST['fragile']));
        $_SESSION['booking']['loadoff'] = htmlspecialchars(strip_tags($_POST['special_fee']));
    }
    http_response_code(200);
    echo json_encode(array("status" => 200, "message" => "Done"));

} else {
    http_response_code(503);
    echo json_encode(array("status" => 503, "message" => "Access Denied"));
}