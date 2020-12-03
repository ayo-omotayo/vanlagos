<?php ob_start();
include_once ('admininc/mheader.php');

if (!isset($_SESSION['adminLogin']) && !isset($_SESSION['adminLogin']['status'])) header('Location: ./');
?>
<?php include_once("../api/classes/Admin.php");?>
<div class="content">
    <div class="col-md-12">
        <h4 class="card-title text-center">Manually Create Booking</h4>
        <div class="row">
            <div class="col-md-10 mr-auto ml-auto">
                <div class="card ">
                    <div class="card-body">
                        <form name="create_booking" id="create_booking">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="travel_from">Traveling From</label>
                                        <select name="travel_from" id="travel_from" class="form-control">
                                            <option value="Abuja">Abuja</option>
                                            <option value="Lagos">Lagos</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="travel_to">Traveling To</label>
                                        <select name="travel_to" id="travel_to" class="form-control">
                                            <option value="Lagos">Lagos</option>
                                            <option value="Abuja">Abuja</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="travel_type">Traveling Type</label>
                                        <div class="form-group">
                                            <select name="travel_type" id="travel_type" class="form-control">
                                                <option value="OneWay">One Way</option>
                                                <option value="RoundTrip">Round Trip</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="departure_date">Departure Date</label>
                                        <div class="form-group">
                                            <input type="text" name="departure_date" id="departure_date" class="form-control calenderDate">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="return_date">Return Date</label>
                                        <div class="form-group">
                                            <input type="text" name="return_date" id="return_date" class="form-control calenderDate">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="no_of_passenger">No of passenger</label>
                                        <div class="form-group">
                                            <input readonly type="text" name="no_of_passenger" id="no_of_passenger" value="1" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="selected_seat" id="selected_seat" value="none" class="form-control">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <div class="form-group">
                                            <input type="text" name="email" id="email" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <div class="form-group">
                                            <input type="text" name="phone" id="phone" class="form-control" maxlength="11">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="next_of_kin_name">Next of Kin Name</label>
                                        <div class="form-group">
                                            <input type="text" name="next_of_kin_name" id="next_of_kin_name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="next_of_kin_phone">Next of Kin Phone</label>
                                        <div class="form-group">
                                            <input type="text" name="next_of_kin_phone" id="next_of_kin_phone" class="form-control" maxlength="11">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12"><h5 class="mt-3">Passenger Information & Payment</h5></div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="passenger_cat">Passenger Category</label>
                                        <div class="form-group">
                                            <select name="passenger_cat" id="passenger_cat" class="form-control">
                                                <option value="Adult">Adult</option>
                                                <option value="Force">Serving or retired military personnel</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="fullname">Fullname</label>
                                        <div class="form-group">
                                            <input type="text" name="fullname" id="fullname" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <div class="form-group">
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <div class="form-group">
                                            <input type="text" name="amount" id="amount" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label for="payment_option">Payment Option</label>
                                        <div class="form-group">
                                            <select name="payment_option" id="payment_option" class="form-control">
                                                <option value=""></option>
                                                <option value="transfer">Transfer</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group my-4">
                                        <button type="submit" class="btn btn-success btn-block" id="credit_btn">Create Booking</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once ('admininc/mfooter.php'); ?>
<script src="../js/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        $( ".calenderDate" ).datepicker({
        dateFormat:'yy-mm-dd',
        minDate: 0,
        beforeShowDay: function(d) {
            var day = d.getDay();
            return [(day !== 1 && day !== 2 && day !== 4  && day !== 6 )];
        }
    });
    });
    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
            });
        });
    }
</script>
<script>
    $("form[name='create_booking']").validate({
        rules: {
            travel_from: "required", travel_to: "required", travel_type: "required",
            departure_date: "required", no_of_passenger: "required", email: {required: true,email: true}, phone:"required",
            next_of_kin_name: "required", next_of_kin_phone: "required", passenger_cat: "required", fullname: "required",
            gender: "required",amount: "required",payment_option: "required"
        },
        messages: {
            travel_from: "Require", travel_to: "Require", travel_type: "Require", departure_date: "Require",
            no_of_passenger: "Require", email: "Please enter a valid email address", phone: "Require",
            nationality: "Require", next_of_kin_name: "Require", next_of_kin_phone: "Require", passenger_cat: "Require",
            fullname: "Require", gender: "Require", amount: "Require"
        },
        submitHandler: function(form, e) {
            e.preventDefault();
            var create_booking = $('#create_booking');
            var form_data = JSON.stringify(create_booking.serializeObject());
            // alert(form_data);
            $("#credit_btn").attr("disabled", true);
            $('#credit_btn').css("cursor", 'not-allowed');
            $(".loading-spin").addClass("d-inline-block");
            $.ajax({
                url: "create-manual-booking-api.php",
                type : "POST",
                contentType : 'application/json',
                data : form_data,
                success: function(data) {
                    $.notify({icon: "nc-icon nc-bell-55", message: data.message}, {type: 'success', timer: 8000,
                        placement: {from: 'top', align: 'right'}
                    });
                    setTimeout(function () {window.location.reload();}, 1000);
                },
                error: function(errData){  },
                complete: function () {
                    $('#credit_btn').attr("disabled", false);
                    $('#credit_btn').css("cursor", 'pointer');
                    $(".loading-spin").removeClass("d-inline-block");
                }
            });
        }
    });
</script>
<script>
    setInputFilter(document.getElementById("amount"), function(value) { return /^\d*$/.test(value); });
    setInputFilter(document.getElementById("no_of_passenger"), function(value) { return /^\d*$/.test(value); });
    setInputFilter(document.getElementById("phone"), function(value) { return /^\d*$/.test(value); });
    setInputFilter(document.getElementById("next_of_kin_phone"), function(value) { return /^\d*$/.test(value); });
    setInputFilter(document.getElementById("nationality"), function(value) { return /^[a-zA-Z\s]*$/.test(value); });
    setInputFilter(document.getElementById("next_of_kin_name"), function(value) { return /^[a-zA-Z\s]*$/.test(value); });
    setInputFilter(document.getElementById("fullname"), function(value) { return /^[a-zA-Z\s]*$/.test(value); });
</script>