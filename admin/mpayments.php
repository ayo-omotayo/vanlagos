<?php ob_start();
include_once ('admininc/mheader.php');
if (!isset($_SESSION['admin_login']) && !isset($_SESSION['admin_login']['status'])) header('Location: ./');
?>
<?php include_once("../controllers/classes/Admin.php");

$payment = $admin->get_all_payment();
if ($payment->num_rows > 0) {
    $payments_arr = array();
    while ($row = $payment->fetch_assoc()){
        $payments_arr[] = array(
            "booking_id" => $row['booking_id'],
            "booking_num" => $row['booking_num'],
            "user_id" => $row['user_id'],
            "book_fname" => $row['book_fname'],
            "book_lname" => $row['book_lname'],
            "book_email" => $row['book_email'],
            "book_gender" => $row['book_gender'],
            "book_phone" => $row['book_phone'],
            "amount" => $row['amount'],
            "payment_option" => $row['payment_option'],
            "status" => $row['status']
        );
    }
} else {
    $admin->error = "No record found";
    $message = $admin->error_alert();
}
?>
<div class="content">
    <div class="col-md-12">
        <h4 class="card-title text-center">All Payments</h4>
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered" style="width: 100%" cellspacing="0">
                    <thead class="text-success">
                    <tr>
                        <th>S/N</th>
                        <th>Booking No</th>
                        <th>User</th>
                        <th>Phone</th>
                        <th>Amount</th>
                        <th>Payment Type</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!isset($message)){
                        $n=0;
                        foreach ($payments_arr as $payment){
                            ?>
                            <tr>
                                <td><?= ++$n; ?></td>
                                <td><?= $payment['booking_num']; ?></td>
                                <td><?= $payment['book_email']; ?></td>
                                <td><?= $payment['book_phone']; ?></td>
                                <td><?= '₦'.number_format($payment['amount'],0); ?>
                                <td><?= $payment['payment_option']; ?>
                                <td>
                                    <?= ($payment['status']=='Paid' ?
                                        "<span class='badge badge-pill badge-success'>Paid</span>":
                                        "<span class='badge badge-pill badge-danger'>Unverified</span>");
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
