<?php ob_start();
include_once ('admininc/mheader.php');
if (!isset($_SESSION['admin_login']) && !isset($_SESSION['admin_login']['status'])) header('Location: ./');
?>
<?php include_once("../controllers/classes/Admin.php");?>
<?php
$booking = $admin->get_all_bookings();
if ($booking->num_rows > 0) {
    $user_bookings_arr = array();
    while ($row = $booking->fetch_assoc()){
        $user_bookings_arr[] = array(
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
        <h4 class="card-title text-center">Customers Booking</h4>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-muted">Bookings</h4>
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
                        foreach ($user_bookings_arr as $booking){
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
    $(document).on("click", "#booking_num", function (e) {
        var result ="";
        e.preventDefault();
        var booknum = $(this).data("booknum");
        // alert(booknum);
        $.ajax({
            url: "admin-process.php",
            type: "POST",
            data: {booknum:booknum,process:101},
            success: function (data) {
                $.each(data.booking_info, function (key, value) {
                    // console.log(value.track_number);
                    result += '<div class="row mt-2" id="details">' +
                        '<div class="col-1 font-weight-bold">'+(key+1)+'</div>' +
                        '<div class="col">'+value.passenger_category+'</div>' +
                        '<div class="col">'+value.fullname+'</div>' +
                        '<div class="col">'+value.gender+'</div></div>';
                });
                $("#details").html(result);
                $('#PassengerInfo').modal('show');
            },
            error: function (errData) {
                $("#errResponse").html("<div class='alert alert-info text-center' role='alert'>No record found</div>");
            }
        });
    });
</script>
