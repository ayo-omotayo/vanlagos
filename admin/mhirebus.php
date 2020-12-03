<?php ob_start();
include_once ('admininc/mheader.php');
if (!isset($_SESSION['admin_login']) && !isset($_SESSION['admin_login']['status'])) header('Location: ./');
?>
<?php include_once("../controllers/classes/Admin.php");?>
<?php
$hire_bus = $admin->get_all_hire_bus('bus hire');
if ($hire_bus->num_rows > 0) {
    $hire_buss_arr = array();
    while ($row = $hire_bus->fetch_assoc()){
        $hire_buss_arr[] = array(
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
        );
    }
} else {
    $admin->error = "No record found";
    $message = $admin->error_alert();
}
?>
<div class="content">
    <div class="col-md-12">
        <h4 class="card-title text-center">Bus Hire</h4>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-muted">Bus Hire</h4>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered" style="width: 100%" cellspacing="0">
                    <thead class="text-success">
                    <tr>
                        <th>S/N</th>
                        <th>User Email ID</th>
                        <th>Book No</th>
                        <th>Type</th>
                        <th>Pickup Add</th>
                        <th>Destination</th>
                        <th>Pickup Date</th>
                        <th>Amount</th>
                        <th>Hours</th>
                        <th>Method</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!isset($message)){
                        $n=0;
                        foreach ($hire_buss_arr as $booking){
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
<script>
    $(document).on("click", "#hire_bus", function () {
        var hire_id = $(this).data("id");
        $.ajax({
            url: "admin-process.php",
            type: "POST",
            data: {hire_id:hire_id,process:201},
            success: function (data) {
                $.notify({icon: "nc-icon nc-bell-55", message: data.message}, {type: 'success', timer: 8000,
                    placement: {from: 'top', align: 'right'}
                });
                setTimeout(function () {window.location.reload();}, 1000);
            },
            error: function (errData) {
                $.notify({icon: "nc-icon nc-bell-55", message: errData.responseJSON.message}, {type: 'danger', timer: 8000,
                    placement: {from: 'top', align: 'right'}
                });
            }
        });
    });
</script>

