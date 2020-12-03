<?php include_once('inc/header.nav.php'); ?>
<main class="login-page mb-5">
    <section class="title-component-wrapper py-5">
        <div class="container">
            <h3 class="page-title text-white">Forgot Password</h3>
        </div>
    </section>
    <section class="form-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-5 mx-auto">
                    <div class="card my-5">
                        <div class="card-body p-5">
                            <div class="card-body p-3">
                                <form name="forgot_form" id="forgot_form">
                                    <h4 class="text-center mb-5"><strong>Forgot Your Password ?</strong></h4>
                                    <div id="response-alert"></div>
                                    <div class="form-group">
                                        <input aria-label="" type="email" class="form-control" name="email" placeholder="Enter Your Email Address">
                                    </div>
                                    <div class="my-4 text-center">
                                        <button id="forgotBtn" type="submit" class="btn custom-form-btn px-5 mt-2">
                                            <i class="fa fa-spinner fa-pulse mr-3 d-none"></i>Send Link
                                        </button>
                                    </div>
                                    <p class="my-4 text-center">
                                        <a href="login" style="color: #A8B622; ">Click here to go back to login</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</main>
<?php include_once('inc/footer.nav.php'); ?>