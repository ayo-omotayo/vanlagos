<?php
ob_start(); session_start();
//if (isset($_SESSION['user_login']) && isset($_SESSION['user_login']['user_id'])) header('Location: account');
include_once('inc/header.nav.php');
?>
<main class="contact-us-container mb-5">
    <section class="title-component-wrapper py-5">
        <div class="container">
            <h3 class="page-title">Contact Us</h3>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-7">
                <div class="card my-5">
                    <div class="card-body p-5">
                        <div id="response-alert"></div>
                        <form name="contact_us_form" id="contact_us_form">
                            <h4 class=" pb-5">Send us a message</h4>
                            <div class="form-group">
                                <label for="fullname">Full Name:</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter fullname">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject">
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5"></textarea>
                            </div>
                            <div class="my-4">
                                <button type="submit" class="btn custom-form-btn px-5 mb-3" id="contactBtn">
                                    <i class="fa fa-spinner fa-pulse mr-3 d-none"></i>Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12  col-md-5 pt-5 pr-2">
                <h5 class="py-3">For further inquiries, see our office address below: </h5>
                <p class="py-2 "><span><strong>Address:</strong></span> ROYAL RESIDENCE, olay street, ondo state</p>
                <p><span><strong>Phone:</strong></span> 07065194485</p>
                <p><span><strong>Email:</strong></span> contact@vanlagos.com</p>
            </div>
        </div>
    </div>
</main>
<?php include_once('inc/footer.nav.php'); ?>