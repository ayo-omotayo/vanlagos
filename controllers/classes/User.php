<?php

class User
{
    public $conn;

    //constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    public function create_user($fn,$ln,$em,$ph,$gd,$pd) {
        $user_query = "INSERT INTO tbl_user SET firstname=?,lastname=?,email=?,phone=?,gender=?,password=?,reference=?";
        $user_obj = $this->conn->prepare($user_query);
        //sanitize variables
        $fn = htmlspecialchars(strip_tags($fn));
        $ln = htmlspecialchars(strip_tags($ln));
        $em = htmlspecialchars(strip_tags($em));
        $ph = htmlspecialchars(strip_tags($ph));
        $gd = htmlspecialchars(strip_tags($gd));
        $pd   = htmlspecialchars(strip_tags($pd));
        $ref   = bin2hex(random_bytes(32));

        $user_obj->bind_param("sssssss",$fn,$ln,$em,$ph,$gd,$pd,$ref);
        if ($user_obj->execute()) {
            return true;
        }
        return false;
    }

    public function create_temp_user($fn,$ln,$em,$ph,$gd,$pd) {
        $user_query = "INSERT INTO tbl_user SET firstname=?,lastname=?,email=?,phone=?,gender=?,password=?,reference=?";
        $user_obj = $this->conn->prepare($user_query);
        //sanitize variables
        $fn = htmlspecialchars(strip_tags($fn));
        $ln = htmlspecialchars(strip_tags($ln));
        $em = htmlspecialchars(strip_tags($em));
        $ph = htmlspecialchars(strip_tags($ph));
        $gd = htmlspecialchars(strip_tags($gd));
        $pd   = htmlspecialchars(strip_tags($pd));
        $ref   = bin2hex(random_bytes(32));

        $user_obj->bind_param("sssssss",$fn,$ln,$em,$ph,$gd,$pd,$ref);
        if ($user_obj->execute()) {
            $user_id = mysqli_insert_id($this->conn);
            if ($this->send_account_activation_mail($em)){
                return $user_id;
            }
            return false;
        }
        return false;
    }

    public function check_email($email){
        $s_email = htmlspecialchars(strip_tags($email));
        $email_query = "SELECT * FROM tbl_user WHERE email='$s_email' AND activated=1";
        $user_obj = $this->conn->prepare($email_query);
        if ($user_obj->execute()){
            return $user_obj->get_result()->fetch_assoc();
        }
        return array();
    }

    public function send_account_activation_mail($email){
        $s_email = htmlspecialchars(strip_tags($email));
        $email_query = "SELECT * FROM tbl_user WHERE email='$s_email' LIMIT 1";
        $user_obj = $this->conn->prepare($email_query);
        if ($user_obj->execute()){
            $data = $user_obj->get_result()->fetch_assoc();
            $toEmail = $s_email;
            $fname=$data['firstname'];
            $link="https://$_SERVER[HTTP_HOST]";
            $url=$link.'/login/'.$data['reference'];
            $subject = "VanLagos Account Activation";
            $content = "<html>
                            <head>
                                <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                                <title>VanLagos</title>
                                <style>
                                    @import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');
                                    .action-btn {background-color: #2d882d;}
                                    .action-btn:hover {background-color: #116611;}
                                    table {width: 35%; margin: 0 auto;}
                                    @media screen and (max-width: 950px) { table {width: 80%}  }
                                    @media screen and (max-width: 500px) { table {width: 90%}  }
                                </style>
                            </head>
                            <body style=\"font-family: 'Roboto', sans-serif;\">
                            <main class='wrapper'>
                                <div class='main-inner' style='line-height:1.6'>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th colspan='3'>
                                                <div class='head-inner' style='background: #1A1A1A;padding: 20px 0'>
                                                    <img src='http://localhost/vanlagos/assets/images/brand-logo.png' border='0' class='brand-logo' alt='PME' style='width:150px;'>
                                                </div>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan='3'>
                                                <div class='content' style='background-color:rgba(136, 204, 136, .1);padding:3em 1.5em'>
                                                    <h3>You’re almost there, ".$fname."</h3>
                                                    <p>We know our registration process takes a few minutes, we hope it’ll be worth your while…</p>
                                                    <p>copy and paste the link below in your browser to activate your account:</p>
                                                    <a href='".$url."'>".$url."</a>
                                                </div>
                                                <p style><small>&copy; 2020 VanLagos</small></p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </main>
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

    public function activate_user_account($ref){
        $c_query = "SELECT * FROM tbl_user WHERE reference='$ref' LIMIT 1";
        $c_obj = $this->conn->prepare($c_query);
        if ($c_obj->execute()){ $data = $c_obj->get_result()->fetch_assoc(); }
        else{ $data = array(); }

        if (!empty($data)) {
            $c2_query = "SELECT * FROM tbl_user WHERE reference='$ref' AND activated=1 LIMIT 1";
            $c2_obj = $this->conn->prepare($c2_query);
            if ($c2_obj->execute()){ $data2 = $c2_obj->get_result()->fetch_assoc(); }
            else{ $data2 = array(); }

            if (empty($data2)) {
                $email_query = "UPDATE tbl_user SET activated=1 WHERE reference='$ref' LIMIT 1";
                $user_obj = $this->conn->prepare($email_query);
                $user_obj->execute();
                if ($user_obj->affected_rows > 0) {
                    return 'true';
                }
                return 'false';
            } else {return "activated";}
        } else {
            return "invalid";
        }
    }

    public function login_user($email) {
        $email_query = "SELECT * FROM tbl_user WHERE email='$email' AND activated=1";
        $user_obj = $this->conn->prepare($email_query);
        if ($user_obj->execute()){
            return $user_obj->get_result()->fetch_assoc();
        }
        return array();
    }

    public function reset_password_request($email){
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);

        $host = "https://$_SERVER[HTTP_HOST]";
        $url= $host."/reset-password/".$selector."/".bin2hex($token);
        $expires = date("U") + 1200;
        //Delete any existing user token entry
        $del_reset_obj = $this->conn->prepare("DELETE FROM tbl_pwd_reset WHERE reset_email='$email'");
        $del_reset_obj->execute();
        //Insert reset credentials
        $reset_query = "INSERT INTO tbl_pwd_reset SET reset_email=?,reset_selector=?,reset_token=?,reset_expires=?";
        $reset_obj = $this->conn->prepare($reset_query);
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        $reset_obj->bind_param("ssss",$email,$selector,$hashedToken,$expires);
        //execute query
        if ($reset_obj->execute()){
            $to = $email;
            $subject = "VanLagos Password Reset";
            $content = "<html>
                            <head>
                                <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                                <title>VanLagos</title>
                                <style>
                                    @import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');
                                    table {width: 35%; margin: 0 auto;}
                                    @media screen and (max-width: 950px) { table {width: 80%}  }
                                    @media screen and (max-width: 500px) { table {width: 90%}  }
                                </style>
                            </head>
                            <body style=\"font-family: 'Roboto', sans-serif;\">
                            <main class='wrapper'>
                                <div class='main-inner' style='line-height:1.6'>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th colspan='3'>
                                                <div class='head-inner' style='background: #1A1A1A;padding: 20px 0'>
                                                    <img src='http://localhost/vanlagos/assets/images/brand-logo.png' border='0' class='brand-logo' alt='PME' style='width:150px;'>
                                                </div>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td colspan='3'>
                                                <div class='content' style='background-color:rgba(136, 204, 136, .1);padding:3em 1.5em'>
                                                    <h3>Welcome back</h3>
                                                    <p>You’re receiving this mail because you requested a password reset for your VanLagos account.</p>
                                                    <p>Please tap the link below to create a new password :</p>
                                                    <a href='".$url."'>".$url."</a>
                                                </div>
                                                <p style><small>&copy; 2020 VanLagos</small></p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </main>
                            </body>
                            </html>";
            $mailHeaders ="MIME-Version: 1.0"."\r\n";
            $mailHeaders .="Content-type:text/html;charset=UTF-8"."\r\n";
            $mailHeaders .= "From: VanLagos <support@vanlagos.com>\r\n";
            if (mail($to, $subject, $content, $mailHeaders)) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function check_reset_pwd_credentials($selector){
        $currentDate = date("U");
        $email_query = "SELECT * FROM tbl_pwd_reset WHERE reset_selector='$selector' AND reset_expires >= '$currentDate'";
        $cust_obj = $this->conn->prepare($email_query);
        if ($cust_obj->execute()){
            return $cust_obj->get_result()->fetch_assoc();
        }
        return array();
    }

    public function update_reset_password($pwd,$email) {
        $update_query = "UPDATE tbl_user SET password='$pwd' WHERE email='$email'";
        $update_obj = $this->conn->prepare($update_query);
        if ($update_obj->execute()){
            if ($update_obj->affected_rows > 0) {
                //Delete any existing user token entry
                $del_reset_obj = $this->conn->prepare("DELETE FROM tbl_pwd_reset WHERE reset_email='$email'");
                $del_reset_obj->execute();
                return true;
            }
            return false;
        }
        return false;
    }

    public function send_contact_us_mail($fullname,$email,$subject,$content) {
        $toEmail = 'support@vanlagos.com';
//        $toEmail = 'fredrickbdn@gmail.com';
        $content = $email.' sent you a message from Van Lagos<br />'.$content;
        $link="https://$_SERVER[HTTP_HOST]";
        $mailHeaders ="MIME-Version: 1.0"."\r\n";
        $mailHeaders .="Content-type:text/html;charset=UTF-8"."\r\n";
        $mailHeaders .= "From: ".$fullname." <".$email.">\r\n";
        if (mail($toEmail, $subject, $content, $mailHeaders)) {
            return true;
        }
        return false;
    }
}
?>