<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>

<head>
  <link rel="stylesheet" href="<?php echo base_url ?>/dist/customfiles/css/login.css" />
</head>

<style>
  .p-viewer {
    float: right;
    margin-top: -55px;
    margin-right: 10px;
    position: relative;
    z-index: 1;
    cursor: pointer;
  }
</style>

<body class="hold-transition login-page">


  <div class="split-screen">
    <div class="left">
      <section class="copy">
        <h1>Welcome,<span>Users</span></h1>
      </section>
    </div>
    <div class="right">
      <form id="login-frm" action="" method="post">
        <section class="copy">
          <h2>Login Now</h2>
          <div class="login-container">
            <p>
              Don't have an account?<a href="register.php"><strong>Register</strong></a>
            </p>
          </div>
        </section>
        <div class="input-container name">
          <label for="uname">Email Address</label>
          <input type="email" id="email" name="username" placeholder="Email Address" required />
        </div>

        <div class="input-container name">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Password" required />
          <span class="p-viewer">
            <i class="fa fa-eye" id="togglePassword" aria-hidden="true"></i>
          </span>
        </div>
        <div class="input-container cta">
          <a href="forgot-password.php">Forgot Password?</a>
        </div>
        <button class="signup-btn" type="submit">Login</button>
        <section class="copy legal">
          <p>
            
          </p>
        </section>
      </form>
    </div>
  </div>


  <!-- jQuery -->
  <script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url ?>dist/js/adminlte.min.js"></script>

  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function(e) {
      // toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
    });
  </script>

</body>

</html>