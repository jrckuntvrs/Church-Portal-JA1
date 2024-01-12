<?php
require_once('../classes/DBConnection.php');

$secretKey = 'your_secret_key';

/*$etkn = urldecode($_GET['etoken']);
$tptkn2 = urldecode($_GET['tptoken']);
$encodedIV = urldecode(@$_GET['iv']);

$encodedData = base64_decode($etkn);
$encodedData22 = base64_decode($tptkn2);
$encodedIV = base64_decode($encodedIV);

$decrypted = openssl_decrypt($encodedData, 'aes-256-cbc', $encryptionKey, 0, $encodedIV);
$decrypted22 = openssl_decrypt($encodedData22, 'aes-256-cbc', $encryptionKey, 0, $encodedIV);*/

$encodedToken = urldecode($_GET['etoken']);

// Decode the base64-encoded token
$tokenData = base64_decode($encodedToken);

// Extract the IV (first 16 bytes) and the encrypted data
$iv = substr($tokenData, 0, 16);
$encryptedData = substr($tokenData, 16);

// Decrypt the data using the extracted IV
$jsonData = openssl_decrypt($encryptedData, 'AES-256-CBC', $secretKey, 0, $iv);

$data1 = json_decode($jsonData, true);

if ($data1) {
    // Verify the data (e.g., check user ID)
    $decrypted = $data1["user_email"];
    $decrypted22 = $data1["otp_no"];

    // You can implement your own verification logic here

} else {
    echo "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JA1 Church Mega Sanctuary</title>
    <link rel="icon" href="../images/logos/JA1.PNG" />

    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.css">

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="../plugins/toastr/toastr.min.js"></script>

    <script src="../dist/js/script.js"></script>

    <script src="../plugins/pace-progress/pace.min.js"></script>
</head>

<style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0), rgba(56, 1, 66, 0.5)),
            url('../dist/customfiles/images/JA1HOME.jpeg');
        background-size: cover;
        background-position: center;
    }

    .otp-field {
        flex-direction: row;
        column-gap: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .otp-field input {
        height: 45px;
        width: 42px;
        border-radius: 6px;
        outline: none;
        font-size: 1.125rem;
        text-align: center;
        border: 1px solid #ddd;
    }

    .otp-field input:focus {
        box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
    }

    .otp-field input::-webkit-inner-spin-button,
    .otp-field input::-webkit-outer-spin-button {
        display: none;
    }

    .resend {
        font-size: 12px;
    }

    .footer {
        position: absolute;
        bottom: 10px;
        right: 10px;
        color: black;
        font-size: 12px;
        text-align: right;
        font-family: monospace;
    }

    .footer a {
        color: black;
        text-decoration: none;
    }
</style>

<body class="container-fluid bg-body-tertiary d-block">

    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
            <div class="card bg-white mb-5 mt-5 border-0" style="box-shadow: 0 12px 15px rgba(0, 0, 0, 0.02);">
                <div class="card-body p-5 text-center">
                    <form id="register_confirmation">
                        <h4>Verify</h4>
                        <p>Your code was sent to you via email</p> <!-- at <?php //echo $decrypted; ?> -->
                        <input type="hidden" name="email" value="<?php echo $decrypted; ?>" />
                        <input type="hidden" name="otp" value="<?php echo $decrypted22; ?>" />
                        <div class="otp-field mb-4">
                            <input type="number" name="first" />
                            <input type="number" name="second" disabled />
                            <input type="number" name="third" disabled />
                            <input type="number" name="fourth" disabled />
                            <input type="number" name="fifth" disabled />
                            <input type="number" name="sixth" disabled />
                        </div>

                        <button class="btn btn-primary mb-3" form="register_confirmation">
                            Verify
                        </button>
                    </form>

                    <p class="resend text-muted mb-0">
                        Didn't receive code? Check on your spam inbox.<!--a href="">Request again</a-->
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const inputs = document.querySelectorAll(".otp-field > input");
        const button = document.querySelector(".btn");

        window.addEventListener("load", () => inputs[0].focus());
        button.setAttribute("disabled", "disabled");

        inputs[0].addEventListener("paste", function(event) {
            event.preventDefault();

            const pastedValue = (event.clipboardData || window.clipboardData).getData(
                "text"
            );
            const otpLength = inputs.length;

            for (let i = 0; i < otpLength; i++) {
                if (i < pastedValue.length) {
                    inputs[i].value = pastedValue[i];
                    inputs[i].removeAttribute("disabled");
                    inputs[i].focus;
                } else {
                    inputs[i].value = ""; // Clear any remaining inputs
                    inputs[i].focus;
                }
            }
        });

        inputs.forEach((input, index1) => {
            input.addEventListener("keyup", (e) => {
                const currentInput = input;
                const nextInput = input.nextElementSibling;
                const prevInput = input.previousElementSibling;

                if (currentInput.value.length > 1) {
                    currentInput.value = "";
                    return;
                }

                if (
                    nextInput &&
                    nextInput.hasAttribute("disabled") &&
                    currentInput.value !== ""
                ) {
                    nextInput.removeAttribute("disabled");
                    nextInput.focus();
                }

                if (e.key === "Backspace") {
                    inputs.forEach((input, index2) => {
                        if (index1 <= index2 && prevInput) {
                            input.setAttribute("disabled", true);
                            input.value = "";
                            prevInput.focus();
                        }
                    });
                }

                button.classList.remove("active");
                button.setAttribute("disabled", "disabled");

                const inputsNo = inputs.length;
                if (!inputs[inputsNo - 1].disabled && inputs[inputsNo - 1].value !== "") {
                    button.classList.add("active");
                    button.removeAttribute("disabled");

                    return;
                }
            });
        });
    </script>


    <script>
        var _base_url_ = '<?php echo base_url ?>';
    </script>

    <script>
        $(document).ready(function() {
            $('#register_confirmation').submit(function(e) {
                e.preventDefault();
                var _this = $(this);
                $('.err-msg').remove();
                start_loader();
                $.ajax({
                    url: _base_url_ + "classes/Content.php?f=register_confirmation",
                    data: new FormData($(this)[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: "POST",
                    type: "POST",
                    dataType: "json",
                    error: err => {
                        alert_toast("An error occured", 'error')
                        console.log(err);
                        end_loader();
                    },
                    success: function(resp) {
                        if (typeof resp == 'object' && resp.status == 'success') {
                            end_loader();
                            location.href = resp.link;
                        } else if (resp.status == 'failed' && !!resp.msg) {
                            var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            el.append(' <a href="' + resp.link + '" >Click Here</a>');
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({
                                scrollTop: _this.closest('.card').offset().top
                            }, "fast");
                            end_loader()
                        } else {
                            alert_toast("An error occured", 'error')
                            console.log(resp.emailsenterr);
                            console.log(resp);
                            end_loader();
                        }
                    }
                })
            })
        })
    </script>
</body>

</html>