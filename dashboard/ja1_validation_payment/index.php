<?php
require_once('../config.php');

$key_array = array_keys($_GET);
$TransactNo = @$_GET[$key_array[1]];
$Eventtype = @$_GET[$key_array[2]];

if ($Eventtype == "Blessing Event") {
    $sql = "UPDATE tbl_blessing_event set `Status` = '1' WHERE `Transaction_No` = '$TransactNo'";
    $conn->query($sql);
} else if ($Eventtype == "Birthday Event") {
    $sql = "UPDATE tbl_birthday_event set `Status` = '1' WHERE `Transaction_No` = '$TransactNo'";
    $conn->query($sql);
} else if ($Eventtype == "Child Dedication Event") {
    $sql = "UPDATE tbl_child_dedication_events set `Status` = '1' WHERE `Transaction_No` = '$TransactNo'";
    $conn->query($sql);
} else if ($Eventtype == "Funeral Service") {
    $sql = "UPDATE tbl_funeral_service set `Status` = '1' WHERE `Transaction_No` = '$TransactNo'";
    $conn->query($sql);
}


/*$drctlink = base_url."/JA1/dashboard/?page=ja1_reservation";

header("Location: $drctlink");*/

?>


<head>
    <style>
        /* CSS loading spinner animation */
        .loader {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            border: 3px solid;
            border-color: #4c3c3c #4c3c3c transparent transparent;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
        }

        .loader::after,
        .loader::before {
            content: '';
            box-sizing: border-box;
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            margin: auto;
            border: 3px solid;
            border-color: transparent transparent #e83e8c #e83e8c;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-sizing: border-box;
            animation: rotationBack 0.5s linear infinite;
            transform-origin: center center;
        }

        .loader::before {
            width: 32px;
            height: 32px;
            border-color: #4c3c3c #4c3c3c transparent transparent;
            animation: rotation 1.5s linear infinite;
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes rotationBack {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(-360deg);
            }
        }
    </style>
</head>

<div class="container h-100 d-flex justify-content-center align-items-center">
    <div class="row  mx-auto text-center">
        <div class="col">
            <span class="loader"></span>

            <br>
            <b>PAYMENT SUCCESSFULLY!</b>
            <br>
            <div class="countdown-text">You will be redirected in <span id="countdown">5</span> seconds</div>

        </div>

    </div>
</div>


<script>
    var _base_url_ = '<?php echo base_url ?>';
</script>

<script>
    /*$(document).ready(function() {
        window.location.replace('http://localhost/JA1/dashboard/?page=ja1_reservation');
    })*/

    /*setTimeout(function() {
        window.location.replace('http://localhost/JA1/dashboard/?page=ja1_reservation'); // Replace with your desired URL
    }, 5000);*/

    let countdown = 5; // Set the initial countdown time

    function updateCountdown() {
        document.getElementById("countdown").textContent = countdown;
        countdown--;

        if (countdown < 0) {
            window.location.replace(_base_url_ + 'dashboard/?page=ja1_transactionreports'); // Replace with your desired URL
        } else {
            setTimeout(updateCountdown, 1000); // Update the countdown every 1 second (1000 milliseconds)
        }
    }

    updateCountdown(); // Start the countdown
</script>