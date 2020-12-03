<?php
header("Content-type: application/json; charset=UTF-8");
include_once('config/database.php');
include_once('classes/User.php');

$db = new Database();
$connection = $db->connect();
$user = new User($connection);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message'])) {
        if ($user->send_contact_us_mail($_POST['fullname'],$_POST['email'],$_POST['subject'],$_POST['message'])) {
            http_response_code(200);
            echo json_encode(array("status"=>200,"message"=>"Message sent. Our customer support will get back to you shortly"));
        } else {
            http_response_code(500);
            echo json_encode(array("status"=>500, "message" => "Failed to send message"));
        }
    }
} else {
    http_response_code(503);
    echo json_encode(array("status"=>503,"message"=>"Access Denied"));
}