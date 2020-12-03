<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Van Lagos</title>
    <base href="http://localhost/vanlagos/">
    <link rel="icon" type="image/png" href="assets/images/favIcon.png" sizes="16x16">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/fontA/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/jquery.timepicker.min.css">
    <link rel="stylesheet" href="assets/css/toastr.min.css">
    <link rel="stylesheet" href="assets/css/datatables.css">
    <style>
        .leftspan{color:#6B6B6B;background:#f0f0f0;display: flex;align-items: center}
        .myInput{ font-size: 0.9em}
        ::-webkit-input-placeholder { color: #ccc;}
        .myLabel{color: #555;font-weight: 500;}
        .curve-remove {border-radius: 0 !important;}
        form .error{border-color: #e74c3c !important;}  form label.error{font-size: 0.7rem;color: #e74c3c;}
        .alert {padding: .75rem 0 !important;border-radius:0 !important;}
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg main-nav-bar sticky-top">
    <div class="container">
        <a class="navbar-brand" href="./"><h2>Brand Logo</h2></a>
        <button class="navbar-toggler mobile-menu-icon" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars fa-1x"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) =='about-us.php') echo 'active'; ?>">
                    <a class="nav-link custom-nav-link" href="about-us">About Us</a>
                </li>
                <li class="nav-item"><a class="nav-link custom-nav-link" href="#pricingSection">Pricing</a></li>
                <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) =='contact-us.php') echo 'active'; ?>">
                    <a class="nav-link custom-nav-link" href="contact-us">Contact Us</a>
                </li>
                <?php if (isset($_SESSION['user_login'])) { ?>
                <li class="nav-item active">
                    <a class="nav-link custom-nav-link" href="account/index"><i class="fas fa-user"></i> My Account</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link custom-nav-link" href="logout/<?= bin2hex(date('Y/M/dd').$_SESSION['user_login']['phone']); ?>">
                        Logout
                    </a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="btn btn-sm btn-custom-green-outline curve-remove custom-nav-btn px-3 mx-md-2" href="login">Sign In</a>
                </li>
                <li class="nav-item mt-2 mt-md-0">
                    <a class="btn btn-sm btn-custom-green-outline curve-remove custom-nav-btn px-3 mx-md-2" href="register">Sign Up</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>