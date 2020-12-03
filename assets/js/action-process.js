$(function() {
    $("form[name='registration_form']").validate({
        rules: {
            firstname: "required",
            lastname: "required",
            email: {required: true, email: true},
            phone: {required: true, digits: true},
            gender: "required",
            password: {required: true, minlength: 6},
            repeat_pwd : {required: true,equalTo : '[name="password"]'}
        },
        messages: {
            firstname: "Enter your firstname",
            lastname: "Enter your lastname",
            email: "Enter a valid email",
            phone: "Enter a valid number",
            gender: "Gender is required",
            password: {required: "Enter a password", minlength: "Password must be at least six(6) characters"},
            repeat_pwd: {required: "Required",equalTo:"Password not matched"}
        },
        submitHandler: function(form, e) {
            e.preventDefault();
            var registration_form = $('#registration_form');
            $("#registerBtn").attr("disabled", true);$('#registerBtn').css("cursor", 'not-allowed');$(".fa-pulse").addClass("d-inline-block");
            $.ajax({
                url: "controllers/create-customer.inc.php",type:"POST",data:registration_form.serialize(),
                success: function(data) {
                    sendSuccessResponse(data.message);
                    toastr.success("Registration successful, kindly check your email for activation");
                    document.getElementById("registration_form").reset();
                },
                error: function(errData){
                    sendErrorResponse(errData.responseJSON.message);
                },
                complete: function () {
                    $('#registerBtn').attr("disabled",false);$('#registerBtn').css("cursor",'pointer');$(".fa-pulse").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='login_form']").validate({
        rules: {email: "required", password: "required",},
        messages: {email: "Enter a valid email address", password: "Enter your password",},
        submitHandler: function(form, e) {
            e.preventDefault();
            var login_form = $('#login_form');
            $("#loginBtn").attr("disabled", true);$('#loginBtn').css("cursor", 'not-allowed');$(".fa-pulse").addClass("d-inline-block");
            $.ajax({
                url: "controllers/login-customer.inc.php",type:"POST",data:login_form.serialize(),
                success: function(data) {
                    document.getElementById("login_form").reset();
                    if (data.location === 'booking-payment') window.location.replace(data.location);
                    else window.location.replace(data.location);
                },
                error: function(errData){
                    sendErrorResponse(errData.responseJSON.message);
                },
                complete: function () {
                    $('#loginBtn').attr("disabled", false);$('#loginBtn').css("cursor", 'pointer');$(".fa-pulse").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='forgot_form']").validate({
        rules: {email: "required"},
        messages: {email: "Enter a valid email address"},
        submitHandler: function(form, e) {
            e.preventDefault();
            var forgot_form = $('#forgot_form');
            $("#forgotBtn").attr("disabled", true);$('#forgotBtn').css("cursor", 'not-allowed');$(".fa-pulse").addClass("d-inline-block");
            $.ajax({
                url: "controllers/forgot-password.inc.php",type:"POST",data:forgot_form.serialize(),
                success: function(data) {
                    sendSuccessResponse(data.message);
                    toastr['success']('Reset password link as been sent to your email');
                    document.getElementById("forgot_form").reset();
                },
                error: function(errData){
                    sendErrorResponse(errData.responseJSON.message);
                },
                complete: function () {
                    $('#forgotBtn').attr("disabled", false);$('#forgotBtn').css("cursor", 'pointer');$(".fa-pulse").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='recover_form']").validate({
        rules: {
            res_password: {required: true, minlength: 6},
            res_repeat_pwd: {equalTo: '[name="res_password"]'}
        },
        messages: {
            res_password: {required: "Enter a password",minlength: "Password must be at least six(6) characters long"},
            res_repeat_pwd: {equalTo: "Enter Confirm password same as password"}
        },
        submitHandler: function(form, e) {
            e.preventDefault();
            var recover_form = $('#recover_form');
            $("#recoverBtn").attr("disabled", true);$('#recoverBtn').css("cursor", 'not-allowed');$(".fa-pulse").addClass("d-inline-block");
            $.ajax({
                url: "controllers/reset-password.inc.php",type:"POST",data:recover_form.serialize(),
                success: function(data) {
                    sendSuccessResponse(data.message);
                    toastr.success('Password successfully changed, redirecting to login');
                    setTimeout( ()=> { window.location.replace("login"); }, 4000);
                    document.getElementById("recover_form").reset();
                },
                error: function(errData){
                    sendErrorResponse(errData.responseJSON.message);
                },
                complete: function () {
                    $('#recoverBtn').attr("disabled", false);$('#recoverBtn').css("cursor", 'pointer');$(".fa-pulse").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='van_hire_form']").validate({
        rules: {
            pickup_area: "required", pickup_state:"required",
            dropoff_area:"required", dropoff_state:"required",
            pickup_date: "required", pickup_time:"required",
            no_of_hours: "required"
        },
        messages: {

        },
        submitHandler: function(form, e) {
            e.preventDefault();
            var van_hire_form = $('#van_hire_form');
            $("#bookingBtn").attr("disabled", true);$('#bookingBtn').css("cursor", 'not-allowed');$(".fa-pulse").addClass("d-inline-block");
            $.ajax({
                url: "controllers/hold-booking.php",type:"POST",data:van_hire_form.serialize(),
                success: function(data) { window.location.replace("booking-details");
                },
                error: function(errData){toastr['error'](errData.responseJSON.message);},
                complete: function () {
                    $('#bookingBtn').attr("disabled", false);$('#bookingBtn').css("cursor", 'pointer');$(".fa-pulse").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='bus_hire_form']").validate({
        rules: {
            pickup_area: "required", pickup_state:"required",
            dropoff_area:"required", dropoff_state:"required",
            pickup_date: "required", pickup_time:"required",
            no_of_hours: "required"
        },
        messages: {

        },
        submitHandler: function(form, e) {
            e.preventDefault();
            var bus_hire_form = $('#bus_hire_form');
            $("#bookingBusBtn").attr("disabled", true);$('#bookingBusBtn').css("cursor", 'not-allowed');$(".fa-pulse").addClass("d-inline-block");
            $.ajax({
                url: "controllers/hold-booking.php",type:"POST",data:bus_hire_form.serialize(),
                success: function(data) { window.location.replace("booking-details"); },
                error: function(errData){toastr['error'](errData.responseJSON.message);},
                complete: function () {
                    $('#bookingBusBtn').attr("disabled", false);$('#bookingBusBtn').css("cursor", 'pointer');$(".fa-pulse").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='car_hire_form']").validate({
        rules: {
            pickup_area: "required", pickup_state:"required",
            dropoff_area:"required", dropoff_state:"required",
            pickup_date: "required", pickup_time:"required",
            no_of_hours: "required"
        },
        messages: {

        },
        submitHandler: function(form, e) {
            e.preventDefault();
            var car_hire_form = $('#car_hire_form');
            $("#bookingCarBtn").attr("disabled", true);$('#bookingCarBtn').css("cursor", 'not-allowed');$(".fa-pulse").addClass("d-inline-block");
            $.ajax({
                url: "controllers/hold-booking.php",type:"POST",data:car_hire_form.serialize(),
                success: function(data) { window.location.replace("booking-details"); },
                error: function(errData){toastr['error'](errData.responseJSON.message);},
                complete: function () {
                    $('#bookingCarBtn').attr("disabled", false);$('#bookingCarBtn').css("cursor", 'pointer');$(".fa-pulse").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='booking_details_form']").validate({
        ignores:[],
        rules: {
            firstname:"required",
            lastname:"required",
            gender: "required",
            email:{required: true, email: true},
            phone:{required: true, digits: true},
            agreeTerms:"required",
            payment_option:"required",
            pac_desc: {required: () => {return $('#service_type').val() === 'van hire' } },
        },
        messages: {
            firstname: "Firstname is required",
            lastname: "Lastname is required",
            gender: "Gender is required",
            email: "Invalid email address",
            phone: "Invalid Mobile number",
            agreeTerms: "Terms and condition required",
            payment_option: "Payment option required",
            pac_desc: "Enter package description",
        },
        submitHandler: function(form, e) {
            e.preventDefault();
            if ($.trim($("#user_id").val()) === ''){
                Swal.fire({
                    icon:"warning",
                    title: 'Authentication Warning',
                    html: "By clicking proceed, we will create an account with the details provided with default password of 12345678. <br />Check your mail to complete signup process",
                    showCancelButton: true,
                    confirmButtonColor: '#a8b622',
                    cancelButtonColor: '#c4c4c4',
                    confirmButtonText: 'Proceed with booking',
                    footer: "I have an account ? <a href='login?auth=false'> login instead</a>"
                }).then((result) => {
                    if (result.value) {
                        var payment_option = $('input[name=payment_option]:checked', '#booking_details_form').val();
                        if(payment_option === 'bankTransfer'){
                            $.post("controllers/hold-booking-step-2.php",$("#booking_details_form").serialize(), function( data ) {});
                            $('#payWithTransfer').modal({keyboard: false});
                        } else {
                            toastr['error']("Payment option not available, try mobile transfer.");
                        }
                    }
                })
            } else {
                var payment_option = $('input[name=payment_option]:checked', '#booking_details_form').val();
                if(payment_option === 'bankTransfer'){
                    $.post("controllers/hold-booking-step-2.php",$("#booking_details_form").serialize(), function( data ) {});
                    $('#payWithTransfer').modal({keyboard: false});
                } else {
                    toastr['error']("Payment option not available, try mobile transfer.");
                }
            }
        }
    });

    $("form[name='contact_us_form']").validate({
        rules: {fullname: "required",email: {required: true,email: true},subject:"required",message:{required:true,minlength:10}},
        messages: {
            fullname: "Enter your name",
            email: "Enter a valid email address",
            subject: "Enter message subject",
            message: "Message must be at least 10 characters"
        },
        submitHandler: function(form, e) {
            e.preventDefault();
            var contactBtn = $('#contactBtn');
            contactBtn.attr("disabled", true);contactBtn.css("cursor", 'not-allowed');$(".fa-pulse").addClass("d-inline-block");
            $.ajax({
                url: "controllers/create-contact-us.php",type:"POST",data:$('#contact_us_form').serialize(),
                success: function(data) {
                    sendSuccessResponse(data.message);
                    toastr.success(data.message);
                    document.getElementById("contact_us_form").reset();
                },
                error: function(err){
                    sendErrorResponse(err.responseJSON.message);
                },
                complete: function () {
                    contactBtn.attr("disabled", false);contactBtn.css("cursor", 'pointer');$(".fa-pulse").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='pay_with_transfer']").validate({
        rules: {account_name:"required",},
        messages: {account_name: "Enter sender account name"},
        submitHandler: function(form, e) {
            e.preventDefault();
            $("#transferBtn").attr("disabled", true);$('#transferBtn').css("cursor", 'not-allowed');$(".fa-pulse").addClass("d-inline-block");
            var booking_num = $("#booking_num").val();
            var name = $("#account_name").val();
            var amount_trans = $("#amount_transferred").val();
            if (name==='' || amount_trans==='' || booking_num===''){
                return false;
            } else {
                $.ajax({
                    url: "controllers/create-booking-via-transfer.php",type:"POST", data: $("#pay_with_transfer").serialize(),
                    success: function (data) {
                        toastr['success']('Thank you for making a reservation. '+ data.message);
                        setTimeout(()=>{ window.location.replace('_success'); }, 1500);
                    },
                    error: function (err) {
                        toastr['error'](err.responseJSON.message);
                        $('#payWithTransfer').modal('hide');
                    },
                    complete: function () {
                        $('#transferBtn').attr("disabled", false);$('#transferBtn').css("cursor", 'pointer');$(".fa-pulse").removeClass("d-inline-block");
                    }
                });
            }
        }
    });
});

function sendSuccessResponse(resp) {
    $("#response-alert").html('<section class="alert mb-0 mt-2"><div class="row">' +
        '<div class="col text-center">' +
        '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">'+ resp +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
        '     <span aria-hidden="true">&times;</span>\n' +
        ' </button></div></div></div></section>');
}

function sendErrorResponse(resp) {
    $("#response-alert").html('<section class="alert mb-0 mt-2"><div class="row">' +
        '<div class="col">' +
        '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">' + resp +
        ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
        '     <span aria-hidden="true">&times;</span>\n' +
        ' </button></div></div></div></section>');
    toastr.error(resp);
}
