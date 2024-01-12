<?php
if (isset($_GET['success'])) : ?>
    <script>
        var data = [
                [0, 11, "Good Morning"],
                [12, 18, "Good Afternoon"],
                [18, 24, "Good Evening"]
            ],
            hr = new Date().getHours();

        var greetampm = '';
        var greetimg = '';
        for (var i = 0; i < data.length; i++) {
            if (hr >= data[i][0] && hr <= data[i][1]) {
                greetampm = (data[i][2]) + ' !';
                if (data[i][2] == "Good Morning") {
                    greetimg = '../images/morning.png';
                } else if (data[i][2] == "Good Afternoon") {
                    greetimg = '../images/afternoon.png';
                } else if (data[i][2] == "Good Evening") {
                    greetimg = '../images/evening.png';
                }
                break;
            }
        }
        // Assume the username is retrieved from the login process
        var username = '<?php echo ucwords($_settings->userdata('firstname') . ' ' . ucwords($_settings->userdata('lastname'))); ?>'; // Replace with the actual username

        // Check if the greeting has been shown before
        //var hasShownGreeting = localStorage.getItem('hasShownGreeting');

        //if (!hasShownGreeting) {
        // Display a SweetAlert greeting
        Swal.fire({
            title: greetampm,
            text: 'Hello, ' + username + '!',
            imageUrl: greetimg,
            imageWidth: 200,
            imageHeight: 200,
            confirmButtonText: 'OK'
        });

        // Mark that the greeting has been shown
        //localStorage.setItem('hasShownGreeting', true);
        //}
    </script>
<?php endif; ?>

<head>
    <link rel="stylesheet" href="<?php echo base_url ?>dist/customfiles/css/about1.css" />
</head>

<style>
    footer {
        display: none;
    }

    .layout-footer-fixed .wrapper .content-wrapper {
        padding-bottom: 0;
    }
</style>


