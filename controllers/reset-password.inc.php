<?php

header("Content-type: application/json; charset=UTF-8");

include_once('config/database.php');
include_once('classes/User.php');

//create object for db
$db = new Database();
$connection = $db->connect();
$user = new User($connection);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['res_password']) && !empty($_POST['res_repeat_pwd'])) {
        if (trim($_POST['res_password']) == trim($_POST['res_repeat_pwd'])) {
            $reset_selector = $_POST['selector'];
            $reset_data = $user->check_reset_pwd_credentials($reset_selector);
            if (!empty($reset_data)){
                $tokenBin = hex2bin($_POST['validator']);
                $tokenCheck = password_verify($tokenBin, $reset_data['reset_token']);
                if ($tokenCheck===false){
                    http_response_code(500);
                    echo json_encode(array("status"=>500,"message"=>"You need to submit a reset request"));
                } elseif($tokenCheck===true) {
                    $user->check_email($reset_data['reset_email']);
                    if (!empty($reset_data)){
                        $password = password_hash($_POST['res_password'],PASSWORD_DEFAULT);
                        if ($user->update_reset_password($password,$reset_data['reset_email'])){
                            http_response_code(200);
                            echo json_encode(array("status"=>200,"message"=>"Password successfully changed, proceed to login menu"));
                        } else {
                            http_response_code(500);
                            echo json_encode(array("status"=>500,"message"=>"Error while trying to reset your password, contact our admin for help"));
                        }
                    }
                }
            } else {
                http_response_code(422);
                echo json_encode(array("status"=>422,"message"=>"Invalid link, re-submit your reset link"));
            }
        } else {
            http_response_code(404);
            echo json_encode(array("status" => 404, "message" => "Password combination do not match"));
        }
    } else {
        http_response_code(503);
        echo json_encode(array("status" => 500, "message" => "Kindly fill the required field"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status" => 503, "message" => "Access Denied"));
}