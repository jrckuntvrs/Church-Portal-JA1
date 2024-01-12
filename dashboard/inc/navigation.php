  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4" style="position: fixed;">
    <!-- Brand Logo -->


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="sidebar-light">
        <div class="d-flex justify-content-center">
          <img src="<?php echo base_url ?>dist/customfiles/images/ja1.png" style="width: 150px;" class="img-fluid" title="JA1" alt="JA1">
        </div>
        <div class="text-center text-light">
          <h4>Jesus the Anointed One Church</h4>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <?php if ($_settings->userdata('type') == 2) : ?>
              <div class="mt-2">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex"></div>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-item dropdown">
                    <a href="./" class="nav-link nav-home nav-ja1_overview nav-ja1_headpastor nav-ja1_values nav-ja1_declaration">
                      <i class="nav-icon fas fa-info-circle"></i>
                      <p>
                        About
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?php echo base_url ?>dashboard/?page=ja1_churchdonation" class="nav-link nav-ja1_churchdonation">
                      <i class="fas fa-hand-holding-heart nav-icon"></i>
                      <p>Church Giving</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url ?>dashboard/?page=ja1_reservation" class="nav-link nav-ja1_reservation nav-ja1_validation_payment">
                      <i class="fas fa-calendar-check nav-icon"></i>
                      <p>Booking Events</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url ?>dashboard/?page=ja1_transactionreports" class="nav-link nav-ja1_transactionreports">
                      <i class="fas fa-print nav-icon"></i>
                      <p>Booking Details</p>
                    </a>
                  </li>
                <?php endif ?>

                <?php if ($_settings->userdata('type') == 9929) : ?>
                  <li class="nav-item">
                    <a href="<?php echo base_url ?>dashboard/?page=users_account" class="nav-link nav-users_account">
                      <i class="nav-icon fas fa-user-tie"></i>
                      <p>
                        Users
                      </p>
                    </a>
                  </li>
                <?php endif ?>

                <?php if ($_settings->userdata('type') == 1) : ?>
                  <div class="mt-2">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex"></div>
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                      <li class="nav-item dropdown">
                        <a href="./" class="nav-link nav-home nav-ja1_admin_today_reservation nav-ja1_admin_pending_reservation">
                          <i class="nav-icon fas fa-grip-horizontal"></i>
                          <p>
                            Dashboard
                          </p>
                        </a>
                      </li>

                      <!--li class="nav-item">
                        <a href="<?php echo base_url ?>dashboard/?page=ja1_admin_churchcalendar" class="nav-link nav-ja1_admin_churchcalendar">
                          <i class="fas fa-calendar-alt nav-icon"></i>
                          <p>Church Calendar</p>
                        </a>
                      </li-->
                      <li class="nav-item">
                        <a href="<?php echo base_url ?>dashboard/?page=users_account" class="nav-link nav-users_account">
                          <i class="fas fa-user-shield nav-icon"></i>
                          <p>Admin Profile</p>
                        </a>
                      </li>
                      <li class="nav-item dropdown">
                        <a href="#" class="nav-link nav-reservation nav-ja1_admin_birthday">
                          <i class="nav-icon fas fa-calendar-day"></i>
                          <p>
                            Booking Events
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">

                          <li class="nav-item">
                            <a href="<?php echo base_url ?>dashboard/?page=ja1_admin_birthday" class="nav-link nav-ja1_admin_birthday">
                              <i class="fas fa-birthday-cake nav-icon"></i>
                              <p>Birthday Events</p>
                            </a>
                          </li>

                          <li class="nav-item">
                            <a href="<?php echo base_url ?>dashboard/?page=ja1_admin_wedding" class="nav-link nav-ja1_admin_wedding">
                              <i class="fas fa-rings-wedding nav-icon"></i>
                              <p>Wedding Events</p>
                            </a>
                          </li>

                          <li class="nav-item">
                            <a href="<?php echo base_url ?>dashboard/?page=ja1_admin_child_dedication" class="nav-link nav-ja1_admin_child_dedication">
                              <i class="fas fa-child nav-icon"></i>
                              <p>Child Dedication</p>
                            </a>
                          </li>

                          <li class="nav-item">
                            <a href="<?php echo base_url ?>dashboard/?page=ja1_admin_funeral_s" class="nav-link nav-ja1_admin_funeral_s">
                              <i class="fas fa-coffin-cross nav-icon"></i>
                              <p>Funeral Service</p>
                            </a>
                          </li>

                          <li class="nav-item">
                            <a href="<?php echo base_url ?>dashboard/?page=ja1_admin_blessing" class="nav-link nav-ja1_admin_blessing">
                              <i class="fas fa-candle-holder nav-icon"></i>
                              <p>Blessing Events</p>
                            </a>
                          </li>

                        </ul>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo base_url ?>dashboard/?page=ja1_admin_transactionreports" class="nav-link nav-ja1_admin_transactionreports">
                          <i class="fas fa-print nav-icon"></i>
                          <p>Booking Details</p>
                        </a>
                      </li>
                    <?php endif ?>

                    <?php if ($_settings->userdata('type') == 9929) : ?>
                      <li class="nav-item">
                        <a href="<?php echo base_url ?>dashboard/?page=users_account" class="nav-link nav-users_account">
                          <i class="nav-icon fas fa-user-tie"></i>
                          <p>
                            Users
                          </p>
                        </a>
                      </li>
                    <?php endif ?>



                    <!--li class="nav-item dropdown">
                  <a href="#" class="nav-link nav-remittance">
                    <i class="nav-icon fas fa-calculator"></i>
                    <p>
                      Remittance
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">

                  </ul>
                </li-->
                    </ul>
                  </div>
                </ul>
        </nav>
      </div>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <script>
    $(document).ready(function() {
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
      var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      page = page.split('/');
      page = page[0];
      if (s != '')
        page = page + '_' + s;

      if ($('.nav-link.nav-' + page).length > 0) {
        $('.nav-link.nav-' + page).addClass('active')
        $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active')
        if ($('.nav-link.nav-' + page).hasClass('tree-item') == true) {
          $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active')
          $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open')
        }
        if ($('.nav-link.nav-' + page).hasClass('nav-is-tree') == true) {
          $('.nav-link.nav-' + page).parent().addClass('menu-open')
        }
      }

      $('.dropdown').on("click", function() {
        $('.nav-link.nav-' + page).closest('.nav-treeview').parent().removeClass('menu-open')
      })

    })
  </script>

  <script>

  </script>