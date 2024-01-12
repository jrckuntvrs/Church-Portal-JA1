<style>
  .titlebold {
    font-weight: bold;
    font-size: 1.2rem;
    color: black !important;
    margin-top: -0.3rem;
  }

  .gold {
    color: #c5aa6a;
  }
</style>

<?php
if ($_settings->userdata('type') == 1) {
  $accounttype = 'Administrator';
} else {
  $accounttype = 'Staff';
}

?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-brown navbar-light text-sm">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color:white; margin-top: 5px;"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <h4 style="color: white;margin-top: 5px;"><b>JA1 Church <span class="gold">Mega Sanctuary</span></b></h4>
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-menu">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <img src="<?php echo validate_image($_settings->userdata('avatar')) ?>" class="img-circle elevation-4 " style="width:45px; height: 45px; margin-top:-13px; object-fit:scale-down;object-position:center center;" title="<?php echo ucwords($_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname')); ?>">
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="border-radius: 5px;">
          <li class="user-header">
            <br>
            <img style="object-fit:scale-down;object-position:center center;" src="<?php echo validate_image($_settings->userdata('avatar')) ?>" class="img-circle elevation-2" style="width:10px; height: 10px;" alt="User Image">
            <p><b>Hello, <?php echo ucwords($_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname')); ?>!</b></p>
            <p style="margin-top: -5px; font-size: 12px;"><?php echo ucwords($_settings->userdata('username')); ?></p>
          </li>
          <li class="user-footer" style="border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
            <a href="<?php echo base_url ?>dashboard/?page=user" class="btn btn-primary"><i class="fas fa-user mr-2"></i>Profile</a>
            <a href="javascript:void(0)" class="btn btn-primary float-right" onclick="location.replace('<?php echo base_url . '/classes/Login.php?f=logout' ?>')" role="button"><i class="fas fa-sign-out-alt mr-2"></i> Log-out</a>
          </li>
        </ul>
      </li>
    </ul>

  </ul>
</nav>
<!-- /.navbar -->