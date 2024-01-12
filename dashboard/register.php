<?php
require_once('../classes/DBConnection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Form</title>
    <link rel="icon" href="../images/logos/JA1.PNG" />

    <link rel="stylesheet" href="../dist/customfiles/css/login.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/font-awesome-pro-5/css/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.css">

    <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

</head>

<style>
    /* Create two equal columns that floats next to each other */
    .column {
        float: left;
        width: 50%;
        padding: 5px;
        /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    .right {
        scale: 0.8;
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

<body style="background: #e9ecef;">
    <div class="split-screen">
        <div class="left">
            <section class="copy">
                <h1>Welcome,<span>Users</span></h1>
            </section>
        </div>
        <div class="right">
            <form id="register_new">
                <section class="copy">
                    <h2>Register Now</h2>
                    <div class="login-container">
                        <p>
                            Already have account?<a href="login.php"><strong>Login</strong></a>
                        </p>
                    </div>
                </section>
                <div class="row">
                    <div class="column">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" placeholder="First Name" required />
                    </div>
                    <div class="column">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" placeholder="Last Name" required />
                    </div>
                </div>

                <div class="input-container name">
                    <label for="uname">Address</label>
                    <input type="text" id="address" name="address" placeholder="Address" required />
                </div>

                <div class="input-container name">
                    <label for="uname">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Email Address" required />
                </div>

                <div class="input-container name">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required />
                    <span class="p-viewer2">
                        <i class="fa fa-eye" id="togglePassword" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="input-container name">
                    <label for="password">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmpassword" placeholder="Confirm Password" required />
                    <div id="bgmessage" class="text-center rounded-sm ">
                        <p id="message"></p>
                    </div>
                </div>


                <button class="signup-btn" id="btsubm" form="register_new">Register</button>
                <section class="copy legal">
                    <p>
                     
                    </p>
                </section>
            </form>
        </div>
    </div>


    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Toastr -->
    <script src="../plugins/toastr/toastr.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../dist/js/adminlte.js"></script>

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
        document.getElementById("btsubm").disabled = true;

        passwordInput.addEventListener("input", () => {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            if ((password || confirmPassword) === '') {
                message.textContent = "";
            } else if (password === confirmPassword) {
                message.textContent = "Passwords match!";
                bgmess.classList.remove("bg-danger");
                bgmess.classList.add("bg-success");
                document.getElementById("btsubm").disabled = false;
            } else if ((password && confirmPassword) === '') {
                message.textContent = "";
            } else {
                message.textContent = "Passwords do not match.";
                bgmess.classList.remove("bg-success");
                bgmess.classList.add("bg-danger");
                document.getElementById("btsubm").disabled = true;
            }
        });

        confirmPasswordInput.addEventListener("input", () => {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            if (password === confirmPassword) {
                message.textContent = "Passwords match!";
                bgmess.classList.remove("bg-danger");
                bgmess.classList.add("bg-success");
                //bgmess.className += "bg-info";
                document.getElementById("btsubm").disabled = false;
            } else {
                message.textContent = "Passwords do not match.";
                bgmess.classList.remove("bg-success");
                bgmess.classList.add("bg-danger");
                //bgmess.className += "bg-danger";
                document.getElementById("btsubm").disabled = true;
            }
        });
    </script>



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
            $('#register_new').submit(function(e) {
                e.preventDefault();
                var _this = $(this);
                $('.err-msg').remove();
                start_loader();
                $.ajax({
                    url: _base_url_ + "classes/Content.php?f=registration",
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
                            end_loader()
                            Swal.fire({
                                icon: 'error',
                                title: '',
                                text: resp.msg,
                                confirmButtonText: 'OK'
                            });
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