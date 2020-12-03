<?php ob_start(); session_start();

class Bookings
{
    public $user_id;
    public $gender;

    public $email;
    public $phone;
    public $status;

    private $conn;
    private $tbl_users;
    private $tbl_bookings;
    private $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    //constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    public function session_booking_date($st,$pa,$ps,$da,$ds,$pd,$pt,$nh,$price) {
       if (isset($_SESSION['booking'])) unset($_SESSION['booking']);
        $st = htmlspecialchars(strip_tags($st));
        $pa = htmlspecialchars(strip_tags($pa));
        $ps = htmlspecialchars(strip_tags($ps));
        $da = htmlspecialchars(strip_tags($da));
        $ds = htmlspecialchars(strip_tags($ds));
        $pd = htmlspecialchars(strip_tags($pd));
        $pt = htmlspecialchars(strip_tags($pt));
        $nh = htmlspecialchars(strip_tags($nh));
        $bn = 3000000000+rand(100000000,999999999);

        if ($_SESSION['booking'] = array('st'=>$st,'pa'=>$pa,'ps'=>$ps,'da'=>$da,'ds'=>$ds,'pd'=>$pd,'pt'=>$pt,'nh'=>$nh,'bn'=>$bn,
            'price'=>$price)) {
            return true;
        }
        return false;
    }

    public function create_bookings_info($ui,$bn,$st,$pa,$ps,$da,$ds,$pd,$pt,$nh,$fn,$ln,$gd,$em,$ph,$po,$at,$re,$sta,$pa_d,$fra,$lo_off){
        $book_query = "INSERT INTO tbl_booking SET user_id=$ui,booking_num='$bn',service_type='$st',pickup_area='$pa',pickup_state='$ps',
                                destination_area='$da',destination_state='$ds',pickup_date='$pd',pickup_time='$pt',no_of_hours='$nh',
                                book_fname='$fn',book_lname='$ln',book_gender='$gd',book_email='$em',book_phone='$ph',
                                description='$pa_d',fragile='$fra',load_offload='$lo_off'";
        $book_obj = $this->conn->prepare($book_query);
        if ($book_obj->execute()){
            $bid = mysqli_insert_id($this->conn);
            if ($this->create_bookings_payment($bid,$at,$re,$po,$sta)){
                return true;
            }
            return false;
        }
        return false;
    }

    public function create_bookings_payment($bi,$am,$re,$po,$sta){
        $pay_query = "INSERT INTO tbl_payment SET booking_id=$bi,amount='$am',ref='$re',payment_option='$po',status='$sta'";
        $pay_obj = $this->conn->prepare($pay_query);
        if ($pay_obj->execute()) {
            $this->send_booking_mail_to_admin($bi);
            return true;
        }
        return false;
    }

    public function create_transfer_request($bi,$ui,$an,$at,$co) {
        $credit_query = "INSERT INTO tbl_transfer_request SET booking_num=$bi,user_id=$ui,account_name='$an',
                            amount_transferred='$at',confirmed='$co'";
        $credit_obj = $this->conn->prepare($credit_query);
        if ($credit_obj->execute()){
            return true;
        }
        return false;
    }

    public function get_all_user_bookings() {
        $project_query = "SELECT * FROM tbl_booking INNER JOIN tbl_payment ON tbl_bookings.booking_id=tbl_payment_info.booking_id 
                          WHERE tbl_booking.user_id=?";
        $project_obj = $this->conn->prepare($project_query);
        if ($project_obj->execute()){
            return $project_obj->get_result();
        }
        return array();
    }

    public function send_booking_mail_to_admin($bid){
        $email_query = "SELECT * FROM tbl_booking WHERE booking_id=$bid";
        $user_obj = $this->conn->prepare($email_query);
        if ($user_obj->execute()){
            $res = $user_obj->get_result();
            $data= $res->fetch_assoc();
            $toEmail = 'fredrickbdn@gmail.com';
//          $toEmail = 'support@vanlagos.com';
            $link="https://$_SERVER[HTTP_HOST]";
            $subject = "VanLagos New Booking Alert!";
            $name = $data['book_lname'];
            $em = $data['book_email'];
            $content = "<html>
                        <head>
                            <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                            <title>VanLagos</title>
                            <style>
                                @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;0,700;0,900;1,300&display=swap');
                                body {font-family: 'Roboto', sans-serif;font-weight: 400}
                                .wrapper {max-width: 600px;margin: 0 auto}
                                .company-name {text-align: left}
                                table {width: 80%;}
                            </style>
                        </head>
                        <body>
                        <div class='wrapper'>
                            <table>
                                <thead>
                                    <tr><th class='table-head' colspan='4'><h1 class='company-name'>VanLagos</h1></th></tr>
                                </thead>
                                <tbody>
                                    <div class='mt-3'>
                                        <p>Hi, Admin</p>
                                        <p>New booking just came in from ".$name."(".$em."). Kindly login to admin dashboard to see booking details. Thank You</p>
                                        <p>Follow this link to the admin dashboard <a href='".$link."/admin'>".$link."/admin</a></p>
                                    </div>
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

}
?>