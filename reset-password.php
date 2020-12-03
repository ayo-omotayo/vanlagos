<?php ob_start(); session_start();
if (isset($_SESSION['user_login']) && isset($_SESSION['user_login']['user_id'])) header('Location: ../../account/index');
include_once('inc/header.nav.php');
?>
<?php
$selector = isset($_GET['selector']) ? $_GET['selector']:null;
$validator = isset($_GET['validator']) ? $_GET['validator']:null;

if (empty($selector) || empty($validator)) { ?>
    <div class="container" style="margin: 50px auto;display: flex;flex-direction: column;align-items: center;">
        <h1 class="text-center text-danger" style="font-size: 120px">404</h1>
        <p class="text-center" style="font-size: 24px">Page not found (invalid link) </p>
        <p class="text-center" style="font-size: 16px"><a href="forgot-password">Back to forgot password</a></p>
    </div>
<?php } else {
    if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
        ?>
<main class="login-page mb-5">
    <section class="title-component-wrapper py-5">
        <div class="container"><h3 class="page-title text-white">Reset Password</h3></div>
    </section>
    <section class="form-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-5 mx-auto">
                    <div class="card my-5">
                        <div class="card-body p-5">
                            <div class="card-body p-2">
                                <form name="recover_form" id="recover_form">
                                    <h4 class="text-center mb-5"><strong>Reset Your Password</strong></h4>
                                    <div id="response-alert"></div>
                                    <div class="form-group mb-4">
                                        <input type="hidden" name="selector" id="selector" value="<?= $selector; ?>">
                                        <input type="hidden" name="validator" id="validator" value="<?= $validator; ?>">
                                        <input aria-label="" type="password" class="form-control" name="res_password" placeholder="Enter New Password">
                                    </div>
                                    <div class="form-group">
                                        <input aria-label="" type="password" class="form-control" name="res_repeat_pwd" placeholder="Confirm Password">
                                    </div>
                                    <div class="my-4 text-center">
                                        <button id="recoverBtn" type="submit" class="btn custom-form-btn px-5 mt-2">
                                            <i class="fa fa-spinner fa-pulse mr-3 d-none"></i>Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</main>
<?php } else { ?>
    <div class="container" style="margin: 50px auto;display: flex;flex-direction: column;align-items: center;">
        <h1 class="text-center text-danger" style="font-size: 120px">404</h1>
        <p class="text-center" style="font-size: 24px">Page not found (invalid link)</p>
        <p class="text-center" style="font-size: 16px"><a href="forgot-password">Back to forgot password</a></p>
    </div>
<?php } } ?>
<?php include_once('inc/footer.nav.php'); ?>