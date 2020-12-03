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
    if (isset($_POST['service_type']) && $_POST['service_type']=="bus hire"){
        $st = $_POST['service_type'];
        $pa = $_POST['b_pickup_area'];
        $ps = $_POST['b_pickup_state'];
        $da = $_POST['b_dropoff_area'];
        $ds = $_POST['b_dropoff_state'];
        $pd = $_POST['b_pickup_date'];
        $pt = $_POST['b_pickup_time'];
        $pr = $_POST['b_payment_rate'];

        if ($_POST['b_payment_rate']=='b_hourly_rate'){
            $dd = $_POST['b_dropoff_date'];
            $dt = $_POST['b_dropoff_time'];
            $nd = NULL;
        } else {
            $dd = NULL; $dt = NULL;

        }

    } elseif (isset($_POST['service_type']) && $_POST['service_type']=="van hire"){
        $st = $_POST['service_type'];
        $pa = $_POST['pickup_area'];
        $ps = $_POST['pickup_state'];
        $da = $_POST['dropoff_area'];
        $ds = $_POST['dropoff_state'];
        $pd = $_POST['pickup_date'];
        $pt = $_POST['pickup_time'];
        $pr = $_POST['payment_rate'];
        if ($_POST['payment_rate']=='hourly_rate'){
            $dd = $_POST['dropoff_date']; $dt = $_POST['dropoff_time'];
            $nd = NULL;
        } else {
            $dd = NULL; $dt = NULL;
            $nd = $_POST['no_of_days'];
        }

    } elseif (isset($_POST['service_type']) && $_POST['service_type']=="car hire"){
        $st = $_POST['service_type'];
        $pa = $_POST['pickup_area'];
        $ps = $_POST['pickup_state'];
        $da = $_POST['dropoff_area'];
        $ds = $_POST['dropoff_state'];
        $pd = $_POST['pickup_date'];
        $pt = $_POST['pickup_time'];
        $pr = $_POST['payment_rate'];
        if ($_POST['payment_rate']=='hourly_rate'){
            $dd = $_POST['dropoff_date']; $dt = $_POST['dropoff_time'];
            $nd = NULL;
        } else {
            $dd = NULL; $dt = NULL;
            $nd = $_POST['no_of_days'];
        }
    }

    if ($pr =='hourly_rate' || $pr =='b_hourly_rate'){
        $t1 = strtotime( $pd.''.$pt); $t2 = strtotime( $dd.''. $dt);
        $diff = $t2 - $t1;$hours = $diff / ( 60 * 60 );

        if ($hours < 1){
            http_response_code(404);
            echo json_encode(array("status" => 404, "message" => "Invalid date selected"));
            die();
        } else {
            $p = 5000;
            $price = $hours * $p;
        }
    } else if($pr =='daily_rate' || $pr =='b_daily_rate') {
        if ($st =="bus hire" && $ps == $ds){
            $p=30000;
            $price = $p * $nd;
        } else if ($st =="bus hire" && $ps != $ds){
            $p=70000;
            $price = $p * $nd;
        } else if ($st =="van hire" && $ps == $ds){
            $p=40000;
            $price = $p * $nd;
        } else if ($st =="van hire" && $ps != $ds){
            $p=55000;
            $price = $p * $nd;
        }
    }

    if ($booking->session_booking_date($st,$pa,$ps,$da,$ds,$pd,$pt,$dd,$dt,$price,$pr,$p,$nd)) {
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