<?php
header("Content-type: application/json; charset=UTF-8");
include_once('config/database.php');
include_once('classes/User.php');

$db = new Database();
$connection = $db->connect();
$user = new User($connection);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['firstname']) &&!empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['gender'])
        && !empty($_POST['password']) && !empty($_POST['repeat_pwd'])) {
        $fn=$_POST['firstname'];
        $ln=$_POST['lastname'];
        $em=$_POST['email'];
        $ph=$_POST['phone'];
        $gd=$_POST['gender'];
        $pd=$_POST['password'];
        $rp=$_POST['repeat_pwd'];
        if ($pd !== $rp){
            http_response_code(500);
            echo json_encode(array("status"=>500,"message"=>"Password combination did not match."));
        } else {
            $email_data = $user->check_email($_POST['email']);
            if (!empty($email_data)) {
                http_response_code(422);
                echo json_encode(array("status"=>422,"message" =>"Email already in use"));
            } else {
                $result = $user->create_user($fn,$ln,$em,$ph,$gd,password_hash($pd,PASSWORD_DEFAULT));
                if ($result) {
                    $user->send_account_activation_mail($_POST['email']);
                    http_response_code(200);
                    echo json_encode(array(
                        "status"=>200,"message"=>"Kindly check your mail to activate and complete signup process"
                    ));
                } else {
                    http_response_code(400);
                    echo json_encode(array("status"=>400,"message"=>"Failed to save user"));
                }
            }
        }
    } else {
        http_response_code(500);
        echo json_encode(array("status"=>500,"message"=>"Fill all required field"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status"=>503,"message"=>"Access Denied"));
}