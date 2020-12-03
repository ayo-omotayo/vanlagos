<?php ob_start(); session_start();
include_once('inc/header.nav.php');
?>
<style>
    .radius-0{border-radius: 0 !important;}
    .myLab{color: #6B6B6B;}
    ::-webkit-input-placeholder{font-size: 14px;}
    .myInput{font-size: 14px;}
    .rate_check{display: flex;align-items: center;}
    .rate_check .radio_rej {position: absolute;opacity: 0;width: 0;height: 0;}
    .rate_check .radio_rej[type="radio"]:checked + label .label_text {border: 1px solid #A8B622;color: #F6F6F6;background: #A8B622;cursor: pointer;}
    .rate_check .radio_rej[type="radio"]:not(:checked):hover + label .label_text,.rate_check .radio_rej[type="radio"]:not(:checked):focus + label .label_text {
        color: #4d9f45;
    }
    .rate_check .radio_rej ~ label .label_text {border: 1px solid #F6F6F6;background: #F6F6F6;color: #A8B622;cursor: pointer;}
</style>
<?php if (isset($_GET['service'])) { ?>
<main class="bus-hire-page mb-5">
    <div class="bg-white m-0 p-3 page-info-banner">
        <div class="container">
            <p>
                <span>
                    You selected <?php
                    if($_GET['service']=="van-hire") echo "Van";
                    elseif($_GET['service']=="bus-hire") echo "Bus";
                    else echo "Car";
                    ?> hire </span>&nbsp;&nbsp;<span>(Kindly help know the time and date you want to hire)</span>
            </p>
        </div>
    </div>
    <div class="container">
        <section class="bus-hire-booking-form mt-5 userHireForm">
            <div class="form-wrapper card-body p-0">
                <div class="bg-white py-4">
                    <?php if (isset($_GET['service']) && $_GET['service']=="van-hire") { ?>
                    <form name="van_hire_form" id="van_hire_form" class="container p-md-3">
                        <!-- Pick-up place -->
<!--                        <div class="row no-gutters my-3 mx-2">-->
<!--                            <div class="rate_check">-->
<!--                                <input type="radio" class="radio_rej" value="daily_rate" name="payment_rate" id="daily_rate" checked>-->
<!--                                <label for="daily_rate" onclick="performSwitch()"><span class="custom_radio"></span><span class="label_text px-5 py-2">Daily</span></label>-->
<!--                            </div>-->
<!--                            <div class="rate_check ml-3">-->
<!--                                <input type="radio" class="radio_rej" value="hourly_rate" name="payment_rate" id="hourly_rate">-->
<!--                                <label for="hourly_rate" onclick="performSwitch()"><span class="custom_radio"></span><span class="label_text px-5 py-2">Hourly</span></label>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="row no-gutters">
                            <div class="col-12 col-md-6">
                                <div class="form_grp mb-md-3">
                                    <label for="pickup_area" class="mx-2 my-0 myLab">Pick-up</label>
                                    <div class="row no-gutters">
                                        <div class="col-8 col-md-8 p-2">
                                            <input type="hidden" name="service_type" value="van hire">
                                            <input type="text" class="form-control radius-0 myInput" name="pickup_area" id="pickup_area" placeholder="Input your address">
                                        </div>
                                        <div class="col-4 col-md-4 p-2">
                                            <select class="form-control radius-0 myInput" name="pickup_state" id="pickup_state" aria-label="">
                                                <option value="" selected>State</option>
                                                <option value="lagos">Lagos</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form_grp">
                                    <div class="row no-gutters">
                                        <div class="col-7 col-md-7 p-2">
                                            <input type="text" class="form-control radius-0 calenderDateFull myInput grey_control" id="pickup_date" name="pickup_date" placeholder="Pick-up date">
                                        </div>
                                        <div class="col-5 col-md-5 p-2">
                                            <select class="form-control radius-0 myInput" name="pickup_time" id="pickup_time">
                                                <option value="">Pick-up time</option>
                                                <option value="7:00 AM">7:00 AM</option>
                                                <option value="8:00 AM">8:00 AM</option>
                                                <option value="9:00 AM">9:00 AM</option>
                                                <option value="10:00 AM">10:00 AM</option>
                                                <option value="11:00 AM">11:00 AM</option>
                                                <option value="12:00 PM">12:00 PM</option>
                                                <option value="1:00 PM">1:00 PM</option>
                                                <option value="2:00 PM">2:00 PM</option>
                                                <option value="3:00 PM">3:00 PM</option>
                                                <option value="4:00 PM">4:00 PM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form_grp mb-md-3">
                                    <label for="#" class="mx-2 my-0 myLab">Destination</label>
                                    <div class="row no-gutters">
                                        <div class="col-8 col-md-8 p-2">
                                            <input type="text" class="form-control radius-0 myInput" name="dropoff_area" id="dropoff_area" placeholder="Input your address">
                                        </div>
                                        <div class="col-4 col-md-4 p-2">
                                            <select class="form-control radius-0 myInput" name="dropoff_state" id="dropoff_state">
                                                <option value="" selected>State</option>
                                                <option value="lagos">Lagos</option>
                                                <option value="osun">Osun</option>
                                                <option value="ogun">Ogun</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form_grp">
                                    <div class="row no-gutters" id="switchOne67">
                                        <div class="col-8 col-md-7 p-2">
                                            <select name="no_of_hours" id="no_of_hours" class="form-control radius-0 myInput">
                                                <option value="">No of hours</option>
                                                <option value="3">3 hours</option>
                                                <option value="4">4 hours</option>
                                                <option value="5">5 hours</option>
                                                <option value="6">6 hours</option>
                                                <option value="7">7 hours</option>
                                                <option value="8">Full day</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn my-4 mx-2 custom-form-btn px-5 radius-0" id="bookingBtn">
                                    <i class="fa fa-spinner fa-pulse mr-3 d-none"></i>Continue Reservation
                                </button>
                            </div>
                        </div>
                    </form>
                    <?php } elseif (isset($_GET['service']) && $_GET['service']=="bus-hire") { ?>
                    <form name="bus_hire_form" id="bus_hire_form" class="container p-md-3">
                        <div class="row no-gutters">
                            <div class="col-12 col-md-6">
                                <div class="form_grp mb-md-3">
                                    <label for="pickup_area" class="mx-2 my-0 myLab">Pick-up</label>
                                    <div class="row no-gutters">
                                        <div class="col-8 col-md-8 p-2">
                                            <input type="hidden" name="service_type" value="bus hire">
                                            <input type="text" class="form-control radius-0 myInput" name="pickup_area" id="pickup_area" placeholder="Input your address">
                                        </div>
                                        <div class="col-4 col-md-4 p-2">
                                            <select class="form-control radius-0 myInput" name="pickup_state" id="pickup_state" aria-label="">
                                                <option value="" selected>State</option>
                                                <option value="lagos">Lagos</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form_grp">
                                    <div class="row no-gutters">
                                        <div class="col-7 col-md-7 p-2">
                                            <input type="text" class="form-control radius-0 calenderDateFull myInput grey_control" id="pickup_date" name="pickup_date" placeholder="Pick-up date">
                                        </div>
                                        <div class="col-5 col-md-5 p-2">
                                            <select class="form-control radius-0 myInput" name="pickup_time" id="pickup_time">
                                                <option value="">Pick-up time</option>
                                                <option value="7:00 AM">7:00 AM</option>
                                                <option value="8:00 AM">8:00 AM</option>
                                                <option value="9:00 AM">9:00 AM</option>
                                                <option value="10:00 AM">10:00 AM</option>
                                                <option value="11:00 AM">11:00 AM</option>
                                                <option value="12:00 PM">12:00 PM</option>
                                                <option value="1:00 PM">1:00 PM</option>
                                                <option value="2:00 PM">2:00 PM</option>
                                                <option value="3:00 PM">3:00 PM</option>
                                                <option value="4:00 PM">4:00 PM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form_grp mb-md-3">
                                    <label for="#" class="mx-2 my-0 myLab">Destination</label>
                                    <div class="row no-gutters">
                                        <div class="col-8 col-md-8 p-2">
                                            <input type="text" class="form-control radius-0 myInput" name="dropoff_area" id="dropoff_area" placeholder="Input your address">
                                        </div>
                                        <div class="col-4 col-md-4 p-2">
                                            <select class="form-control radius-0 myInput" name="dropoff_state" id="dropoff_state">
                                                <option value="" selected>State</option>
                                                <option value="lagos">Lagos</option>
                                                <option value="osun">Osun</option>
                                                <option value="ogun">Ogun</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form_grp">
                                    <div class="row no-gutters" id="switchOne67">
                                        <div class="col-8 col-md-7 p-2">
                                            <select name="no_of_hours" id="no_of_hours" class="form-control radius-0 myInput">
                                                <option value="">No of hours</option>
                                                <option value="3">3 hours</option>
                                                <option value="4">4 hours</option>
                                                <option value="5">5 hours</option>
                                                <option value="6">6 hours</option>
                                                <option value="7">7 hours</option>
                                                <option value="8">Full day</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn my-4 mx-2 custom-form-btn px-5 radius-0" id="bookingBusBtn">
                                    <i class="fa fa-spinner fa-pulse mr-3 d-none"></i>Continue Reservation
                                </button>
                            </div>
                        </div>
                    </form>
                    <?php } elseif(isset($_GET['service']) && $_GET['service']=="car-hire"){  ?>
                    <form name="car_hire_form" id="car_hire_form" class="container p-md-3">
                            <div class="row no-gutters">
                                <div class="col-12 col-md-6">
                                    <div class="form_grp mb-md-3">
                                        <label for="pickup_area" class="mx-2 my-0 myLab">Pick-up</label>
                                        <div class="row no-gutters">
                                            <div class="col-8 col-md-8 p-2">
                                                <input type="hidden" name="service_type" value="car hire">
                                                <input type="text" class="form-control radius-0 myInput" name="pickup_area" id="pickup_area" placeholder="Input your address">
                                            </div>
                                            <div class="col-4 col-md-4 p-2">
                                                <select class="form-control radius-0 myInput" name="pickup_state" id="pickup_state" aria-label="">
                                                    <option value="" selected>State</option>
                                                    <option value="lagos">Lagos</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_grp">
                                        <div class="row no-gutters">
                                            <div class="col-7 col-md-7 p-2">
                                                <input type="text" class="form-control radius-0 calenderDateFull myInput grey_control" id="pickup_date" name="pickup_date" placeholder="Pick-up date">
                                            </div>
                                            <div class="col-5 col-md-5 p-2">
                                                <select class="form-control radius-0 myInput" name="pickup_time" id="pickup_time">
                                                    <option value="">Pick-up time</option>
                                                    <option value="7:00 AM">7:00 AM</option>
                                                    <option value="8:00 AM">8:00 AM</option>
                                                    <option value="9:00 AM">9:00 AM</option>
                                                    <option value="10:00 AM">10:00 AM</option>
                                                    <option value="11:00 AM">11:00 AM</option>
                                                    <option value="12:00 PM">12:00 PM</option>
                                                    <option value="1:00 PM">1:00 PM</option>
                                                    <option value="2:00 PM">2:00 PM</option>
                                                    <option value="3:00 PM">3:00 PM</option>
                                                    <option value="4:00 PM">4:00 PM</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form_grp mb-md-3">
                                        <label for="#" class="mx-2 my-0 myLab">Destination</label>
                                        <div class="row no-gutters">
                                            <div class="col-8 col-md-8 p-2">
                                                <input type="text" class="form-control radius-0 myInput" name="dropoff_area" id="dropoff_area" placeholder="Input your address">
                                            </div>
                                            <div class="col-4 col-md-4 p-2">
                                                <select class="form-control radius-0 myInput" name="dropoff_state" id="dropoff_state">
                                                    <option value="" selected>State</option>
                                                    <option value="lagos">Lagos</option>
                                                    <option value="osun">Osun</option>
                                                    <option value="ogun">Ogun</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_grp">
                                        <div class="row no-gutters" id="switchOne67">
                                            <div class="col-8 col-md-7 p-2">
                                                <select name="no_of_hours" id="no_of_hours" class="form-control radius-0 myInput">
                                                    <option value="">No of hours</option>
                                                    <option value="3">3 hours</option>
                                                    <option value="4">4 hours</option>
                                                    <option value="5">5 hours</option>
                                                    <option value="6">6 hours</option>
                                                    <option value="7">7 hours</option>
                                                    <option value="8">Full day</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn my-4 mx-2 custom-form-btn px-5 radius-0" id="bookingCarBtn">
                                        <i class="fa fa-spinner fa-pulse mr-3 d-none"></i>Continue Reservation
                                    </button>
                                </div>
                            </div>
                        </form>
                    <?php } else header("Location: ./");  ?>
                </div>
            </div>
        </section>
    </div>
</main>
<?php } else header("Location: ./");  ?>
<?php include_once('inc/footer.nav.php'); ?>