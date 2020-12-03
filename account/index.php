<?php
include_once('../controllers/config/database.php');
include_once('../controllers/classes/Bookings.php');
$db = new Database();
$connection = $db->connect();
$productCon = new Bookings($connection);

if (!isset($_SESSION['user_login']) && !isset($_SESSION['user_login']['user_id'])) header('Location: ../login');
include_once('../inc/header.nav.php')
?>
<main class="user-profile-container mb-5">
    <section class="title-component-wrapper py-5">
        <div class="container"><h3 class="page-title">My Account</h3></div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col bg-white p-3 mt-3">
                    <h5>Welcome, <?=$_SESSION['user_login']['firstname']." ".$_SESSION['user_login']['lastname']; ?></h5>
                    <p><?=$_SESSION['user_login']['phone']?></p>
                    <p><?=$_SESSION['user_login']['email']?></p>
                </div>
            </div>
            <div class="row">
                <div class="col bg-white p-3 mt-4">
                    <h5 class="mb-4">Booking History</h5>
                    <div class="table-responsive-lg">
                        <table class="table table-borderless text-center" id="Booking" style="font-size: 12px">
                            <thead  class="thead-light">
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Book ID</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Service</th>
                                    <th scope="col">PickUp</th>
                                    <th scope="col">Destination</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = $connection->query("SELECT * FROM tbl_booking INNER JOIN tbl_payment ON tbl_booking.booking_id=tbl_payment.booking_id ");
                            if($query->num_rows > 0){$n=0;
                            while ($row = $query->fetch_assoc()){
                            ?>
                            <tr>
                                <th scope="row"><?=++$n;?></th>
                                <td><?= date("d/M/Y", strtotime($row['booking_date']));?></td>
                                <th>#<?= $row['booking_num'];?></th>
                                <td class="text-success">₦ <?= number_format($row['amount'],0);?></td>
                                <td><?= ($row['status']=="Paid")?"<span class='badge badge-success px-4'>Paid</span>":
                                    "<span class='badge badge-danger px-3'>Pending</span>"; ?>
                                </td>
                                <td><?= $row['service_type'];?></td>
                                <td><?= $row['pickup_area'] ." ".$row['pickup_state'];?></td>
                                <td><?= $row['destination_area'] ." ".$row['destination_state'];?></td>
                            </tr>
                            <?php } } else {
                                echo "<div class='p-4'><p>You currently have no preview bookings</p></div>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>
<?php include_once('../inc/footer.nav.php'); ?>
<script>
    $(document).ready(function() {
        $('#Booking').DataTable({
            "searching":false,
            "lengthChange":false,
            "bSort":false,
            "responsive":true
        });
    });
</script>
