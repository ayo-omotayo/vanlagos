<?php ob_start();
include_once ('admininc/mheader.php');
if (!isset($_SESSION['admin_login']) && !isset($_SESSION['admin_login']['status'])) header('Location: ./');
?>
<?php include_once("../controllers/classes/Admin.php");?>
<?php
$user = $admin->get_all_customers();
if ($user->num_rows > 0) {
    $users_arr = array();
    while ($row = $user->fetch_assoc()){
        $users_arr[] = array(
            "user_id" => $row['user_id'],
            "firstname" => $row['firstname'],
            "lastname" => $row['lastname'],
            "email" => $row['email'],
            "phone" => $row['phone'],
            "gender" => $row['gender'],
            "activated" => $row['activated']
        );
    }
} else {
    $admin->error = "No record found";
    $message = $admin->error_alert();
}
?>
<div class="content">
    <div class="col-md-12">
        <h4 class="card-title text-center">Our Customers</h4>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-muted">Customers</h4>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered" style="width: 100%" cellspacing="0">
                    <thead class="text-success">
                    <tr>
                        <th>S/N</th>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!isset($message)){
                        $n=0;
                        foreach ($users_arr as $users){
                            ?>
                            <tr>
                                <td><?= ++$n; ?></td>
                                <td><?= $users['firstname']." ".$users['lastname']; ?></td>
                                <td><?= $users['email']; ?></td>
                                <td><?= $users['phone']; ?>
                                <td><?= $users['gender']; ?>
                                <td>
                                    <?= ($users['activated']=='0'?
                                        "<span class='badge badge-pill badge-danger'>Not active</span>":
                                        "<span class='badge badge-pill badge-success'>Activated</span>");
                                    ?>
                                </td>
                            </tr>
                        <?php  } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include_once ('admininc/mfooter.php'); ?>


