<?php
require_once('../classes/DBConnection.php');

$encryptionKey = 'your_secret_key';

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
    echo "Invalid data in the token";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JA1 Church Mega Sanctuary</title>
    <link rel="icon" href="../images/logos/JA1.PNG" />

    <link rel="stylesheet" href="../dist/customfiles/css/login.css" />

    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/font-awesome-pro-5/css/all.min.css">

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

    .p-viewer,
    .p-viewer2 {
        float: right;
        margin-top: -55px;
        margin-right: 10px;
        position: relative;
        z-index: 1;
        cursor: pointer;
    }
</style>

<body class="container-fluid bg-body-tertiary d-block">

    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
            <div class="card bg-white mb-5 mt-5 border-0" style="box-shadow: 0 12px 15px rgba(0, 0, 0, 0.02);">
                <div class="card-body p-5 text-center">
                    <form id="reset_pass">
                        <h4>Reset Password</h4>
                        <input type="hidden" name="email" value="<?php echo $decrypted; ?>" />
                        <input type="hidden" name="otp" value="<?php echo $decrypted22; ?>" />
                        
                        <p><?php echo $decrypted; ?></p>
                        <br>
                        <div class="input-container name">
                            <label for="password">New Password</label>
                            <input type="password" id="password" name="password" placeholder="Password" required />
                            <span class="p-viewer2">
                                <i class="fa fa-eye" id="togglePassword" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="input-container name">
                            <label for="password">Confirm New Password</label>
                            <input type="password" id="confirmPassword" name="confirmpassword" placeholder="Confirm Password" required />
                            <span class="p-viewer">
                                <i class="fa fa-eye" id="togglePassword2" aria-hidden="true"></i>
                            </span>
                            <div id="bgmessage" class="text-center rounded-sm ">
                                <p id="message"></p>
                            </div>
                        </div>

                        <button class="btn btn-primary mb-3" id="btsub" form="reset_pass">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const togglePassword2 = document.querySelector('#togglePassword2');
        const password = document.querySelector('#password');
        const password2 = document.querySelector('#confirmPassword');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });

        togglePassword2.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password2.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>

    <script>
        const passwordInput = document.getElementById("password");
        const confirmPasswordInput = document.getElementById("confirmPassword");
        const message = document.getElementById("message");
        var bgmess = document.getElementById("bgmessage");
        document.getElementById("btsub").disabled = true;

        passwordInput.addEventListener("input", () => {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            if ((password || confirmPassword) === '') {
                message.textContent = "";
            } else if (password === confirmPassword) {
                message.textContent = "Passwords match!";
                bgmess.classList.remove("bg-danger");
                bgmess.classList.add("bg-success");
                document.getElementById("btsub").disabled = false;
            } else if ((password && confirmPassword) === '') {
                message.textContent = "";
            } else {
                message.textContent = "Passwords do not match.";
                bgmess.classList.remove("bg-success");
                bgmess.classList.add("bg-danger");
                document.getElementById("btsub").disabled = true;
            }
        });

        confirmPasswordInput.addEventListener("input", () => {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            if (password === confirmPassword) {
                message.textContent = "Passwords match!";
                bgmess.classList.remove("bg-danger");
                bgmess.classList.add("bg-success");
                document.getElementById("btsub").disabled = false;
                //bgmess.className += "bg-info";
            } else {
                message.textContent = "Passwords do not match.";
                bgmess.classList.remove("bg-success");
                bgmess.classList.add("bg-danger");
                //bgmess.className += "bg-danger";
                document.getElementById("btsub").disabled = true;
            }
        });
    </script>

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Toastr -->
    <script src="../plugins/toastr/toastr.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>

    <script>
        function start_loader() {
            $('body').append('<div id="preloader"><div class="loader-holder"><div></div><div></div><div></div><div></div>')
        }

        function end_loader() {
            $('#preloader').fadeOut('fast', function() {
                $('#preloader').remove();
            })
        }
        // function 
        window.alert_toast = function($msg = 'TEST', $bg = 'success', $pos = '') {
            var Toast = Swal.mixin({
                toast: true,
                position: $pos || 'top-end',
                showConfirmButton: false,
                timer: 5000
            });
            Toast.fire({
                icon: $bg,
                title: $msg
            })
        }
    </script>

    <script>
        var _base_url_ = '<?php echo base_url ?>';
    </script>

    <script>
        $(document).ready(function() {
            $('#reset_pass').submit(function(e) {
                e.preventDefault();
                var _this = $(this);
                $('.err-msg').remove();
                start_loader();
                $.ajax({
                    url: _base_url_ + "classes/Content.php?f=reset_pass",
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