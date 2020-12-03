<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../config/database.php');

?>

<?php
class Admin {
    private $conn;
    private $tbl_admin;

    public $id;
    public $admin_email;
    public $admin_password;
    public $success;
    public $error;

    public $booking_id;
    public $ref;
    public $travel_from;
    public $travel_to;
    public $travel_type;
    public $departure_date;
    public $return_date;
    public $no_of_passenger;
    public $selected_seat;
    public $email;
    public $phone;
    public $nationality;
    public $payment_option;
    public $next_of_kin_name;
    public $next_of_kin_phone;
    public $passenger_cat;
    public $fullname;
    public $gender;
    public $amount;
    public $status;

    public $booking_num;
    public $book_id;


    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function create_admin_user($au,$ae,$ap,$ar){
        $admin_query = "SELECT * FROM tbl_admin WHERE adm_email='$ae'";
        $admin_obj = $this->conn->prepare($admin_query);
        if ($admin_obj->execute()){
            $data = $admin_obj->get_result()->num_rows;
            if ($data > 0){
                return false;
            } else {
                $pass = password_hash($ap, PASSWORD_DEFAULT);
                $admin_query = "INSERT INTO tbl_admin SET adm_name='$au',adm_email='$ae',adm_pwd='$pass',adm_role='$ar'";
                $admin_obj = $this->conn->prepare($admin_query);
                if ($admin_obj->execute()){
                    return true;
                }
                return false;
            }
        }
        return false;
    }

    public function admin_login($ae,$ap){
        $admin_query = "SELECT * FROM tbl_admin WHERE adm_email='$ae'";
        $admin_obj = $this->conn->prepare($admin_query);
        if ($admin_obj->execute()){
            $data = $admin_obj->get_result()->fetch_assoc();
            if (password_verify($ap,$data['adm_pwd'])){
                return $data;
            } else {
                return array();
            }
        }
        return array();
    }

    public function get_all_customers()
    {
        $users_query = "SELECT * FROM tbl_user";
        $users_obj = $this->conn->prepare($users_query);
        if ($users_obj->execute()) {
            return $users_obj->get_result();
        }
        return array();
    }

    public function adminDashboard(){
        $queryUsers = mysqli_query($this->conn, "SELECT COUNT(user_id) as totalUsers FROM tbl_user")->fetch_assoc();
        $queryUsersActive = mysqli_query($this->conn, "SELECT COUNT(user_id) as UsersActive FROM tbl_user  WHERE activated=1")->fetch_assoc();
        $queryUsersInactive = mysqli_query($this->conn, "SELECT COUNT(user_id) as UsersInactive FROM tbl_user WHERE activated=0")->fetch_assoc();

        $totalBookings = mysqli_query($this->conn, "SELECT COUNT(booking_id) totalBookings FROM tbl_booking")->fetch_assoc();

        $totalBookingsAmount = mysqli_query($this->conn, "SELECT SUM(amount) totalAmount FROM tbl_payment WHERE status='Paid'")->fetch_assoc();
        $totalBookingsUnverifiedAmount = mysqli_query($this->conn, "SELECT SUM(amount) totalUnverifiedAmount FROM tbl_payment WHERE status='Unverified'")->fetch_assoc();

        $dashboardData['totalUsers'] = $queryUsers['totalUsers'];
        $dashboardData['queryUsersInactive'] = $queryUsersInactive['UsersInactive'];
        $dashboardData['queryUsersActive'] = $queryUsersActive['UsersActive'];
        $dashboardData['totalBookings'] = $totalBookings['totalBookings'];
        $dashboardData['totalAmount'] = $totalBookingsAmount['totalAmount'];
        $dashboardData['totalUnverifiedAmount'] = $totalBookingsUnverifiedAmount['totalUnverifiedAmount'];

        if($queryUsers ) {
            return $dashboardData;
        } else {
            return false;
        }
    }

    public function get_all_bookings() {
        $pickup_query = "SELECT * FROM tbl_booking 
                         LEFT JOIN tbl_payment ON tbl_booking.booking_id=tbl_payment.booking_id
                         LEFT JOIN tbl_user ON tbl_booking.user_id=tbl_user.user_id";
        $pickup_obj = $this->conn->prepare($pickup_query);
        if ($pickup_obj->execute()){
            return $pickup_obj->get_result();
        }
        return array();
    }

    public function get_all_hire_bus($val)
    {
        $hire_bus_query = "SELECT * FROM tbl_booking 
                         LEFT JOIN tbl_payment ON tbl_booking.booking_id=tbl_payment.booking_id
                         LEFT JOIN tbl_user ON tbl_booking.user_id=tbl_user.user_id WHERE tbl_booking.service_type='$val'";
        $hire_bus_obj = $this->conn->prepare($hire_bus_query);
        if ($hire_bus_obj->execute()) {
            return $hire_bus_obj->get_result();
        }
        return array();
    }

