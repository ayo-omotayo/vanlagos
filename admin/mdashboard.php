<?php ob_start();
include_once ('admininc/mheader.php');
if (!isset($_SESSION['admin_login']) && !isset($_SESSION['admin_login']['status'])) header('Location: ./');
?>
<div class="content">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats px-3 py-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-3 ">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-circle-10 text-info"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-9">
                            <div class="numbers">
                                <p class="card-category">Total Users</p>
                                <p class="card-title" style="font-size: 34px;"><?= ($res=$admin->adminDashboard())?$res['totalUsers']:0; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="row stats">
                        <div class="col-6"><h6 style="text-transform:capitalize;font-size:16px;">Total No User</h6></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats px-3 py-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-3">
                            <div class="icon-big text-center icon-info">
                                <i class="nc-icon nc-alert-circle-i text-danger"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-9">
                            <div class="numbers">
                                <p class="card-category">Inactive Users</p>
                                <p class="card-title" style="font-size: 34px;"><?= ($res=$admin->adminDashboard())?$res['queryUsersInactive']:0; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="row stats">
                        <div class="col-12"><h6 style="text-transform:capitalize;font-size:16px;">Total No Inactive Users</h6></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats px-3 py-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-3">
                            <div class="icon-big text-center icon-info">
                                <i class="nc-icon nc-book-bookmark text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-9">
                            <div class="numbers">
                                <p class="card-category">Bookings</p>
                                <p class="card-title" style="font-size: 34px;"><?= ($res=$admin->adminDashboard())?$res['totalBookings']:0; ?><p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="row stats">
                        <div class="col-12"><h6 style="text-transform:capitalize;font-size:16px;">Total No of Bookings</h6></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row"><div class="col-md-12">&nbsp;</div></div>
    <div class="row">
        <div class="col-12 col-lg-5 col-md-5 col-sm-5 mx-auto">
            <div class="card card-stats px-3 py-3">
                <div class="card-body py-3">
                    <div class="row">
                        <div class="col-1 col-md-1">
                            <div class="icon-big text-center icon-warning"><i class="nc-icon nc-money-coins text-success"></i></div>
                        </div>
                        <div class="col-10 col-md-10">
                            <div class="numbers">
                                <p class="card-category font-weight-bold text-success">Total Booking Amount</p>
                                <p class="card-title" style="font-size: 24px;">₦<?=($res=$admin->adminDashboard()) ? number_format($res['totalAmount'],0):0; ?><p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="stats"><h6 class="text-success">Approved / Confirmed</h6></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-5 col-md-5 col-sm-5 mx-auto">
            <div class="card card-stats px-3 py-3">
                <div class="card-body py-3">
                    <div class="row">
                        <div class="col-1 col-md-1">
                            <div class="icon-big text-center icon-warning"><i class="nc-icon nc-money-coins text-danger"></i></div>
                        </div>
                        <div class="col-10 col-md-10">
                            <div class="numbers">
                                <p class="card-category font-weight-bold text-danger"> Pending Bookings Amount</p>
                                <p class="card-title" style="font-size: 24px;">₦<?= ($res=$admin->adminDashboard()) ? number_format($res['totalUnverifiedAmount'],0):0; ?><p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="stats">
                        <h6 class="text-danger">Pending Confirmation</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once ('admininc/mfooter.php'); ?>

