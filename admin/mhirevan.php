<?php ob_start();
include_once ('admininc/mheader.php');
if (!isset($_SESSION['admin_login']) && !isset($_SESSION['admin_login']['status'])) header('Location: ./');
?>
<?php include_once("../controllers/classes/Admin.php");?>
<?php
$hire_van = $admin->get_all_hire_bus('van hire');
if ($hire_van->num_rows > 0) {
    $hire_vans_arr = array();
    while ($row = $hire_van->fetch_assoc()){
        $hire_vans_arr[] = array(
            "booking_id" => $row['booking_id'],
            "email" => $row['email'],
            "phone" => $row['phone'],
            "firstname" => $row['firstname'],
            "lastname" => $row['lastname'],
            "payment_option" => $row['payment_option'],
            "amount" => $row['amount'],
            "status" => $row['status'],
            "booking_num" => $row['booking_num'],
            "service_type" => $row['service_type'],
            "pickup_area" => $row['pickup_area'],
            "pickup_state" => $row['pickup_state'],
            "destination_area" => $row['destination_area'],
            "destination_state" => $row['destination_state'],
            "pickup_date" => date("d M Y", strtotime($row['pickup_date'])),
            "pickup_time" => $row['pickup_time'],
            "no_of_hours" => $row['no_of_hours'],
            "load_offload" => $row['load_offload'],
            "fragile" => $row['fragile'],
            "description" => $row['description'],
        );
    }
} else {
    $admin->error = "No record found";
    $message = $admin->error_alert();
}
?>
<div class="content">
    <div class="col-md-12">
        <h4 class="card-title text-center">Van Hire</h4>
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered" style="width: 100%" cellspacing="0">
                    <thead class="text-success">
                    <tr>
                        <th>S/N</th>
                        <th>User Email ID</th>
                        <th>Book No</th>
                        <th>Type</th>
                        <th>PickupAddress</th>
                        <th>Destination</th>
                        <th>PickupDate</th>
                        <th>Amount</th>
                        <th>Hours</th>
                        <th>Method</th>
                        <th>LoadOff</th>
                        <th>Fragile</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!isset($message)){
                        $n=0;
                        foreach ($hire_vans_arr as $booking){
                            ?>
                            <tr>
                                <td><?= ++$n; ?></td>
                                <td><?= $booking['email']; ?></td>
                                <td><b class="text-info"><?= $booking['booking_num']; ?></b></td>
                                <td><?= $booking['service_type']; ?>
                                <td><?= $booking['pickup_area']." ".$booking['pickup_state']; ?></td>
                                <td><?= $booking['destination_area']." ".$booking['destination_state']; ?></td>
                                <td><?= $booking['pickup_date']." ".$booking['pickup_time']; ?></td>
                                <td><?= '₦'.number_format($booking['amount'],0); ?></td>
                                <td><?= ($booking['no_of_hours']=='8')?'Full Day':$booking['no_of_hours']; ?></td>
                                <td><?= $booking['payment_option']; ?></td>
                                <td><?= $booking['load_offload']; ?></td>
                                <td><?= $booking['fragile']; ?></td>
                                <td><?= $booking['description']; ?></td>
                                <td><?= ($booking['status']=='Paid')?'<b class="text-success">Paid</b>':'<b class="text-danger">Pending</b>'; ?></b></td>
                            </tr>
                        <?php  } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include_once ('admininc/mfooter.php'); ?>

