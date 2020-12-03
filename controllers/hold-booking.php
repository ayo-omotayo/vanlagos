<?php

header("Content-type: application/json; charset=UTF-8");
include_once('config/database.php');
include_once('classes/User.php');
include_once('classes/Bookings.php');

//create object for db
$db = new Database();

//object
$connection = $db->connect();
$user = new User($connection);
$booking = new Bookings($connection);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $st = $_POST['service_type'];
    $pa = $_POST['pickup_area'];
    $ps = $_POST['pickup_state'];
    $da = $_POST['dropoff_area'];
    $ds = $_POST['dropoff_state'];
    $pd = $_POST['pickup_date'];
    $pt = $_POST['pickup_time'];
    $nh = (int)$_POST['no_of_hours'];

    if (isset($st) && $st=="van hire"){
        if ($nh==8) {
            $price = 35000;
        } else if ($nh==3){
            $price = 10000;
        } else if ($nh>3 && $nh<=7){
            $p = 10000; $n= $nh - 3;
            $price = 10000 + ($n*5000);
        }
    } else if(isset($st) && $st=="bus hire") {
        if ($nh==8) {
            $price = 40000;
        } else if ($nh==3){
            $price = 15000;
        } else if ($nh>3 && $nh<=7){
            $n= $nh - 3;
            $price = 15000 + ($n*5000);
        }
    } else if(isset($st) && $st=="car hire") {
        if ($nh==8) {
            $price = 15000;
        } else if ($nh==3) {
            $price = 5000;
        } else if ($nh>3 && $nh<=7){
            $n= $nh - 3;
            $price = 5000 + ($n*2000);
        }
    }

    if ($booking->session_booking_date($st,$pa,$ps,$da,$ds,$pd,$pt,$nh,$price)) {
        http_response_code(200);
        echo json_encode(array("status"=>200, "message" => "Data saved"));
    } else {
        http_response_code(500);
        echo json_encode(array("status" => 500, "message" => "Failed to save data"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status" => 503, "message" => "Access Denied"));
}