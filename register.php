<?php
ob_start(); session_start();
if (isset($_SESSION['user_login']) && isset($_SESSION['user_login']['user_id'])) header('Location: account');
include_once('inc/header.nav.php');
?>
<main class="register-page mb-5">
    <section class="title-component-wrapper py-5">
        <div class="container"><h3 class="page-title">Register</h3></div>
    </section>
    <section class="form-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-7 mx-auto text-center">
                    <div class="card my-5">
                        <div class="card-body p-3 p-md-5">
                            <h4 class="text-center mb-5"><strong>Register</strong></h4>
                            <div id="response-alert"></div>
                            <form name="registration_form" id="registration_form">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control grey_control" name="firstname" placeholder="Enter Firstname" aria-label="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control grey_control" name="lastname" placeholder="Enter Lastname" aria-label="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="email" class="form-control grey_control" name="email" placeholder="Enter Email" aria-label="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control grey_control" name="phone" placeholder="Enter Phone" aria-label="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select name="gender" class="form-control grey_control" style="background-color: #E5E5E5" aria-label="">
                                            <option value="">Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="password" class="form-control grey_control" name="password" placeholder="Enter Password" aria-label="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="password" class="form-control grey_control" name="repeat_pwd" placeholder="Repeat Password" aria-label="">
                                    </div>
                                </div>
                                <div class="my-3">
                                    <small style="font-size:16px;">
                                        By signing up I agree to the <a href="#" class="regular-link">terms and conditions</a>
                                    </small>
                                </div>
                                <button type="submit" class="btn custom-form-btn px-5 my-2" id="registerBtn">
                                    <i class="fa fa-spinner fa-pulse mr-3 d-none"></i>Sign Up
                                </button>
                                <div class="mt-3">
                                    <small style="font-size:16px;">
                                        <a href="login" class="regular-link" style="color: #4D9F45;">Click here to Login</a>
                                    </small>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include_once('inc/footer.nav.php'); ?>