    public function get_all_payment()
    {
        $transfer_query = "SELECT * FROM tbl_payment 
            INNER JOIN tbl_booking ON tbl_payment.booking_id=tbl_booking.booking_id
            LEFT JOIN tbl_user ON tbl_user.user_id=tbl_booking.user_id";
        $transfer_obj = $this->conn->prepare($transfer_query);
        if ($transfer_obj->execute()) {
            return $transfer_obj->get_result();
        }
        return array();
    }

    public function get_all_transfer_request()
    {
        $transfer_query = "SELECT * FROM tbl_transfer_request INNER JOIN tbl_booking ON tbl_transfer_request.booking_num=tbl_booking.booking_num
                            INNER JOIN tbl_payment ON tbl_payment.booking_id=tbl_booking.booking_id WHERE tbl_transfer_request.confirmed='false'";
        $transfer_obj = $this->conn->prepare($transfer_query);
        if ($transfer_obj->execute()) {
            return $transfer_obj->get_result();
        }
        return array();
    }

    public function create_booking(){
        if (isset($this->return_date) && !empty($this->return_date)){
            $booking_query = "INSERT INTO tbl_bookings SET booking_num=?,travel_from=?,travel_to=?,travel_type=?,departure_date=?,return_date=?,no_of_passenger=?,
                            selected_seat=?,email=?,phone=?,fullname=?,next_of_kin_name=?,next_of_kin_phone=?,payment_option=?";
            $booking_obj = $this->conn->prepare($booking_query);
            $this->return_date = htmlspecialchars(strip_tags($this->return_date));
        } else {
            $booking_query = "INSERT INTO tbl_bookings SET booking_num=?,travel_from=?,travel_to=?,travel_type=?,departure_date=?,no_of_passenger=?,
                            selected_seat=?,email=?,phone=?,fullname=?,next_of_kin_name=?,next_of_kin_phone=?,payment_option=?";
            $booking_obj = $this->conn->prepare($booking_query);
        }
        //sanitize variables
        $this->booking_num = rand(1000000,9999999);
        $this->travel_from = htmlspecialchars(strip_tags($this->travel_from));
        $this->travel_to = htmlspecialchars(strip_tags($this->travel_to));
        $this->travel_type = htmlspecialchars(strip_tags($this->travel_type));
        $this->departure_date = htmlspecialchars(strip_tags($this->departure_date));
        $this->no_of_passenger = htmlspecialchars(strip_tags($this->no_of_passenger));

        $this->selected_seat = htmlspecialchars(strip_tags($this->selected_seat));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->fullname = htmlspecialchars(strip_tags($this->fullname));
        $this->next_of_kin_name = htmlspecialchars(strip_tags($this->next_of_kin_name));
        $this->next_of_kin_phone = htmlspecialchars(strip_tags($this->next_of_kin_phone));
        $this->payment_option = htmlspecialchars(strip_tags($this->payment_option));
        //bind parameter
        if (isset($this->return_date) && !empty($this->return_date)){
            $booking_obj->bind_param("ssssssisssssss",$this->booking_num,$this->travel_from,$this->travel_to,
                $this->travel_type,$this->departure_date,$this->return_date,$this->no_of_passenger,$this->selected_seat,
                $this->email,$this->phone, $this->fullname,$this->next_of_kin_name,$this->next_of_kin_phone,$this->payment_option);
        } else {
            $booking_obj->bind_param("sssssisssssss",$this->booking_num,$this->travel_from,$this->travel_to,
                $this->travel_type,$this->departure_date,$this->no_of_passenger,$this->selected_seat,$this->email,$this->phone,
                $this->fullname,$this->next_of_kin_name,$this->next_of_kin_phone,$this->payment_option);
        }


        if ($booking_obj->execute()){
            $this->booking_id = mysqli_insert_id($this->conn);
            if ($this->create_passenger_info()){
                if ($this->create_payment_info()){
                    if ($this->create_transfer_request()) {
                        return true;
                    }
                    return false;
                }
                return false;
            }
            return false;
        }
        return false;
    }

    public function create_payment(){
        $payment_query = "INSERT INTO tbl_payment_info SET booking_id=?,booking_num=?,amount=?,ref=?,status=?";
        $payment_obj = $this->conn->prepare($payment_query);
        //sanitize variables
        $this->booking_id = htmlspecialchars(strip_tags($this->booking_id));
        $this->booking_num = htmlspecialchars(strip_tags($this->booking_num));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->status = "Unverified";
        $this->ref = rand(100000000,999999999);
        //bind parameter
        $payment_obj->bind_param("isiss",$this->booking_id,$this->booking_num,$this->amount,$this->ref,$this->status);
        if ($payment_obj->execute()){
            return true;
        }
        return false;
    }

