<?php
ob_start(); session_start();
if (isset($_SESSION['user_login']) && isset($_SESSION['user_login']['user_id'])) header('Location: account');
include_once('inc/header.nav.php');
?>
<main class="login-page mb-5">
    <section class="title-component-wrapper py-5">
        <div class="container"><h3 class="page-title">Login</h3></div>
    </section>
    <section class="form-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-7 col-md-5 mx-auto text-center">
                    <div class="card my-5">
                        <div class="card-body p-4 p-md-5">
                            <h4 class="text-center mb-4"><strong>Login to your account</strong></h4>
                            <div id="response-alert"></div>
                            <form name="login_form" id="login_form">
                                <div class="form-group mb-3">
                                    <input type="email" class="form-control grey_control" name="email" placeholder="Enter Email" aria-label="">
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" class="form-control grey_control" name="password" placeholder="Enter Password" aria-label="">
                                </div>
                                <button type="submit" class="btn custom-form-btn px-5 mb-3" id="loginBtn">
                                    <i class="fa fa-spinner fa-pulse mr-3 d-none"></i>Login
                                </button>
                                <div class="my-3">
                                    <small style="font-size:16px;">Dont have account? Click <a href="register" class="regular-link">here</a> to register</small>
                                </div>
                                <div><small style="font-size:16px;"><a href="forgot-password" class="regular-link"> Forgot password?</a></small></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include_once('inc/footer.nav.php'); ?>
<?php
if (isset($_GET['reference']) && !empty($_GET['reference']) && ctype_xdigit($_GET['reference']) !==false){
    include_once('controllers/config/database.php');
    include_once('controllers/classes/User.php');
    $db = new Database();
    $connection = $db->connect();
    $user = new User($connection);
    if ($user->activate_user_account($_GET['reference']) =='true'){
        echo "<script>
            window.onload = function() {
                setTimeout(()=>{ toastr['success']('Your account is now activated, you can now logon to your dashboard'); }, 3000);
            }
        </script>";
    } elseif ($user->activate_user_account($_GET['reference']) =='activated'){
        echo "<script>
            window.onload = function() {
              setTimeout(()=>{toastr['info']('Account already activated login to your dashboard');}, 3000);
            }
        </script>";
    } elseif ($user->activate_user_account($_GET['reference']) =='invalid'){
        echo "<script>
            window.onload = function() {
                setTimeout(()=>{ toastr['error']('Invalid link, please make sure you click the correct mail sent');}, 3000);
            }
        </script>";
    }
}

if (isset($_GET['auth']) && $_GET['auth']=='false') {
    $_SESSION['booking']['oldUrl'] = "http//localhost/vanlagos/booking-details";
}
?>
