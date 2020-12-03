<?php ob_start(); session_start();
if (isset($_GET['user_id']) && $_GET['user_id'] != NULL) {
    unset($_SESSION['user_login']);
    unset($_SESSION['booking']);
    header("Location: ../index");
}
?>
