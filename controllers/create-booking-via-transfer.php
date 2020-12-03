<?php
header("Content-type: application/json; charset=UTF-8");

include_once('config/database.php');
include_once('classes/Bookings.php');
include_once('classes/User.php');

$db = new Database();
$connection = $db->connect();
$booking = new Bookings($connection);
$user = new User($connection);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['account_name']) && !empty($_POST['amount_transferred'])) {
        $st = $_SESSION['booking']['st'];
        $pa = $_SESSION['booking']['pa'];
        $ps = $_SESSION['booking']['ps'];
        $da = $_SESSION['booking']['da'];
        $ds = $_SESSION['booking']['ds'];
        $pd = $_SESSION['booking']['pd'];
        $pt = $_SESSION['booking']['pt'];
        $nh = $_SESSION['booking']['nh'];
        $bn = $_SESSION['booking']['bn'];

        $fn = $_SESSION['booking']['fn'];
        $ln = $_SESSION['booking']['ln'];
        $gd = $_SESSION['booking']['gd'];
        $em = $_SESSION['booking']['em'];
        $ph = $_SESSION['booking']['ph'];
        $po = $_SESSION['booking']['po'];

        $pac_d = isset($_SESSION['booking']['pac_d']) ? $_SESSION['booking']['pac_d']:NULL;
        $fra = isset($_SESSION['booking']['fra']) ? $_SESSION['booking']['fra']:NULL;
        $loadoff = isset($_SESSION['booking']['loadoff']) ? $_SESSION['booking']['loadoff']:NULL;

        if (isset($_SESSION['user_login']) && !empty($_SESSION['user_login']['user_id'])){
            $ui = $_SESSION['user_login']['user_id'];
        } else {
            $email_data = $user->check_email($em);
            if (!empty($email_data)) {
                http_response_code(422);
                echo json_encode(array("status"=>422,"message" =>"Email already in use, try login instead"));
                die();
            } else {
                $resp = $user->create_temp_user($fn, $ln, $em, $ph, $gd, password_hash("12345678", PASSWORD_DEFAULT));
                if ($resp !== false) {
                    $ui = $resp;
                } else {
                    http_response_code(422);
                    echo json_encode(array("status" => 500, "message" => "Error occurred while creating password"));
                    die();
                }
            }
        }

        $an = $_POST['account_name'];
        $at = $_POST['amount_transferred'];
        $re = rand(2000000,2999999);
        if ($po=='gtPay') { $sta = 'Paid'; $co='true'; }
        else {
            $sta='Unverified'; $co='false';
        }

        if ($booking->create_bookings_info($ui,$bn,$st,$pa,$ps,$da,$ds,$pd,$pt,$nh,$fn,$ln,$gd,$em,$ph,$po,$at,$re,$sta,$pac_d,$fra,$loadoff)){
            $booking->create_transfer_request($bn,$ui,$an,$at,$co);
            unset($_SESSION['booking']);
            http_response_code(200);
            echo json_encode(array("status" => 200, "message"=>"Our customer service will contact you shortly via your email address."));
        } else {
            http_response_code(500);
            echo json_encode(array("status" => 500,"message" => "Failed to save booking information, contact customer support"));
        }
    } else {
        http_response_code(500);
        echo json_encode(array("status" => 500, "message" => "One or more field is empty"));
    }
} else {
    http_response_code(503);
    echo json_encode(array("status" => 503, "message" => "Access Denied"));
}