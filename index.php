<?php ob_start(); session_start(); include_once('inc/header.nav.php'); ?>
<style>
    .radius-0{border-radius: 0 !important;}
    .myLab{color: #6B6B6B;}
    ::-webkit-input-placeholder{font-size: 14px;}
    .myInput{font-size: 14px;}
    .rate_check{display: flex;align-items: center;}
    .rate_check .radio_rej {position: absolute;opacity: 0;width: 0;height: 0;}
    .rate_check .radio_rej[type="radio"]:checked + label .label_text {
        border: 1px solid #A8B622;color: #F6F6F6;background: #A8B622;cursor: pointer;
    }
    .rate_check .radio_rej[type="radio"]:not(:checked):hover + label .label_text,.rate_check .radio_rej[type="radio"]:not(:checked):focus + label .label_text {
        color: #4d9f45;
    }
    .rate_check .radio_rej ~ label .label_text {
        border: 1px solid #F6F6F6;background: #F6F6F6;color: #A8B622;cursor: pointer;
    }
</style>
<main>
    <section class="hero"></section>
    <section class="index-booking-form userHireForm mx-3">
        <!-- <div class="card-body bg-white"> -->
        <div class="form-wrapper card-body p-0">
            <ul class="nav nav-pills row hero-main-nav-pills  m-0" id="pills-tab" role="tablist">
                <li class="nav-item col-4 text-center p-0">
                    <a class="nav-link hero-tab-nav-links active px-5 btn-lg" id="pills-hirevan-tab" data-toggle="pill" href="#pills-hirevan" role="tab" aria-controls="pills-hirevan" aria-selected="true">VAN HIRE</a>
                </li>
                <li class="nav-item col-4 text-center p-0">
                    <a class="nav-link hero-tab-nav-links px-5 btn-lg" id="pills-hirebus-tab" data-toggle="pill" href="#pills-hirebus" role="tab" aria-controls="pills-hirebus" aria-selected="false">BUS HIRE</a>
                </li>
                <li class="nav-item col-4 text-center p-0">
                    <a class="nav-link hero-tab-nav-links px-5 btn-lg" id="pills-car-tab" data-toggle="pill" href="#pills-car" role="tab" aria-controls="pills-car" aria-selected="false">CAR HIRE</a>
                </li>
            </ul>
            <div class="tab-content bg-white py-3" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-hirevan" role="tabpanel" aria-labelledby="pills-hirevan-tab">
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
                                            <input type="text" class="form-control radius-0 myInput" name="dropoff_area" id="dropoff_area" placeholder="Input destination address">
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
                                                <option value="3">3 Hours</option>
                                                <option value="4">4 Hours</option>
                                                <option value="5">5 Hours</option>
                                                <option value="6">6 Hours</option>
                                                <option value="7">7 Hours</option>
                                                <option value="8">Full day</option>
                                            </select>
                                        </div>
                                    </div>
<!--                                    <div class="row no-gutters d-none" id="switchTwo67">-->
<!--                                        <div class="col-8 col-md-7 p-2">-->
<!--                                            <input type="text" class="form-control radius-0 calenderDateFull myInput grey_control" name="dropoff_date" id="dropoff_date" placeholder="Drop off date">-->
<!--                                        </div>-->
<!--                                        <div class="col-4 col-md-5 p-2">-->
<!--                                            <select class="form-control radius-0 myInput" name="dropoff_time" id="dropoff_time">-->
<!--                                                <option value="">Drop-off time</option>-->
<!--                                                <option value="5:00 AM">5:00 AM</option>-->
<!--                                                <option value="6:00 AM">6:00 AM</option>-->
<!--                                                <option value="7:00 AM">7:00 AM</option>-->
<!--                                                <option value="8:00 AM">8:00 AM</option>-->
<!--                                                <option value="9:00 AM">9:00 AM</option>-->
<!--                                                <option value="10:00 AM">10:00 AM</option>-->
<!--                                                <option value="11:00 AM">11:00 AM</option>-->
<!--                                                <option value="12:00 PM">12:00 PM</option>-->
<!--                                                <option value="1:00 PM">1:00 PM</option>-->
<!--                                                <option value="2:00 PM">2:00 PM</option>-->
<!--                                                <option value="3:00 PM">3:00 PM</option>-->
<!--                                                <option value="4:00 PM">4:00 PM</option>-->
<!--                                                <option value="5:00 PM">5:00 PM</option>-->
<!--                                                <option value="6:00 PM">6:00 PM</option>-->
<!--                                                <option value="7:00 PM">7:00 PM</option>-->
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                    </div>-->
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
                </div>
                <div class="tab-pane fade" id="pills-hirebus" role="tabpanel" aria-labelledby="pills-hirebus-tab">
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
                                            <input type="text" class="form-control radius-0 calenderDateFull myInput grey_control" id="pickup_dateBus" name="pickup_date" placeholder="Pick-up date">
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
                                            <input type="text" class="form-control radius-0 myInput" name="dropoff_area" id="dropoff_area" placeholder="Input destination address">
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
                                                <option value="3">3 Hours</option>
                                                <option value="4">4 Hours</option>
                                                <option value="5">5 Hours</option>
                                                <option value="6">6 Hours</option>
                                                <option value="7">7 Hours</option>
                                                <option value="FullDay">Full day</option>
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
                </div>
                <div class="tab-pane fade" id="pills-car" role="tabpanel" aria-labelledby="pills-car-tab">
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
                                            <input type="text" class="form-control radius-0 calenderDateFull myInput grey_control" id="pickup_dateCar" name="pickup_date" placeholder="Pick-up date">
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
                                            <input type="text" class="form-control radius-0 myInput" name="dropoff_area" id="dropoff_area" placeholder="Input destination address">
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
                                                <option value="3">3 Hours</option>
                                                <option value="4">4 Hours</option>
                                                <option value="5">5 Hours</option>
                                                <option value="6">6 Hours</option>
                                                <option value="7">7 Hours</option>
                                                <option value="FullDay">Full day</option>
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
                </div>
            </div>
        </div>
    </section>
    <section class="why-choose-us my-5">
        <div class="container">
            <div class="row">
                <div class="col"><h2 class="text-center section-title mb-5">Why Choose us</h2></div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="why-choose-us-list">
                        <li>
                            <img src="assets/images/punctuality.png" class="img img-fluid" alt="">
                            <p class="mt-3"><strong>Punctuality</strong></p>
                        </li>
                        <li>
                            <img src="assets/images/air-condition.png" class="img img-fluid" alt="">
                            <p class="mt-3"><strong>Air conditioned buses</strong></p>
                        </li>
                        <li>
                            <img src="assets/images/comfort.png" class="img img-fluid" alt="">
                            <p class="mt-3"><strong>Comfortable seats & leg space</strong></p>
                        </li>
                        <li>
                            <img src="assets/images/refreshment.png" class="img img-fluid" alt="">
                            <p class="mt-3"><strong>24/7 Customer support</strong></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-white py-5" id="pricingSection">
        <div class="container">
            <h3 class="text-center">Pricing</h3>
            <div class="row no-gutters">
                <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="card m-2">
                        <div class="card-header text-center">
                            <span class="desc-icons">
                                <img src="assets/images/punctuality.png" class="img-fluid" alt="">
                                <img src="assets/images/air-condition.png" class="img-fluid" alt="">
                                <img src="assets/images/refreshment.png" class="img-fluid" alt="">
                                <img src="assets/images/comfort.png" class="img-fluid" alt="">
                            </span>
                        </div>
                        <picture class="py-2 text-center" style="width: 70%; margin: 0 auto">
                            <source srcset="assets/images/van.png" media="(min-width: 800px)">
                            <img src="assets/images/van.png" class="img-fluid" alt="" />
                        </picture>
                        <div class="card-body">
                            <div class="card-text mb-2">
                                <div class="item-name">Van hire</div>
                                <div><span class="price"><span>₦ </span><span>10,000</span></span>&nbsp;<small>for 3hours (min. rate and booking time)</small></div>
                                <div><span class="price"><span>₦ </span><span>5,000</span></span>&nbsp;<small>for each additional hour</small></div>
                                <div><span class="price"><span>₦ </span><span>35,000</span></span>&nbsp;<small>for full day booking (8 hrs)</small></div>
                            </div>
                            <a href="booking?service=van-hire" class="btn btn-block custom-form-btn text-uppercase">Hire Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="card m-2">
                        <div class="card-header text-center">
                            <span class="desc-icons">
                                <img src="assets/images/punctuality.png" class="img-fluid" alt="">
                                <img src="assets/images/air-condition.png" class="img-fluid" alt="">
                                <img src="assets/images/refreshment.png" class="img-fluid" alt="">
                                <img src="assets/images/comfort.png" class="img-fluid" alt="">
                            </span>
                        </div>
                        <picture class="py-2 text-center" style="width: 70%; margin: 0 auto">
                            <source srcset="assets/images/bus.png" media="(min-width: 800px)">
                            <img src="assets/images/bus.png" class="img-fluid" alt="" />
                        </picture>
                        <div class="card-body">
                            <div class="card-text mb-2">
                                <div class="item-name">Bus hire</div>
                                <div><span class="price"><span>₦ </span><span>15,000</span></span>&nbsp;<small>for 3hours (min. rate and booking time)</small></div>
                                <div><span class="price"><span>₦ </span><span>5,000</span></span>&nbsp;<small>for each additional hour</small></div>
                                <div><span class="price"><span>₦ </span><span>40,000</span></span>&nbsp;<small>for full day booking (8 hrs)</small></div>
                            </div>
                            <a href="booking?service=bus-hire" class="btn btn-block custom-form-btn text-uppercase">Hire now</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="card m-2">
                        <div class="card-header text-center">
                            <span class="desc-icons">
                                <img src="assets/images/punctuality.png" class="img-fluid" alt="">
                                <img src="assets/images/air-condition.png" class="img-fluid" alt="">
                                <img src="assets/images/refreshment.png" class="img-fluid" alt="">
                                <img src="assets/images/comfort.png" class="img-fluid" alt="">
                            </span>
                        </div>
                        <picture class="py-2 text-center" style="width: 70%; margin: 0 auto">
                            <source srcset="assets/images/car.png" media="(min-width: 800px)">
                            <img src="assets/images/car.png" class="img-fluid" alt="" />
                        </picture>
                        <div class="card-body">
                            <div class="card-text mb-2">
                                <div class="item-name">Car hire </div>
                                <div><span class="price"><span>₦ </span><span>5,000</span></span>&nbsp;<small>for 3hours (min. rate and booking time)</small></div>
                                <div><span class="price"><span>₦ </span><span>2,000</span></span>&nbsp;<small>for each additional hour</small></div>
                                <div><span class="price"><span>₦ </span><span>15,000</span></span>&nbsp;<small>for full day booking (8 hrs)</small></div>
                            </div>
                            <a href="booking?service=car-hire" class="btn btn-block custom-form-btn text-uppercase">Hire now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="how-it-works">
        <div class="container-fluid" style="height: 100%;">
            <div class="row" style="height: 100%;">
                <div class="col-12 col-md-6 offset-md-6 content-area pl-5" style="height: 100%;">
                    <div class="how-it-works-inner">
                        <div>
                            <h2 class="my-5 section-title">How it works</h2>
                            <ul class="">
                                <li>Select location & Destination and dates</li>
                                <li>Provide required details</li>
                                <li>Book & make payment</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="problem-then-contact-us">
        <div class="container py-4 text-white problem-then-contact-us-inner">
            <h4>Having Any Problem Booking? Let Us Know</h4>
            <a href="contact-us" class="btn custom-form-btn radius-0 px-5">Contact Us</a>
        </div>
    </section>
</main>
<?php include_once('inc/footer.nav.php'); ?>