<section class="content">
    <div class="container-fluid">
        <div class="background">
            <img src="<?php echo base_url ?>dist/customfiles/images/JA1HOME.jpeg" alt="" />
        </div>
        <div class="contact-bg">
            <h2>About Us</h2>
            <div class="line">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>

        <div class="row">
            <div class="img-logo">
                <img src="<?php echo base_url ?>dist/customfiles/images/p16.jpg" alt="" />
            </div>
            <div class="content-wrap">
                <div class="about-content">
                    <h2>Overview of the Church</h2>
                    <p>
                        In the heart of Batangas City, Philippines, a fast growing
                        church is making a difference in the lives of many people.
                        Focusing on the mandate of Christ Jesus, they are reaching
                        the lost, empowering the weak, healing the sick, setting the
                        captives free, and sharing the love of God to those who are
                        broken and had lost hope.
                    </p>
                    <a href="<?php echo base_url ?>dashboard/?page=ja1_overview">Read More</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="img-logo">
                <img src="<?php echo base_url ?>dist/customfiles/images/p1.jpg" alt="" />
            </div>
            <div class="content-wrap">
                <div class="about-content">
                    <h2>Head Pastor</h2>
                    <p>
                        Bishop Art studied in the School of Ministry and was able to
                        enter in the service as an assistant pastor. Not looking to
                        the prestige of any position, title or name, Bishop Art
                        faithfully heeded to what God had instructed to him to
                        preach the good news to many people.
                    </p>
                    <a href="<?php echo base_url ?>dashboard/?page=ja1_headpastor">Read More</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="img-logo">
                <img src="<?php echo base_url ?>dist/customfiles/images/G2.jpg" alt="" />
            </div>
            <div class="content-wrap">
                <div class="about-content">
                    <h2>Core Values</h2>
                    <p>
                        Accordingly, turning the world upside down to Christ by
                        enabling, equipping and upgrading, JA1 people, leaders and
                        pastors to be a vessel of honor in this very task and
                        eventually sending them to fulfill the mandates and call of
                        the Lord in this Church around the globe, more so, to be
                        worthy as His bride.
                    </p>
                    <a href="<?php echo base_url ?>dashboard/?page=ja1_values">Read More</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="img-logo">
                <img src="<?php echo base_url ?>dist/customfiles/images/JA1HOME3.jpg" alt="" />
            </div>
            <div class="content-wrap">
                <div class="about-content">
                    <h2>Declaration of Faith</h2>
                    <p>
                        We believe in one god, personal and knowable, who manifests
                        Himself in three persons, the Father, the son and the Holy
                        Spirit, co – eternal in being, co – identical in nature, co
                        – equal in power and glory, and having the same attributes
                        and perfection (Deut. 6:4; Matt. 28:19 – 20; Jn. 6:27; 2
                        Cor. 13:14; 1 Jn. 5:20).
                    </p>
                    <a href="<?php echo base_url ?>dashboard/?page=ja1_declaration">Read More</a>
                </div>
            </div>
        </div>

        <br>
        <br>

        <!-------------------about content END------------------->

        <!-------------------gallery content start------------------->


        <div class="contact-bg">
            <link rel="stylesheet" href="" />
            <h2>Gallery</h2>
            <div class="line">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="container" id="gallery">
            <div class="slider-wrapper">
                <button id="prev-slide" class="slide-button material-symbols-rounded">
                    <i class="fas fa-chevron-left" style="font-size: 0.4em"></i>
                    <!-- Font Awesome left arrow icon -->
                </button>
                <ul class="image-list">
                    <img class="image-item" src="<?php echo base_url ?>dist/customfiles/images/p14.jpg" alt="img-1" />
                    <img class="image-item" src="<?php echo base_url ?>dist/customfiles/images/p15.jpg" alt="img-2" />
                    <img class="image-item" src="<?php echo base_url ?>dist/customfiles/images/p16.jpg" alt="img-3" />
                    <img class="image-item" src="<?php echo base_url ?>dist/customfiles/images/gallery1.jpeg" alt="img-4" />
                    <img class="image-item" src="<?php echo base_url ?>dist/customfiles/images/gallery2.jpeg" alt="img-5" />
                    <img class="image-item" src="<?php echo base_url ?>dist/customfiles/images/gallery3.jpeg" alt="img-6" />
                    <img class="image-item" src="<?php echo base_url ?>dist/customfiles/images/gallery4.jpeg" alt="img-7" />
                </ul>
                <button id="next-slide" class="slide-button material-symbols-rounded">
                    <i class="fas fa-chevron-right" style="font-size: 0.4em"></i>
                    <!-- Font Awesome right arrow icon -->
                </button>
            </div>
            <div class="slider-scrollbar">
                <div class="scrollbar-track">
                    <div class="scrollbar-thumb"></div>
                </div>
            </div>
        </div>

        <!------------------gallery content END------------------->

        <!-------------------faqs content start------------------->


        <!--div class="contact-bg">
            <h2>FAQs</h2>
            <div class="line">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="accordion-content">
            <main class="accordion">
                <div class="faq-img">
                    <img src="<?php echo base_url ?>dist/customfiles/images/FAQ'sP1.jpg" alt="" class="accordion-img" />
                </div>
                <div class="content-accordion">
                    <div class="question-answer">
                        <div class="question">
                            <h3 class="title-question">How do I make a reservation?</h3>
                            <button class="question-btn">
                                <span class="up-icon">
                                    <i class="fas fa-chevron-up"></i>
                                </span>
                                <span class="down-icon">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </button>
                        </div>
                        <div class="answer">
                            <p>
                                Events such as birthdays, weddings, child dedications, services, and blessings must be chosen in order to be kept. Once the events have been chosen, all pertinent information about them must be entered and submitted. Wait a few minutes after that, as the admin will then establish a payment amount that needs to be made by the user for the status to change to Paid. If the money is paid, the admin will confirm that the reserved events have occurred.
                            </p>
                        </div>
                    </div>
                    <div class="question-answer">
                        <div class="question">
                            <h3 class="title-question">
                                Is it possible to cash payment or online payment method?
                            </h3>
                            <button class="question-btn">
                                <span class="up-icon">
                                    <i class="fas fa-chevron-up"></i>
                                </span>
                                <span class="down-icon">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </button>
                        </div>
                        <div class="answer">
                            <p>
                                The reservation for events requires that the payment be made using online payment method.
                            </p>
                        </div>
                    </div>
                    <div class="question-answer">
                        <div class="question">
                            <h3 class="title-question">
                                How many events can I reserve?
                            </h3>
                            <button class="question-btn">
                                <span class="up-icon">
                                    <i class="fas fa-chevron-up"></i>
                                </span>
                                <span class="down-icon">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </button>
                        </div>
                        <div class="answer">
                            <p>
                                Only one event reservation is allowed per day, and at times, a reservation may have already been made for a specific date. In such cases, when a reservation has already been made for that day, the calendar date will be disabled.
                            </p>
                        </div>
                    </div>
                    <div class="question-answer">
                        <div class="question">
                            <h3 class="title-question">Is a pastor already assigned when we reserve for events?</h3>
                            <button class="question-btn">
                                <span class="up-icon">
                                    <i class="fas fa-chevron-up"></i>
                                </span>
                                <span class="down-icon">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </button>
                        </div>
                        <div class="answer">
                            <p>
                                No
                            </p>
                        </div>
                    </div>
                    <div class="question-answer">
                        <div class="question">
                            <h3 class="title-question">Is it possible to update the reservation in case we input something incorrectly?</h3>
                            <button class="question-btn">
                                <span class="up-icon">
                                    <i class="fas fa-chevron-up"></i>
                                </span>
                                <span class="down-icon">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </button>
                        </div>
                        <div class="answer">
                            <p>
                                Yes, if a user has made an error in entering information for an event reservation, they can edit the reserved event. Additionally, if a user has mistakenly selected the wrong event, they can also delete it.
                            </p>
                        </div>
                    </div>
                </div>
            </main>
        </div-->
        <!--------------faq content END ----------->

        <section class="footer">
            <div class="footer-row">
                <div class="footer-col">
                    <h4>About</h4>
                    <ul class="links">
                        <li><a href="?page=ja1_overview">Overview of the Church</a></li>
                        <li><a href="?page=ja1_headpastor">Head Pastor</a></li>
                        <li><a href="?page=ja1_values">Mision & Vision</a></li>
                        <li><a href="?page=ja1_declaration">Declaration of Faith</a></li>
                        <li><a href="">About Us</a></li>
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
    </div>
