<?php
header("Content-type: application/json; charset=UTF-8");
include_once('config/database.php');
include_once('classes/User.php');

//create object for db
$db = new Database();
$connection = $db->connect();
$user = new User($connection);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['email'])) {
        //submit data
        $for_email = $_POST['email'];
        $email_data = $user->check_email($for_email);
        if (!empty($email_data)){
            if ($user->reset_password_request($for_email)){
                http_response_code(200);
                echo json_encode(array("status" => 200, "message" => "Reset password link as been sent to your email address."));
            } else {
                http_response_code(500);
                echo json_encode(array("status" => 500, "message" => "Failed to send reset password link"));
            }
        } else {
            http_response_code(422);
            echo json_encode(array("status" => 422, "message" => "Invalid email address"));
        }
    } else {
        http_response_code(404);
        echo json_encode(array("status" => 500,"message" => "Invalid email address"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status" => 503, "message" => "Access Denied"));
}
