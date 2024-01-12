<head>
  <link rel="stylesheet" href="<?php echo base_url ?>dist/customfiles/css/donation.css" />
</head>

<style>
  footer {
    display: none;
  }

  .layout-footer-fixed .wrapper .content-wrapper {
    padding-bottom: 0;
  }
</style>


<div class="background">
  <img src="<?php echo base_url ?>dist/customfiles/images/JA1HOME.jpeg" alt="" />
</div>

<div class="contact-bg">
  <h2>Church Giving</h2>
  <div class="line">
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>
<div class="donation" id="donation">
  <div class="img_donation">
    <div class="img_container"></div>
  </div>
  <div class="donation_content">
    <hr>
    <h1>Ways to Give?</h1>
    <p>
    "Honor the Lord with your wealth, with the first fruits of all your crops; then your barns will overflow, and your vats will brim over with new wine.” 
    Proverbs 3:9-10 (NIV) 
    <br>
    <br>
    "Give, and it will be given to you. A good measure, pressed down, shaken together, and running over, will be poured into your lap. For with the measure you use, it will be measured to you." Luke 6:38 (NIV)    
    </p>
    <p>
    God's grace is abundant, and your giving reflects your trust in His plan. Join us in supporting the church and touching lives in His name.
    <br>
    <br>
    By giving, you become an essential part of our spiritual journey. Help us nurture our faith and share His blessings with those in need.
    </p>
    <button id="donateButton">GIVE</button>
    <br />
    <br />
    <hr>
  </div>
</div>

<div id="modal" class="modal">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <span class="close" id="closeModal">&times;</span>

      <div class="donation-box">
        <h1>Make a Donation</h1>
        <form id="donationForm">
          <label for="amount">Donation Amount:</label>
          <input type="number" id="amount" name="amount" required />

          <!--label for="paymentMethod">Payment Method:</label>
          <select id="paymentMethod" name="paymentMethod" required>
            <option value="gcash" selected>GCash</option>
            <option value="metrobank">Metrobank</option>
            <option value="bdo">BDO</option>
          </select-->

          <!-- GCash Details -->
          <!--div id="gcashDetails">
            <label for="gcashNumber">GCash Number:</label>
            <input type="text" id="gcashNumber" name="gcashNumber" />
          </div-->

          <!-- Metrobank Details -->
          <!--div id="metrobankDetails">
            <label for="metrobankAccount">Metrobank Account Number:</label>
            <input type="text" id="metrobankAccount" name="metrobankAccount" />
          </div-->

          <!-- BDO Details -->
          <!--div id="bdoDetails">
            <label for="bdoAccount">BDO Account Number:</label>
            <input type="text" id="bdoAccount" name="bdoAccount" />
          </div-->

          <button class="donate" form="donationForm">DONATE</button>
        </form>
      </div>

    </div>
  </div>
</div>

<div class="map" id="map">
  <h2>JA1 Church Mega Sanctuary Location MAP</h2>
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8042.615381518403!2d121.07010594814552!3d13.787898499493496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd0fe5f4f3eb31%3A0x65dcec8f02c42c7b!2sJesus%20the%20Anointed%20One%20Church%20Mega%20Sanctuary!5e0!3m2!1sen!2sph!4v1695907833188!5m2!1sen!2sph" style="border:0; width: 100%; height:450px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<section class="footer">
  <div class="footer-row">
    <div class="footer-col">
      <h4>About</h4>
      <ul class="links">
        <li><a href="?page=ja1_overview">Overview of the Church</a></li>
        <li><a href="?page=ja1_headpastor">Head Pastor</a></li>
        <li><a href="?page=ja1_values">Mision & Vision</a></li>
        <li><a href="?page=ja1_declaration">Declaration of Faith</a></li>
        <li><a href="<?php echo base_url."dashboard" ?>">About Us</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4>Church Donation</h4>
      <ul class="links">
        <li><a href="?page=ja1_churchdonation">Donation</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4>Reservation</h4>
      <ul class="links">
        <li><a href="?page=ja1_reservation">Reservation Events</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4>Transaction Reports</h4>
      <ul class="links">
        <li><a href="?page=ja1_transactionreports">Reports</a></li>
      </ul>
    </div>

  </div>
</section>


<script src="<?php echo base_url ?>dist/customfiles/user_js/home.js"></script>

<script>
  $('section').removeClass('content');
  $('div').removeClass('container-fluid');
  $('div').removeClass('content-header');
</script>


<script>
  $(document).ready(function() {

    $('#donationForm').submit(function(e) {
      e.preventDefault();
      var _this = $(this);
      $('.err-msg').remove();
      start_loader();
      $.ajax({
        url: _base_url_ + "classes/Content.php?f=send_donation",
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: "POST",
        type: "POST",
        dataType: "json",
        error: err => {
          alert_toast(" Minimum is 20 pesos", 'error')
          console.log(err);
          end_loader();
        },
        success: function(resp) {
          if (typeof resp == 'object' && resp.status == 'success') {
            end_loader();
            //location.href = _base_url_ + "dashboard/?page=ja1_reservation";
            window.location.replace(resp.link);
          } else {
            alert_toast("An error occured", 'error')
            console.log(resp);
            end_loader();
          }
        }
      })
    })

  })
</script>


<!------------------- modal donate start ----------------->

<script>
  $(document).ready(function() {
    document
      .getElementById("donateButton")
      .addEventListener("click", function() {
        document.getElementById("modal").style.display = "block";
      });

    document
      .getElementById("closeModal")
      .addEventListener("click", function() {
        document.getElementById("modal").style.display = "none";
      });

    window.addEventListener("click", function(event) {
      if (event.target === document.getElementById("modal")) {
        document.getElementById("modal").style.display = "none";
      }
    });

    var slctmthd = document.getElementById("paymentMethod").value;
    if (slctmthd === "gcash") {
      gcashDetails.style.display = "block";
    }


    document.getElementById("paymentMethod").addEventListener("change", function() {
      var selectedMethod = this.value;
      //var gcashDetails = document.getElementById("gcashDetails");
      var metrobankDetails = document.getElementById("metrobankDetails");
      var bdoDetails = document.getElementById("bdoDetails");

      gcashDetails.style.display = "none";
      metrobankDetails.style.display = "none";
      bdoDetails.style.display = "none";

      if (selectedMethod === "gcash") {
        gcashDetails.style.display = "block";
      } else if (selectedMethod === "metrobank") {
        metrobankDetails.style.display = "block";
      } else if (selectedMethod === "bdo") {
        bdoDetails.style.display = "block";
      }
    });
  })
</script>
<!------------------- modal donate end ----------------->

</body>

</html>