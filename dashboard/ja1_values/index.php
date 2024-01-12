<head>
  <link rel="stylesheet" href="<?php echo base_url ?>dist/customfiles/css/blog.css" />
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
  <h2>Mission & Vision</h2>
  <div class="line">
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>

<section id="about-blog">
  <div class="blogs">
    <div class="about" style="text-align: justify;">
      <img src="<?php echo base_url ?>dist/customfiles/images/G2.jpg" alt="" />
      <h3><b>Mission</b></h3>
      <p>Our mission is to set an extraordinary of massive evangelism through Inner Healing and Deliverance preaching the gospel of the Lord Jesus Christ; healing the broken hearted; deliverance to the captive, recovering of sight to the blind; liberty to them that are bruised; and proclaiming the acceptable year of the Lord [empowered by the Word of the Lord in Luke 4:18-19 as covenant tool of JA1].</p>
      <br>
      Accordingly, turning the world upside down to Christ by enabling, equipping and upgrading, JA1 people, leaders and pastors to be a vessel of honor in this very task and eventually sending them to fulfill the mandates and call of the Lord in this Church around the globe, more so, to be worthy as His bride.

      <br><br>
      <h3><b>Vision</b></h3>
      <p> To be a church where the Lord Jesus Christ is genuinely enthroned; anointed and blessed to be a blessing to anyone wherever footed, consequently, persist with to be distinct from among others could follow incessantly standing and declaring Gods call to JA1 Church as found in Genesis 12:2-3, which state:
      </p>
      <br><br>
      "And I will make you a great nation, and I will bless you [with abundant increase of favor] and make your name famous and distinguished, and you will be a blessing [dispensing good to others].

      <br><br>
      And I will bless those who will bless you [who confer curses or uses insolent language toward you; in you will the families and kindred of the earth be blessed [and by you they will bless themselves]. (Amplified Bible).
      <br><br>

    </div>
  </div>
</section>

<!--contact content end-->
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

<!------------------- dropdown javascript start ----------------->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const reportsLink = document.getElementById("reportsLink");
    const reportsDropdown = document.getElementById("reportsDropdown");

    reportsLink.addEventListener("click", function(e) {
      e.preventDefault();
      reportsDropdown.style.display = reportsDropdown.style.display === "block" ? "none" : "block";
    });
  });
</script>
<!------------------- dropdown javascript end ----------------->