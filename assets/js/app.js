$(document).ready(function () {
    const w = $(".passenger-accordion-btn").parent().parent().siblings();
    $(".passenger-accordion-btn").click(function () {
        if (!w.hasClass("show")) {
            $(this).removeClass("passenger-accordion-plus-btn").addClass("passenger-accordion-minus-btn")
        }
        else {
            $(this).removeClass("passenger-accordion-minus-btn").addClass("passenger-accordion-plus-btn")
        }
    });

    var loc = window.location.pathname;

    $('#navbarSupportedContent').find('a').each(function () {
        $(this).toggleClass('active', $(this).attr('href') == loc);
    });

    var path = loc.split("/").pop();
    if (path === "") {
        path = 'index.php';
    }
    var target = $('nav-item a[href="' + path + '"]');
    target.addClass('active');
});


// back function
function goBack() {
    window.history.back();
}

// switching between daily and hourly vehicle hire to view and hide corresponding form-control
var dailyRadio = document.getElementById("daily_rate");
var hourlyRadio = document.getElementById("hourly_rate");
var switchTwo = document.getElementById("switchTwo");

var b_dailyRadio = document.getElementById("b_daily_rate");
var b_hourlyRadio = document.getElementById("b_hourly_rate");
var b_switchTwo = document.getElementById("b_switchTwo");

function performSwitch() {
    if (hourlyRadio.checked) {
        if (switchOne.classList.contains("d-none")) {
            switchOne.classList.remove("d-none")
        }
        if (!switchTwo.classList.contains("d-none")) {
            switchTwo.classList.add("d-none")
        }
    }
    if (dailyRadio.checked) {
        if (switchTwo.classList.contains("d-none")) {
            switchTwo.classList.remove("d-none")
        }
        if (!switchOne.classList.contains("d-none")) {
            switchOne.classList.add("d-none")
        }
    }
}

function b_performSwitch() {
    if (b_hourlyRadio.checked) {
        if (b_switchOne.classList.contains("d-none")) {
            b_switchOne.classList.remove("d-none")
        }
        if (!b_switchTwo.classList.contains("d-none")) {
            b_switchTwo.classList.add("d-none")
        }
    }
    if (b_dailyRadio.checked) {
        if (b_switchTwo.classList.contains("d-none")) {
            b_switchTwo.classList.remove("d-none")
        }
        if (!b_switchOne.classList.contains("d-none")) {
            b_switchOne.classList.add("d-none")
        }
    }
}