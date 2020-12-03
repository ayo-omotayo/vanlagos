<?php
header("Content-type: application/json; charset=UTF-8");
include_once('../controllers/classes/Admin.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if (trim($_POST['process']) =='401' && !empty(trim($_POST['transfer_id'])) && !empty(trim($_POST['booking_id']))) {
        $tid = trim($_POST['transfer_id']);
        $bid = trim($_POST['booking_id']);
        if ($admin->update_transfer_request($tid,$bid)){
            http_response_code(200);
            echo json_encode(array("status" => 200, "message" => "Payment now marked as confirmed"));
        } else {
            http_response_code(500);
            echo json_encode(array("status" => 500, "message" => "Unable to complete the process"));
        }
    }
}