    public function create_transfer_request(){
        $transfer_query = "INSERT INTO tbl_transfer_request SET booking_num=?,email=?,account_name=?,transferred_amount=?";
        $transfer_obj = $this->conn->prepare($transfer_query);
        //sanitize variables
        $this->booking_num = htmlspecialchars(strip_tags($this->booking_num));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->fullname = htmlspecialchars(strip_tags($this->fullname));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->status = "Unverified";
        $this->ref = rand(100000000,999999999);
        //bind parameter
        $transfer_obj->bind_param("sssi",$this->booking_num,$this->email,$this->fullname,$this->amount);
        if ($transfer_obj->execute()){
            return true;
        }
        return false;
    }

    public function count_transfer_request(){
        $cnt = mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM tbl_transfer_request WHERE confirmed='false'"));
        if ($cnt > 0) return $cnt;
        return 0;
    }

    public function update_transfer_request($tid,$bid) {
        $transfer_query = "UPDATE tbl_transfer_request SET confirmed='true' WHERE transfer_id=$tid";
        $transfer_obj = $this->conn->prepare($transfer_query);
        if ($transfer_obj->execute()){
            if ($this->update_booking_payment_status($bid)){
                $this->send_booking_receipt_mail_to_customer($tid);
                return true;
            }
            return false;
        }
        return false;
    }

    public function update_booking_payment_status($bid){
        $transfer_query = "UPDATE tbl_payment SET status='Paid' WHERE booking_id='$bid'";
        $transfer_obj = $this->conn->prepare($transfer_query);
        if ($transfer_obj->execute()){
            return true;
        }
        return false;
    }

    public function send_booking_receipt_mail_to_customer($tid){
        $req_query = "SELECT * FROM tbl_transfer_request INNER JOIN tbl_booking ON tbl_booking.booking_num=tbl_transfer_request.booking_num
                        WHERE tbl_transfer_request.transfer_id=$tid";
        $req_obj = $this->conn->prepare($req_query);
        if ($req_obj->execute()){
            $res = $req_obj->get_result();
            $data= $res->fetch_assoc();
            $toEmail = $data['book_email'];
            $link="https://$_SERVER[HTTP_HOST]";
            $subject = "Van Lagos Booking Receipt";
            $name = $data['book_fname'];
            $content = "<html>
                        <head>
                            <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                            <title>VAN LAGOS</title>
                            <style>
                                @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');
                                * {box-sizing: border-box;}
                                body {font-family: 'Roboto', sans-serif;margin: 0;padding: 0;font-size: 14px;line-height: 10px;}
                                h2 {margin: 0;}
                                .wrapper {max-width: 600px;margin: 0 auto;line-height: 15px;}
                                th {background-color: #a8b622;color: #ffffff;padding: .8em .7em;}
                            </style>
                        </head>
                        <body>
                        <div class='wrapper'>
                            <table>
                                <thead>
                                    <tr><th class='table-head' colspan='4'><h2 class='company-name'>VanLagos Booking Receipt</h2></th></tr>
                                </thead>
                                <tbody>
                                    <tr><td style='padding: 25px 0 10px 0;'>Hi, ".$name."</td></tr>
                                    <tr><td>Your payment was successful and has been received by VanLagos Team.</td></tr>
                                    <tr><td style='padding: 10px 0;'>Amount Paid: <span style='color:#a8b622;'>₦".number_format($data['amount_transferred'],0)."</span></td></tr>
                                    <tr><td style='padding: 0 0 10px 0;'>Booking Reference: #".$data['booking_num']."</td></tr>
                                    <tr><td style='border-bottom: 1px solid #cccccc'></td></tr>
                                    <tr><td><p style='color:#6b6b6b;'>". date('l F j Y', strtotime($data['created_at']))."</p></td></tr>
                                    <tr><td><p>If you have questions or issues with this payment, contact VanLagos at support@vanlagos.com or simply reply to this email.</p></td></tr>
                                </tbody>
                            </table>
                        </div>
                        </body>
                        </html>";
            $mailHeaders ="MIME-Version: 1.0"."\r\n";
            $mailHeaders .="Content-type:text/html;charset=UTF-8"."\r\n";
            $mailHeaders .= "From: VanLagos <support@vanlagos.com>\r\n";
            if (mail($toEmail, $subject, $content, $mailHeaders)) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function error_alert(){
        return "<div class='alert alert-danger alert-dismissible fade show'>
                  <button type='button' aria-hidden='true' class='close' data-dismiss='alert' aria-label='Close'>
                    <i class='nc-icon nc-simple-remove'></i>
                  </button>
                  <span><b>$this->error</b></span>
                </div>";
    }
}

$admin = new Admin();

?>