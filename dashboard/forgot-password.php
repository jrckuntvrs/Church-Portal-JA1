<?php
require_once('../classes/DBConnection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JA1 Church Mega Sanctuary</title>
    <link rel="icon" href="../images/logos/JA1.PNG" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <link rel="stylesheet" href="../dist/customfiles/css/login.css" />

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

<body style="background: #e9ecef;">
    
    <div class="split-screen">
        <div class="left">
            <section class="copy">
                <h1>Welcome,<span>Users</span></h1>
            </section>
        </div>
        <div class="right">
            <form id="frgtpss">
                <section class="copy">
                    <h2>Forgot Password</h2>
                    <div class="login-container">
                        <p>
                            Back To?<a href="login.php"><strong>Login</strong></a>
                        </p>
                    </div>
                </section>
                <div class="input-container name">
                    <label for="uname">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Email Address" required />
                </div>
                <button class="signup-btn" form="frgtpss">Send Reset Link</button>
                <section class="copy legal">
                    <p>
                      
                    </p>
                </section>
            </form>
        </div>
    </div>

    <script>
        var _base_url_ = '<?php echo base_url ?>';
    </script>

    <script>
        $(document).ready(function() {
            $('#frgtpss').submit(function(e) {
                e.preventDefault();
                var _this = $(this);
                $('.err-msg').remove();
                start_loader();
                $.ajax({
                    url: _base_url_ + "classes/Content.php?f=forgot_pass",
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