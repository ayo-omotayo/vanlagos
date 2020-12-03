<?php session_start(); ?>
<?php
if (isset($_GET['adm_id']) && $_GET['adm_id'] != NULL) {
    unset($_SESSION['admin_login']);
    header("Location: ../index");
}
?>
