<?php
session_start();
if (isset($_SESSION['admin_login']) && $_SESSION['admin_login']['status'] == 200) header('Location: mdashboard');
include_once('../controllers/classes/Admin.php');
    if (isset($_POST['login']) & !empty($_POST)) {
        if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
            $ae = htmlspecialchars(strip_tags(trim($_POST['email'])));
            $ap = htmlspecialchars(strip_tags(trim($_POST['password'])));
            if (!empty($resp = $admin->admin_login($ae,$ap))) {
                $_SESSION['admin_login'] = array(
                    'status' => 200,
                    'adm_id' => $resp['adm_id'],
                    'adm_email' => $resp['adm_email'],
                    'adm_name' => $resp['adm_name'],
                    'adm_role' => $resp['adm_role']
                );
                header('Location:mdashboard');
            } else {
                $admin->error = "Invalid credentials, try again (incorrect email/password)";
                $message = $admin->error_alert();
            }
        } else {
            $admin->error = "Email and password required to sign-in";
            $message = $admin->error_alert();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="adminasset/favIcon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>VanLagos Admin Login</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="admincss/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="admincss/bootstrap.min.css" rel="stylesheet" />
    <link href="admincss/paper-dashboard.min790f.css?v=2.0.1" rel="stylesheet" />
</head>
<body class="login-page">
<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
    <div class="container">
        <div class="navbar-wrapper">
            <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="navbar-brand" href="./">VanLagos Admin</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
                <li class="nav-item  active ">
                    <a href="./" class="nav-link">
                        <i class="nc-icon nc-tap-01"></i> Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="wrapper wrapper-full-page ">
    <div class="full-page section-image" filter-color="black" data-image="adminasset/hero-background-image.png">
        <div class="content">
            <div class="container">
                <div class="col-lg-5 col-md-6 ml-auto mr-auto">
                    <?= isset($message) ? $message: null; ?>
                    <form class="form" method="post" action="">
                        <div class="card card-login">
                            <div class="card-header">
                                <div class="card-header"><h3 class="header text-center">VanLagos Admin Login</h3></div>
                            </div>
                            <div class="card-body">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="nc-icon nc-single-02"></i></span>
                                    </div>
                                    <input type="text" name="email" class="form-control form-control-lg" placeholder="Email Address" aria-label="">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="nc-icon nc-key-25"></i></span>
                                    </div>
                                    <input type="password" name="password" placeholder="Password" class="form-control form-control-lg" aria-label="">
                                </div>
                                <br/>
                            </div>
                            <div class="card-footer ">
                                <button class="btn btn-success btn-block mb-3" name="login" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="footer footer-black  footer-white ">
            <div class="container-fluid">
                <div class="row">
                    <nav class="footer-nav">
                        <ul>
                            <li><a href="https://vanlagos.com/" target="_blank">VanLagos</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="adminjs/jquery-3.4.1.min.js"></script>
<script src="adminjs/popper.min.js"></script>
<script src="adminjs/bootstrap.min.js"></script>
<script src="adminjs/perfect-scrollbar.jquery.min.js"></script>
<script src="adminjs/paper-dashboard.min790f.js?v=2.0.1"></script>
<script>
    function checkFullPageBackgroundImage(){
        $page = $('.full-page');
        image_src = $page.data('image');
        if (image_src !== undefined) {
            image_container = '<div class="full-page-background" style="background-image: url(' + image_src + ') "/>';
            $page.append(image_container);
        }
    }
    $(document).ready(function() {
        checkFullPageBackgroundImage();
    });
</script>
</body>
</html>
