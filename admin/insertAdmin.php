<?php
include_once('../controllers/config/database.php');
include_once('../controllers/classes/Admin.php');

if ($admin->create_admin_user('Admin',"admin@vanlagos.com","admin@123",'admin')){
    echo "DONE";
} else {
    echo "ERROR";
}

?>