</section>

<script src="<?php echo base_url ?>dist/customfiles/user_js/home.js"></script>


<script>
    $('section').removeClass('content');
    $('div').removeClass('container-fluid');
    $('div').removeClass('content-header');
</script>

<!------------------- gallery slider navigation start ----------------->
<script>
    const initSlider = () => {
        const imageList = document.querySelector(".slider-wrapper .image-list");
        const slideButtons = document.querySelectorAll(
            ".slider-wrapper .slide-button"
        );
        const sliderScrollbar = document.querySelector(
            ".container .slider-scrollbar"
        );
        const scrollbarThumb =
            sliderScrollbar.querySelector(".scrollbar-thumb");
        const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;

        // Handle scrollbar thumb drag
        scrollbarThumb.addEventListener("mousedown", (e) => {
            const startX = e.clientX;
            const thumbPosition = scrollbarThumb.offsetLeft;
            const maxThumbPosition =
                sliderScrollbar.getBoundingClientRect().width -
                scrollbarThumb.offsetWidth;

            // Update thumb position on mouse move
            const handleMouseMove = (e) => {
                const deltaX = e.clientX - startX;
                const newThumbPosition = thumbPosition + deltaX;

                // Ensure the scrollbar thumb stays within bounds
                const boundedPosition = Math.max(
                    0,
                    Math.min(maxThumbPosition, newThumbPosition)
                );
                const scrollPosition =
                    (boundedPosition / maxThumbPosition) * maxScrollLeft;

                scrollbarThumb.style.left = `${boundedPosition}px`;
                imageList.scrollLeft = scrollPosition;
            };

            // Remove event listeners on mouse up
            const handleMouseUp = () => {
                document.removeEventListener("mousemove", handleMouseMove);
                document.removeEventListener("mouseup", handleMouseUp);
            };

            // Add event listeners for drag interaction
            document.addEventListener("mousemove", handleMouseMove);
            document.addEventListener("mouseup", handleMouseUp);
        });

        // Slide images according to the slide button clicks
        slideButtons.forEach((button) => {
            button.addEventListener("click", () => {
                const direction = button.id === "prev-slide" ? -1 : 1;
                const scrollAmount = imageList.clientWidth * direction;
                imageList.scrollBy({
                    left: scrollAmount,
                    behavior: "smooth"
                });
            });
        });

        // Show or hide slide buttons based on scroll position
        const handleSlideButtons = () => {
            slideButtons[0].style.display =
                imageList.scrollLeft <= 0 ? "none" : "flex";
            slideButtons[1].style.display =
                imageList.scrollLeft >= maxScrollLeft ? "none" : "flex";
        };

        // Update scrollbar thumb position based on image scroll
        const updateScrollThumbPosition = () => {
            const scrollPosition = imageList.scrollLeft;
            const thumbPosition =
                (scrollPosition / maxScrollLeft) *
                (sliderScrollbar.clientWidth - scrollbarThumb.offsetWidth);
            scrollbarThumb.style.left = `${thumbPosition}px`;
        };

        // Call these two functions when image list scrolls
        imageList.addEventListener("scroll", () => {
            updateScrollThumbPosition();
            handleSlideButtons();
        });
    };

    window.addEventListener("resize", initSlider);
    window.addEventListener("load", initSlider);
</script>
<!------------------- gallery slider navigation end ----------------->


<!------------------- sweet alert logout start ----------------->
<script>
    // Function to show the logout confirmation using SweetAlert
    function showLogoutConfirmation() {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to logout your account?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                // User clicked "Yes," redirect to the login page
                window.location.href = 'login.php';
            } else {
                // User clicked "No" or canceled, redirect to the about page
                window.location.href = 'about.php';
            }
        });
    }
</script>
<!------------------- sweet alert logout end ----------------->

<!------------------- faq javascript start ----------------->

<script>
    const questions = document.querySelectorAll(".question-answer");

    questions.forEach(function(question) {
        const btn = question.querySelector(".question-btn");
        btn.addEventListener("click", function() {
            questions.forEach(function(item) {
                if (item !== question) {
                    item.classList.remove("show-text");
                }
            });
            question.classList.toggle("show-text");
        });
    });
</script>
<!------------------- faq javascript end ----------------->