<?php
// include headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=UTF-8");

include_once('../api/config/database.php');
include_once('../api/classes/Admin.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = json_decode(file_get_contents("php://input"));
    if (!empty($data->travel_from) && !empty($data->travel_to) && !empty($data->travel_type) && !empty($data->departure_date)
        && !empty($data->no_of_passenger) && !empty($data->selected_seat) && !empty($data->email) && !empty($data->phone)
        && !empty($data->next_of_kin_name) && !empty($data->next_of_kin_phone) && !empty($data->passenger_cat)
        && !empty($data->fullname) && !empty($data->gender) && !empty($data->amount)) {

            //submit data
            $admin->travel_from = $data->travel_from;
            $admin->travel_to = $data->travel_to;
            $admin->travel_type = $data->travel_type;
            $admin->departure_date = $data->departure_date;
            if (!empty($data->return_date) && isset($data->return_date)){
                $admin->return_date = $data->return_date;
            }
            $admin->no_of_passenger = $data->no_of_passenger;
            $admin->selected_seat = $data->selected_seat;
            $admin->email = $data->email;
            $admin->phone = $data->phone;
            $admin->next_of_kin_name = $data->next_of_kin_name;
            $admin->next_of_kin_phone = $data->next_of_kin_phone;
            $admin->passenger_cat = $data->passenger_cat;
            $admin->fullname = $data->fullname;
            $admin->gender = $data->gender;
            $admin->amount = $data->amount;
            $admin->payment_option = $data->payment_option;

            if ($admin->create_booking()){
                http_response_code(200);
                echo json_encode(array(
                    "status" => 1,
                    "message" => "Booking successfully created"
                ));
            } else {
                http_response_code(500);
                echo json_encode(array(
                    "status" => 0,
                    "message" => "Failed to save user"
                ));
            }

    } else {
        http_response_code(500);
        echo json_encode(array(
            "status" => 0,
            "message" => "One or more field is empty"
        ));
    }
} else {
    http_response_code(503);
    echo json_encode(array(
        "status" => 0,
        "message" => "Access Denied"
    ));
}