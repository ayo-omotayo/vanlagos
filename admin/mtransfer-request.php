<?php ob_start();
include_once ('admininc/mheader.php');
if (!isset($_SESSION['admin_login']) && !isset($_SESSION['admin_login']['status'])) header('Location: ./');

include_once("../controllers/classes/Admin.php");

$transfer = $admin->get_all_transfer_request();
if ($transfer->num_rows > 0) {
    $transfers_arr = array();
    while ($row = $transfer->fetch_assoc()){
        $transfers_arr[] = array(
            "booking_id" => $row['booking_id'],
            "transfer_id" => $row['transfer_id'],
            "booking_num" => $row['booking_num'],
            "book_email" => $row['book_email'],
            "fullname" => $row['book_fname']." ".$row['book_fname'],
            "account_name" => $row['account_name'],
            "amount_transferred" => $row['amount_transferred'],
            "confirmed" => $row['confirmed'],
            "created_at" => $row['created_at'],
        );
    }
} else {
    $admin->error = "No record found";
    $message = $admin->error_alert();
}
?>

<div class="content">
    <div class="col-md-12">
        <h4 class="card-title text-center">Transfer Request</h4>
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered" style="width: 100%" cellspacing="0">
                    <thead class="text-success">
                    <tr>
                        <th>S/N</th>
                        <th>User Email</th>
                        <th>Booking No</th>
                        <th>Account Name</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Sent On</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!isset($message)){
                        $n=0;
                        foreach ($transfers_arr as $transfers){
                            ?>
                            <tr>
                                <td><?= ++$n; ?></td>
                                <td><?= $transfers['book_email']; ?></td>
                                <td><?= $transfers['booking_num']; ?></td>
                                <td><?= $transfers['account_name']; ?></td>
                                <td><?= '₦'.number_format($transfers['amount_transferred'],0); ?>
                                <td>
                                    <?= ($transfers['confirmed']=='false' ?
                                        "<span class='badge badge-pill badge-danger'>Pending Confirmation</span>":
                                        "<span class='badge badge-pill badge-success'>Confirmed</span>");
                                    ?>
                                </td>
                                <td><?= date("d-M-yy", strtotime($transfers['created_at'])); ?></td>
                                <td>
                                    <button <?= ($transfers['confirmed']=='true' ? 'disabled':''); ?> class="btn btn-info btn-sm" id="transfers" data-id="<?= $transfers['transfer_id']; ?>"  data-booking_id="<?= $transfers['booking_id']; ?>">
                                        Confirm Payment
                                    </button>
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
<script>
    $(document).on("click", "#transfers", function () {
        var transfer_id = $(this).data("id");
        var booking_id = $(this).data("booking_id");
        swal({
            title: 'Are you sure?',text: "You about to confirm this amount as paid", type: 'warning', showCancelButton: true,
            confirmButtonClass: 'btn btn-success', cancelButtonClass: 'btn btn-danger', confirmButtonText: 'Yes, confirm',
        }).then(function() {
            $("#transfers").attr("disabled",true);$("#transfers").html('Loading..');
            $.ajax({
                url: "admin-process.php",
                type: "POST",
                data: {transfer_id:transfer_id,booking_id:booking_id,process:401},
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
                },
                complete: function () {
                    $("#transfers").attr("disabled",false);$("#transfers").html('Confirm Payment');
                }
            });
        });
    });
</script>
