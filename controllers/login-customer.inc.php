<?php
session_start();
header("Content-type: application/json; charset=UTF-8");
include_once('config/database.php');
include_once('classes/User.php');

//create object for db
$db = new Database();
$connection = $db->connect();
$user = new User($connection);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $user_data = $user->login_user($_POST['email']);
        if (!empty($user_data)){
            $email = $user_data['email'];
            $password = $user_data['password'];

            if (password_verify($_POST['password'],$password)){
                if (isset($_SESSION['booking']['oldUrl'])){
                    $location = "booking-details";
                } else {
                    $location = "account/index";
                }
                $account_arr = array(
                    "user_id"=>$user_data['user_id'],"firstname"=>$user_data['firstname'],"lastname"=>$user_data['lastname'],
                    "email"=>$user_data['email'],"phone"=>$user_data['phone'],"gender"=>$user_data['gender']);
                http_response_code(200);
                echo json_encode(array("status"=>200,"user_details"=>$account_arr,"message"=>"User logged in successfully","location"=>$location));
                $_SESSION['user_login'] = $account_arr;
            } else {
                http_response_code(422);
                echo json_encode(array("status"=>422,"message"=>"Password incorrect. Try resetting your password."));
            }
        } else {
            http_response_code(404);
            echo json_encode(array("status"=>404,"message"=>"Email does not match any record."));
        }
    } else {
        http_response_code(500);
        echo json_encode(array("status"=>500,"message"=>"Fill all required field"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status"=>503,"message"=>"Access Denied"));
}