<?php if ($_settings->chk_flashdata('success')) : ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>

<head>
    <link rel="stylesheet" href="<?php echo base_url ?>dist/customfiles/css/reservations.css" />

    <link rel="stylesheet" href="<?php echo base_url ?>plugins/jquery-ui/jquery-ui.css" />

    <link rel="stylesheet" href="<?php echo base_url ?>plugins/fullcalendar/main.css">
</head>


<style>
    footer {
        display: none;
    }

    .layout-footer-fixed .wrapper .content-wrapper {
        padding-bottom: 0;
    }

    .p-viewer {
        float: right;
        margin-top: -30px;
        margin-right: 20px;
        position: relative;
        z-index: 1;
        cursor: pointer;
    }

    .disabled-date .ui-datepicker-calendar .ui-datepicker-calendar-container {
        background-color: red;
        /* Background color for disabled dates */
    }
</style>


<div class="background">
    <img src="<?php echo base_url ?>dist/customfiles/images/JA1HOME.jpeg" alt="" />
</div>
<div class="contact-bg">
    <link rel="stylesheet" href="" />
    <h2>Church Calendar</h2>
    <div class="line">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>

<div class="card-body" style="  width: 100%;">


    <section class="content">
        <div class="container-fluid">
            <div class="row">


                <div class="col">
                    <div class="card card-primary">
                        <div class="card-body p-0">

                            <div id="calendar"></div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>


</div>



<div class="contact-bg">
    <h2>Reservations</h2>
    <div class="line">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<div class="menu">
    <div class="reserve-events">
        <img src="<?php echo base_url ?>dist/customfiles/images/birthday.jpeg" />
        <div class="details">
            <div class="details-sub">
                <h5>Birthday Event</h5>
            </div>
            <p>
            </p>

            <button id="BirthdayEventNowBtn" data-title="Birthday Event">
                Reserve Now
            </button>
        </div>
    </div>

    <!------------------- birthday events start ------------------>

    <div id="myModal" class="modal">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>

                <h2>Birthday Event</h2>
                <section class="forms-event">
                    <form id="birthday_event" class="form">
                        <h6><b>Contact Person</b></h6>
                        <input type="hidden" name="Customer_Name" id="Customer_Name" placeholder="" value="<?php echo ucwords($_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname'));  ?>" />
                        <input type="hidden" name="Customer_ID" id="Customer_ID" placeholder="" value="<?php echo ucwords($_settings->userdata('id'));  ?>" />
                        <input type="hidden" name="Transaction_No" id="Transaction_No" placeholder="" value="<?php echo 'JA1' . date("YmdHis");  ?>" />
                        <div class="personal">
                            <div class="input-box">
                                <label>Full Name</label>
                                <input type="text" name="firstname" id="firstname" placeholder="" required />
                            </div>
                            <div class="input-box">
                                <label>Contact Number</label>
                                <input type="number" name="contactno" id="contactno" placeholder="" required />
                            </div>
                        </div>

                        <div class="number">
                            <div class="input-box">
                                <label>Celebrant Full Name</label>
                                <input type="text" name="lastname" id="lastname" placeholder="" required />
                            </div>
                            <div class="input-box">
                                <label>Age</label>
                                <input type="number" name="age" id="age" placeholder="" required />
                            </div>
                        </div>

                        <div class="detail">
                            <!--div class="input-box">
                                <label>Time of Events</label>
                                <input type="time" placeholder="" required />
                            </div-->
                            <!--div class="input-box">
                                <label>Date and Time of Event</label>
                                <input type="datetime-local" placeholder="" name="datetime" id="datetime" required />
                            </div-->
                            <div class="input-box">
                                <label>Service Date</label>
                                <input type="text" placeholder="" name="datewant" id="datetime" required />
                                <span class="p-viewer">
                                    <i class="fa fa-calendar" id="togglePassword" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="input-box">
                                <label>Service Time</label>
                                <input type="time" name="timewant" id="timewant" placeholder="" required />
                            </div>
                        </div>

                        <!--div class="rent">
                            <div class="input-box">
                                <label>Catering Service Rent</label>
                                <input type="text" name="csrent" id="csrent" placeholder="" required />
                            </div>
                            <div class="input-box">
                                <label>Food/Equipment Rent</label>
                                <input type="text" name="ferent" id="ferent" placeholder="" required />
                            </div>
                        </div-->

                        <div class="guess">
                            <div class="input-box">
                                <label>Birthday Theme</label>
                                <input type="text" name="birthdaytheme" id="birthdaytheme" placeholder="" required />
                            </div>
                            <div class="input-box">
                                <label>Total Guest</label>
                                <input type="number" name="ttlguess" id="ttlguess" placeholder="" required />
                            </div>
                            <div class="input-box" style="display: none;">
                                <label>Price</label>
                                <input type="number" name="price" id="price" placeholder="" />
                            </div>
                        </div>

                        <div class="guess">
                            <div class="input-box">
                                <label>Venue Location</label>
                                <input type="text" name="venueloc" id="venueloc" placeholder="" required />
                            </div>
                            <!--div class="input-box">
                                <label>Officiating Minister</label>
                                <input type="text" name="off_minister" id="off_minister" placeholder="" required />
                            </div-->
                        </div>

                        <div class="gender-box">
                            <h3>Gender</h3>
                            <div class="gender-option">
                                <div class="gender">
                                    <input type="radio" id="male" name="gender" value="Male" checked />
                                    <label for="male">Male</label>
                                </div>
                                <div class="gender">
                                    <input type="radio" id="female" name="gender" value="Female" />
                                    <label for="female">Female</label>
                                </div>
                                <div class="gender">
                                    <input type="radio" id="other" name="gender" value="N/A" />
                                    <label for="other">Prefer not to say</label>
                                </div>
                            </div>
                        </div>

                        <div class="input-box leader" style="display: none;">
                            <label>Payment Type</label>
                            <div class="column">
                                <div class="select-box">
                                    <select name="payment_type" id="payment_type">
                                        <option hidden></option>
                                        <option value="Walk-In" selected>Walk-In</option>
                                        <option value="E-Wallet">E-Wallet</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button form="birthday_event">Submit</button>
                    </form>
                </section>
            </div>
        </div>
    </div>

    <!------------------- birthday events end ------------------>

    <div class="reserve-events">
        <img src="<?php echo base_url ?>dist/customfiles/images/wedding.jpg" />
        <div class="details">
            <div class="details-sub">
                <h5>Wedding Event</h5>
            </div>
            <p>
            </p>

            <button id="openWeddingModalBtn">Reserve Now</button>
        </div>
    </div>

    <!------------------- wedding events start ------------------>

    <div id="weddingModal" class="modal">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <span class="close" id="closeModalWedding">&times;</span>
                <h2>Wedding Event</h2>
                <p>
                    * This event only allows walk-in reservations, not online
                    reservations.
                </p>
                <p>* Not allowed to be seen requirements immediately.</p>

                <!--h2>Bride and Groom Information</h2-->
                <h4>Wedding Inquiry</h4>
                <section class="forms-event">
                    <form id="wedding_event" class="form">
                        <input type="hidden" name="Customer_Name" id="Customer_Name" placeholder="" value="<?php echo ucwords($_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname'));  ?>" />
                        <input type="hidden" name="Customer_ID" id="Customer_ID" placeholder="" value="<?php echo ucwords($_settings->userdata('id'));  ?>" />
                        <input type="hidden" name="Transaction_No" id="Transaction_No" placeholder="" value="<?php echo 'JA1' . date("YmdHis");  ?>" />
                        <div class="personal">
                            <div class="input-box">
                                <label>Full Name</label>
                                <input type="text" name="Full_Name" id="Full_Name" placeholder="" required />
                            </div>
                            <div class="input-box">
                                <label>Contact Number</label>
                                <input type="number" name="Contact" id="Contact" placeholder="" required />
                            </div>
                        </div>

                        <div class="personal">
                            <div class="input-box">
                                <label>Target Date to Marry</label>
                                <input type="text" name="target_marry_date" id="target_marry_date" required />
                            </div>
                        </div>

                        <div class="personal">
                            <div class="input-box">
                                <label>Questions/Inquiries</label>
                                <!--input type="text" name="ques_inqs" id="ques_inqs" placeholder="" required /-->
                                <textarea name="ques_inqs" id="ques_inqs" cols="30" rows="5" style="width: 100%;"></textarea>
                            </div>
                        </div>

                        <!--div class="personal">
                            <div class="input-box">
                                <label>Bride Name</label>
                                <input type="text" name="Bride_Name" id="Bride_Name" placeholder="" required />
                            </div>
                            <div class="input-box">
                                <label>Groom Name</label>
                                <input type="text" name="Groom_Name" id="Groom_Name" placeholder="" required />
                            </div>
                        </div-->

                        <!--div class="number"-->
                        <!--div class="input-box">
                                <label>Set Appointment</label>
                                <input type="datetime-local" name="Set_Appointment_Date" id="Set_Appointment_Date" placeholder="" required />
                            </div-->
                        <!--div class="input-box">
                                <label>Set Date of Appointment</label>
                                <input type="text" placeholder="" name="Set_Appointment_Date_Want" id="Set_Appointment_Date_Want" required />
                                <span class="p-viewer">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="input-box">
                                <label>Set Time of Appointment</label>
                                <input type="time" name="Set_Appointment_Time_Want" id="timewant2" placeholder="" required />
                            </div>
                        </div-->
                        <button form="wedding_event">Submit</button>
                    </form>
                </section>
            </div>
        </div>
    </div>

    <!------------------- wedding events end ------------------>

    <div class="reserve-events">
        <img src="<?php echo base_url ?>dist/customfiles/images/dedication.jpeg" />
        <div class="details">
            <div class="details-sub">
                <h5>Child Dedication</h5>
            </div>
            <p>
            </p>

            <button id="openDedicationModalBtn">Reserve Now</button>
        </div>
    </div>
    <!------------------- child desication events start ------------------>

    <div id="dedicationModal" class="modal">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <span class="close" id="closeModalDedication">&times;</span>
                <h2>Child Dedication Event</h2>
                <section class="forms-event">
                    <h6><b>Contact Person</b></h6>
                    <form id="child_dedication_events" class="form">
                        <input type="hidden" name="Customer_Name" id="Customer_Name" placeholder="" value="<?php echo ucwords($_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname'));  ?>" />
                        <input type="hidden" name="Customer_ID" id="Customer_ID" placeholder="" value="<?php echo ucwords($_settings->userdata('id'));  ?>" />
                        <input type="hidden" name="Transaction_No" id="Transaction_No" placeholder="" value="<?php echo 'JA1' . date("YmdHis");  ?>" />
                        <div class="personal">
                            <div class="input-box">
                                <label>Full Name</label>
                                <input type="text" name="First_Name" id="First_Name" placeholder="" required />
                            </div>
                            <div class="input-box">
                                <label>Contact Number</label>
                                <input type="number" name="Contact_No" id="Contact_No" placeholder="" required />
                            </div>
                        </div>

                        <div class="number">
                            <div class="input-box">
                                <label>Full Name of Child</label>
                                <input type="text" name="Last_Name" id="Last_Name" placeholder="" required />
                            </div>
                            <div class="input-box">
                                <label>Address</label>
                                <input type="text" name="Address" id="Address" placeholder="" required />
                            </div>
                        </div>

                        <div class="detail">
                            <div class="input-box">
                                <label>Birthday</label>
                                <input type="date" name="Birthdate" id="Birthdate" placeholder="" required />
                            </div>
                            <div class="input-box">
                                <label>Birthplace</label>
                                <input type="text" name="Birthplace" id="Birthplace" placeholder="" required />
                            </div>
                        </div>

                        <div class="detail">
                            <div class="input-box">
                                <label>Father Name</label>
                                <input type="text" name="Father_Name" id="GodFather_Name" placeholder="" required />
                            </div>
                            <div class="input-box">
                                <label>Native of Province</label>
                                <input type="text" name="Father_Province" id="Father_Province" placeholder="" required />
                            </div>
                        </div>
                        <div class="detail">
                            <div class="input-box">
                                <label>Mother Name</label>
                                <input type="text" name="Mother_Name" id="GodMother_Name" placeholder="" required />
                            </div>
                            <div class="input-box">
                                <label>Native of Province</label>
                                <input type="text" name="Mother_Province" id="Mother_Province" placeholder="" required />
                            </div>
                        </div>

                        <div class="rent">
                            <div class="input-box">
                                <label>Birth Certificate of Child</label>
                                <input type="file" name="BirthCert_Child" id="BirthCert_Child" placeholder="" onchange="displayImg(this,$(this))" required style="padding-top: 7px" />
                                <img src="<?php echo validate_image(isset($BirthCert_Child) ? $BirthCert_Child : '') ?>" alt="" id="cimg" class="img-fluid img-thumbnail" style="display: none;">
                                <br>
                                <a href="javascript:void(0)" class="BirthCert"><span class="fa fa-image text-pink"></span>View Birth Certificate</a>
                            </div>
                            <div class="input-box">
                                <label>Marriage Certificate of Guardian</label>
                                <input type="file" name="MarriageCert_Guardian" id="MarriageCert_Guardian" placeholder="" onchange="displayImg2(this,$(this))" required style="padding-top: 7px" />
                                <img src="<?php echo validate_image(isset($MarriageCert_Guardian) ? $MarriageCert_Guardian : '') ?>" alt="" id="cimg2" class="img-fluid img-thumbnail" style="display: none;">
                                <br>
                                <a href="javascript:void(0)" class="MarriageCert"><span class="fa fa-image text-pink"></span>View Marriage Certificate</a>
                            </div>
                        </div>
                        <br>
                        <h6 class="text-danger" style="font-size: 12px;"><i><b>NOTE:</b> Please attach a photo of your Birth Certificate and Marriage Contract</i></h6>

                        <div class="detail">
                            <div class="input-box">
                                <label>Witnesses</label><br>
                                <textarea name="name_witnesses" id="name_witnesses" cols="30" rows="10" style="width: 100%;"></textarea>
                            </div>
                        </div>

                        <div class="input-box address">
                            <label>Place of Dedication</label>
                            <input type="text" name="Venue_Location" id="Venue_Location" placeholder="" required />
                        </div>

                        <div class="number">
                            <div class="input-box">
                                <label>Set Date of Dedication</label>
                                <input type="text" placeholder="" name="Set_Dedication_Date_Want" id="Set_Dedication_Date_Want" required />
                                <span class="p-viewer">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="input-box">
                                <label>Set Time of Dedication</label>
                                <input type="time" name="Set_Dedication_Time_Want" id="timewantDedication" placeholder="" required />
                            </div>
                        </div>

                        <div class="gender-box">
                            <h3>Gender</h3>
                            <div class="gender-option">
                                <div class="gender">
                                    <input type="radio" id="male" name="gender" value="Male" checked />
                                    <label for="male">Male</label>
                                </div>
                                <div class="gender">
                                    <input type="radio" id="female" name="gender" value="Female" />
                                    <label for="female">Female</label>
                                </div>
                                <div class="gender">
                                    <input type="radio" id="other" name="gender" value="N/A" />
                                    <label for="other">Prefer not to say</label>
                                </div>
                            </div>
                        </div>

                        <button form="child_dedication_events">Submit</button>
                    </form>
                </section>
            </div>
        </div>
    </div>
    <!------------------- child desication events end ------------------>

    <div class="reserve-events">
        <img src="<?php echo base_url ?>dist/customfiles/images/funeral.jpeg" />
        <div class="details">
            <div class="details-sub">
                <h5>Funeral Service</h5>
            </div>
            <p>
            </p>

            <button id="openServiceModalBtn">Reserve Now</button>
        </div>
    </div>

    <!------------------- funeral service events start ------------------>
    <div id="serviceModal" class="modal">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <span class="close" id="closeModalService">&times;</span>
                <h2>Funeral Service Event</h2>
                <section class="forms-event">
                    <form id="funeral_service" class="form">
                        <h6><b>Contact Person</b></h6>
                        <input type="hidden" name="Customer_Name" id="Customer_Name" placeholder="" value="<?php echo ucwords($_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname'));  ?>" />
                        <input type="hidden" name="Customer_ID" id="Customer_ID" placeholder="" value="<?php echo ucwords($_settings->userdata('id'));  ?>" />
                        <input type="hidden" name="Transaction_No" id="Transaction_No" placeholder="" value="<?php echo 'JA1' . date("YmdHis");  ?>" />
                        <div class="personal">
                            <div class="input-box">
                                <label>Full Name</label>
                                <input type="text" name="First_Name" id="First_Name" placeholder="" required />
                            </div>
                            <div class="input-box">
                                <label>Contact Number</label>
                                <input type="number" name="Contact_No" id="Contact_No" placeholder="" required />
                            </div>

                        </div>

                        <div class="number">
                            <div class="input-box">
                                <label>Name of Deceased</label>
                                <input type="text" name="Last_Name" id="Last_Name" placeholder="" required />
                            </div>
                            <div class="input-box">
                                <label>Cause of Death</label>
                                <input type="text" name="Cause_Death" id="Cause_Death" placeholder="" required />
                            </div>
                        </div>

                        <div class="detail">
                            <!--div class="input-box">
                                <label>Time of Death</label>
                                <input type="time" placeholder="" required />
                            </div-->
                            <!--div class="input-box">
                                <label>Date and Time of Death</label>
                                <input type="datetime-local" placeholder="" name="DateTime_Death" id="DateTime_Death" required />
                            </div-->
                            <div class="input-box">
                                <label>Funeral Date</label>
                                <input type="text" placeholder="" name="Date_Funeral_S" id="Date_Funeral_S" required />
                                <span class="p-viewer">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="input-box">
                                <label>Funeral Time</label>
                                <input type="time" name="Time_Funeral_S" id="Time_Funeral_S" placeholder="" required />
                            </div>
                        </div>

                        <div class="rent">
                            <div class="input-box">
                                <label>Burial Location</label>
                                <input type="text" name="Venue_Location" id="Venue_Location" placeholder="" required />
                            </div>
                            <!--div class="input-box">
                                <label>Officiating Minister</label>
                                <input type="text" name="Cause_Death" id="Cause_Death" placeholder="" required />
                            </div-->
                            <!--div class="input-box">
                                <label>Address</label>
                                <input type="text" name="Address1" id="Address1" placeholder="" required />
                            </div-->
                        </div>

                        <!--div class="input-box address">
                            <label>Venue Location</label>
                            <input type="text" name="Venue_Location" id="Venue_Location" placeholder="" required />
                        </div-->

                        <div class="gender-box">
                            <h3>Gender</h3>
                            <div class="gender-option">
                                <div class="gender">
                                    <input type="radio" id="male" name="gender" checked value="Male" />
                                    <label for="male">Male</label>
                                </div>
                                <div class="gender">
                                    <input type="radio" id="female" name="gender" value="Female" />
                                    <label for="female">Female</label>
                                </div>
                                <div class="gender">
                                    <input type="radio" id="check-other" name="gender" value="N/A" />
                                    <label for="other">Prefer not to say</label>
                                </div>
                            </div>
                        </div>

                        <button form="funeral_service">Submit</button>
                    </form>
                </section>
            </div>
        </div>
    </div>
    <!------------------- funeral service events end ------------------>

    <div class="reserve-events">
        <img src="<?php echo base_url ?>dist/customfiles/images/blessing.jpg" />
        <div class="details">
            <div class="details-sub">
                <h5>Blessing Event</h5>
            </div>
            <p>
            </p>
            <button id="openBlessingModalBtn">Reserve Now</button>
        </div>
    </div>
</div>

<!------------------- blessing events start ------------------>
<div id="blessingModal" class="modal">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <span class="close" id="closeModalBlessing">&times;</span>
            <h2>Blessing Event</h2>
            <section class="forms-event">
                <form id="blessing_event" class="form">
                    <input type="hidden" name="Customer_Name" id="Customer_Name" placeholder="" value="<?php echo ucwords($_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname'));  ?>" />
                    <input type="hidden" name="Customer_ID" id="Customer_ID" placeholder="" value="<?php echo ucwords($_settings->userdata('id'));  ?>" />
                    <input type="hidden" name="Transaction_No" id="Transaction_No" placeholder="" value="<?php echo 'JA1' . date("YmdHis");  ?>" />
                    <div class="personal">
                        <div class="input-box">
                            <label>Owner Name</label>
                            <input type="text" name="Owner_Name" id="First_Name" placeholder="" required />
                        </div>
                        <div class="input-box">
                            <label>Contact Number</label>
                            <input type="number" name="Contact_No" id="Contact_No" placeholder="" required />
                        </div>
                    </div>

                    <div class="rent">
                        <!--div class="input-box">
                            <label>Time of Blessing</label>
                            <input type="time" placeholder="" required />
                        </div-->
                        <!--div class="input-box">
                            <label>Date and Time of Blessing</label>
                            <input type="datetime-local" placeholder="" name="DateTime_Blessing" id="DateTime_Blessing" required /-->

                        <div class="input-box">
                            <label>Service Date</label>
                            <input type="text" placeholder="" name="Date_Blessing" id="Date_Blessing" required />
                            <span class="p-viewer">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="input-box">
                            <label>Service Time</label>
                            <input type="time" name="Time_Blessing" id="Time_Blessing" placeholder="" required />
                        </div>
                    </div>

                    <div class="detail" style="display: none;">
                        <div class="input-box">
                            <label>Fb Name</label>
                            <input type="text" name="Fb_Name" id="Fb_Name" placeholder="" />
                        </div>
                        <div class="input-box">

                        </div>
                    </div>

                    <div class="number">

                        <div class="input-box">
                            <!--label>Age</label>
                            <input type="number" name="Age" id="Age" placeholder="" required /-->
                            <label>Total Guest</label>
                            <input type="number" name="Total_Guess" id="Total_Guess" placeholder="" required />
                        </div>
                    </div>

                    <div class="guess">
                        <div class="input-box" style="display: none;">
                            <label>Price</label>
                            <input type="number" name="Price" id="Price" placeholder="" />
                        </div>
                        <div class="input-box leader">
                            <label>Type of Blessings?</label>
                            <div class="column">
                                <div class="select-box">
                                    <select name="Blessing_Type" id="Blessing_Type">
                                        <option hidden>Select here</option>
                                        <option value="House">House</option>
                                        <option value="Business">Business</option>
                                        <option value="Exhibit">Exhibit</option>
                                        <option value="Vehicles">Vehicles</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="input-box address">
                        <label>Venue Location</label>
                        <input type="text" name="Venue_Location" id="Venue_Location" placeholder="" required />
                    </div>

                    <!--div class="gender-box">
                        <h3>Gender</h3>
                        <div class="gender-option">
                            <div class="gender">
                                <input type="radio" id="male" name="gender" checked value="Male" />
                                <label for="male">Male</label>
                            </div>
                            <div class="gender">
                                <input type="radio" id="female" name="gender" value="Female" />
                                <label for="female">Female</label>
                            </div>
                            <div class="gender">
                                <input type="radio" id="check-other" name="gender" value="N/A" />
                                <label for="other">Prefer not to say</label>
                            </div>
                        </div>
                    </div-->

                    <div class="input-box leader" style="display: none;">
                        <label>Payment Type</label>
                        <div class="column">
                            <div class="select-box">
                                <select name="payment_type" id="payment_type">
                                    <option hidden></option>
                                    <option value="Walk-In" selected>Walk-In</option>
                                    <option value="E-Wallet">E-Wallet</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button form="blessing_event">Submit</button>
                </form>
            </section>
        </div>
    </div>
</div>
<!------------------- blessing events end ------------------>

<!-------------------faqs content start------------------->


<div class="contact-bg">
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
</div>
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
                <li><a href="<?php echo base_url . "dashboard" ?>">About Us</a></li>
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

<script src="<?php echo base_url ?>dist/customfiles/user_js/home.js"></script>
<script src="<?php echo base_url ?>plugins/fullcalendar/main.js"></script>


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

<script>
    $('section').removeClass('content');
    $('div').removeClass('container-fluid');
    $('div').removeClass('content-header');
</script>

<!------------------- modal form javascript start ----------------->
<script>
    // Function to open the Birthday Modal
    var modal = document.getElementById("myModal");
    var joinForm = document.querySelector(".form"); // Changed to querySelector
    var closeModalBtn = document.getElementById("closeModal");

    function openModal(title) {
        modal.querySelector("h2").textContent = title;
        modal.style.display = "block";
    }

    closeModalBtn.onclick = function() {
        modal.style.display = "none";
    };
    document
        .getElementById("BirthdayEventNowBtn")
        .addEventListener("click", function() {
            openModal(this.getAttribute("data-title"));
        });

    // Function to open the Wedding Modal
    var modalWedding = document.getElementById("weddingModal");
    var openWeddingModalBtn = document.getElementById("openWeddingModalBtn");
    var closeModalWedding = document.getElementById("closeModalWedding");

    function openWeddingModal() {
        modalWedding.style.display = "block";
    }

    openWeddingModalBtn.onclick = function() {
        openWeddingModal();
    };

    closeModalWedding.onclick = function() {
        modalWedding.style.display = "none";
    };

    // Function to open the Child Dedication modal
    var modalDedication = document.getElementById("dedicationModal");
    var openDedicationModalBtn = document.getElementById(
        "openDedicationModalBtn"
    );
    var closeModalDedication = document.getElementById(
        "closeModalDedication"
    );

    function openDedicationModal() {
        modalDedication.style.display = "block";
    }

    openDedicationModalBtn.onclick = function() {
        openDedicationModal();
    };

    closeModalDedication.onclick = function() {
        modalDedication.style.display = "none";
    };

    // Function to open the Funeral Service modal
    var serviceModal = document.getElementById("serviceModal");
    var openServiceModalBtn = document.getElementById("openServiceModalBtn");
    var closeModalService = document.getElementById("closeModalService");

    function openServiceModal() {
        serviceModal.style.display = "block";
    }

    openServiceModalBtn.onclick = function() {
        openServiceModal();
    };

    // Event listener for the close button
    closeModalService.onclick = function() {
        serviceModal.style.display = "none";
    };

    // Function to open the Blessing modal
    var blessingModal = document.getElementById("blessingModal");
    var openBlessingModalBtn = document.getElementById(
        "openBlessingModalBtn"
    );
    var closeModalBlessing = document.getElementById("closeModalBlessing");

    // Function to open the Blessing Events modal
    function openBlessingModal() {
        blessingModal.style.display = "block";
    }

    // Event listener for the "Reserve Now" button
    openBlessingModalBtn.onclick = function() {
        openBlessingModal();
    };

    // Event listener for the close button
    closeModalBlessing.onclick = function() {
        blessingModal.style.display = "none";
    };
</script>
<!------------------- modal form javascript end ----------------->

<script>
    $(function() {
        // Your list of disabled dates
        var disabledDates = [];

        <?php
        $api_url = "https://www.googleapis.com/calendar/v3/calendars/en.philippines%23holiday%40group.v.calendar.google.com/events";
        $api_key = "AIzaSyCi0f4w1sJxJ7exMaT8bF_gTAzrlfSgbmU"; // Replace with your actual API key

        $url = $api_url . '?' . http_build_query(['key' => $api_key]);

        $options = [
            'http' => [
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                'method' => 'GET',
            ],
        ];

        $context = stream_context_create($options);
        $stream = fopen($url, 'r', false, $context);

        if ($stream) {
            $response = stream_get_contents($stream);
            fclose($stream);

            $data = json_decode($response, true);

            // Extracting relevant information
            $dates = [];
            $dates2 = [];
            $dates3 = [];
            $dates4 = [];
            $dates5 = [];
            foreach ($data['items'] as $event) {
                $dates[] = $event['start']['date'];
                $dates2[] = $event['start']['date'];
                $dates3[] = $event['start']['date'];
                $dates4[] = $event['start']['date'];
                $dates5[] = $event['start']['date'];
            }
        } else {
            echo "Error fetching data from the API.";
        }
        ?>

        <?php
        $tables = ["tbl_wedding_event", "tbl_funeral_service", "tbl_blessing_event", "tbl_child_dedication_events", "tbl_birthday_event"];
        $ja1id = 0;

        foreach ($tables as $table) {
            $query = "SELECT * FROM " . $table;
            $result = $conn->query($query);

            if ($result) {
                $ja1id += $result->num_rows;
                $result->close();
            } else {
                echo "Error executing query: " . $conn->error;
            }
        }

        if ($ja1id > 0) {
            $queryeventsss = "SELECT DATE(start) as start_date, DATE(end) as end_date FROM events";
            $resulteventsss =  $conn->query($queryeventsss);
            
            // Array to store disabled dates
            $disabledDateseventsss = [];
            
            // Fetch date ranges and add them to the disabledDates array
            while ($roweventsss = $resulteventsss->fetch_assoc()) {
                $startDateeventsss = strtotime($roweventsss['start_date']);
                $endDateeventsss = strtotime($roweventsss['end_date']);
            
                // Iterate through the date range and add each date to disabledDates
                while ($startDateeventsss <= $endDateeventsss) {
                    $disabledDateseventsss[] = date('Y-m-d', $startDateeventsss);
                    $startDateeventsss = strtotime('+1 day', $startDateeventsss);
                }
            }


            $query = 'SELECT DATE(Set_Appointment_Date) as date FROM `tbl_wedding_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_funeral_service` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_blessing_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_child_dedication_events` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_birthday_event` ';
            $result = $conn->query($query);

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $dates[] = $row['date'];
                }

                //echo 'disabledDates = ' . json_encode($dates) . ';';
            } else {
                echo 'Query failed: ' . $conn->error;
            }
        }
        
        // Merge the two arrays
        $mergedDates = array_merge($disabledDateseventsss, $dates);
        
        
        // Print or use the merged dates as needed
        echo 'disabledDates = ' . json_encode($mergedDates) . ';';
        ?>

        // Function to check if a date is in the disabledDates array
        function isDateDisabled(date) {
            var formattedDate = $.datepicker.formatDate('yy-mm-dd', date);
            return ($.inArray(formattedDate, disabledDates) != -1);
        }

        // Initialize the date picker
        $("#datetime").datepicker({
            beforeShowDay: function(date) {
                var dateString = $.datepicker.formatDate('yy-mm-dd', date);
                if (isDateDisabled(date)) {
                    return [false, 'disabled-date', 'Date is disabled'];
                }
                return [true, '', ''];
            },
            minDate: 0, // Set minimum date to today to disable previous dates
        });

    });

    $(function() {
        //wedding
        var disabledDates2 = [];

        <?php
        $tables = ["tbl_wedding_event", "tbl_funeral_service", "tbl_blessing_event", "tbl_child_dedication_events", "tbl_birthday_event"];
        $ja1id2 = 0;

        foreach ($tables as $table) {
            $query = "SELECT * FROM " . $table;
            $result = $conn->query($query);

            if ($result) {
                $ja1id2 += $result->num_rows;
                $result->close();
            } else {
                echo "Error executing query: " . $conn->error;
            }
        }

        if ($ja1id2 > 0) {
            $queryeventsss = "SELECT DATE(start) as start_date, DATE(end) as end_date FROM events";
            $resulteventsss =  $conn->query($queryeventsss);
            
            // Array to store disabled dates
            $disabledDateseventsss = [];
            
            // Fetch date ranges and add them to the disabledDates array
            while ($roweventsss = $resulteventsss->fetch_assoc()) {
                $startDateeventsss = strtotime($roweventsss['start_date']);
                $endDateeventsss = strtotime($roweventsss['end_date']);
            
                // Iterate through the date range and add each date to disabledDates
                while ($startDateeventsss <= $endDateeventsss) {
                    $disabledDateseventsss[] = date('Y-m-d', $startDateeventsss);
                    $startDateeventsss = strtotime('+1 day', $startDateeventsss);
                }
            }
            
            $query2 = 'SELECT DATE(Set_Appointment_Date) as date FROM `tbl_wedding_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_funeral_service` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_blessing_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_child_dedication_events` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_birthday_event`';
            $result2 = $conn->query($query2);

            if ($result2) {
                while ($row2 = $result2->fetch_assoc()) {
                    $dates2[] = $row2['date'];
                }

                //echo 'disabledDates2 = ' . json_encode($dates2) . ';';
            } else {
                echo 'Query failed: ' . $conn->error;
            }
        }
        
        // Merge the two arrays
        $mergedDates = array_merge($disabledDateseventsss, $dates);
        
        
        // Print or use the merged dates as needed
        echo 'disabledDates2 = ' . json_encode($mergedDates) . ';';
        ?>

        // Function to check if a date is in the disabledDates array
        function isDateDisabled(date2) {
            var formattedDates2 = $.datepicker.formatDate('yy-mm-dd', date2);
            return ($.inArray(formattedDates2, disabledDates2) != -1);
        }

        // Initialize the date picker
        $("#target_marry_date").datepicker({
            beforeShowDay: function(date2) {
                var dateString2 = $.datepicker.formatDate('yy-mm-dd', date2);
                if (isDateDisabled(date2)) {
                    return [false, 'disabled-date', 'Date is disabled'];
                }
                return [true, '', ''];
            },
            minDate: 0, // Set minimum date to today to disable previous dates
        });
    });

    $(function() {
        //blessig
        var disabledDates3 = [];

        <?php
        $tables = ["tbl_wedding_event", "tbl_funeral_service", "tbl_blessing_event", "tbl_child_dedication_events", "tbl_birthday_event"];
        $ja1id3 = 0;

        foreach ($tables as $table) {
            $query = "SELECT * FROM " . $table;
            $result = $conn->query($query);

            if ($result) {
                $ja1id3 += $result->num_rows;
                $result->close();
            } else {
                echo "Error executing query: " . $conn->error;
            }
        }

        if ($ja1id3 > 0) {
            $queryeventsss = "SELECT DATE(start) as start_date, DATE(end) as end_date FROM events";
            $resulteventsss =  $conn->query($queryeventsss);
            
            // Array to store disabled dates
            $disabledDateseventsss = [];
            
            // Fetch date ranges and add them to the disabledDates array
            while ($roweventsss = $resulteventsss->fetch_assoc()) {
                $startDateeventsss = strtotime($roweventsss['start_date']);
                $endDateeventsss = strtotime($roweventsss['end_date']);
            
                // Iterate through the date range and add each date to disabledDates
                while ($startDateeventsss <= $endDateeventsss) {
                    $disabledDateseventsss[] = date('Y-m-d', $startDateeventsss);
                    $startDateeventsss = strtotime('+1 day', $startDateeventsss);
                }
            }
            
            $query3 = 'SELECT DATE(Set_Appointment_Date) as date FROM `tbl_wedding_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_funeral_service` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_blessing_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_child_dedication_events` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_birthday_event`';
            $result3 = $conn->query($query3);

            if ($result3) {
                while ($row3 = $result3->fetch_assoc()) {
                    $dates3[] = $row3['date'];
                }

                //echo 'disabledDates3 = ' . json_encode($dates3) . ';';
            } else {
                echo 'Query failed: ' . $conn->error;
            }
        }
        
        // Merge the two arrays
        $mergedDates = array_merge($disabledDateseventsss, $dates);
        
        
        // Print or use the merged dates as needed
        echo 'disabledDates3 = ' . json_encode($mergedDates) . ';';
        ?>

        // Function to check if a date is in the disabledDates array
        function isDateDisabled(date3) {
            var formattedDates3 = $.datepicker.formatDate('yy-mm-dd', date3);
            return ($.inArray(formattedDates3, disabledDates3) != -1);
        }

        // Initialize the date picker
        $("#Date_Blessing").datepicker({
            beforeShowDay: function(date3) {
                var dateString3 = $.datepicker.formatDate('yy-mm-dd', date3);
                if (isDateDisabled(date3)) {
                    return [false, 'disabled-date', 'Date is disabled'];
                }
                return [true, '', ''];
            },
            minDate: 0, // Set minimum date to today to disable previous dates
        });
    });

    $(function() {
        //funerals
        var disabledDates4 = [];

        <?php
        $tables = ["tbl_wedding_event", "tbl_funeral_service", "tbl_blessing_event", "tbl_child_dedication_events", "tbl_birthday_event"];
        $ja1id4 = 0;

        foreach ($tables as $table) {
            $query = "SELECT * FROM " . $table;
            $result = $conn->query($query);

            if ($result) {
                $ja1id4 += $result->num_rows;
                $result->close();
            } else {
                echo "Error executing query: " . $conn->error;
            }
        }

        if ($ja1id4 > 0) {
            $queryeventsss = "SELECT DATE(start) as start_date, DATE(end) as end_date FROM events";
            $resulteventsss =  $conn->query($queryeventsss);
            
            // Array to store disabled dates
            $disabledDateseventsss = [];
            
            // Fetch date ranges and add them to the disabledDates array
            while ($roweventsss = $resulteventsss->fetch_assoc()) {
                $startDateeventsss = strtotime($roweventsss['start_date']);
                $endDateeventsss = strtotime($roweventsss['end_date']);
            
                // Iterate through the date range and add each date to disabledDates
                while ($startDateeventsss <= $endDateeventsss) {
                    $disabledDateseventsss[] = date('Y-m-d', $startDateeventsss);
                    $startDateeventsss = strtotime('+1 day', $startDateeventsss);
                }
            }
            
            $query4 = 'SELECT DATE(Set_Appointment_Date) as date FROM `tbl_wedding_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_funeral_service` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_blessing_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_child_dedication_events` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_birthday_event`';
            $result4 = $conn->query($query4);

            if ($result4) {
                while ($row4 = $result4->fetch_assoc()) {
                    $dates4[] = $row4['date'];
                }

                //echo 'disabledDates4 = ' . json_encode($dates4) . ';';
            } else {
                echo 'Query failed: ' . $conn->error;
            }
        }
        
        // Merge the two arrays
        $mergedDates = array_merge($disabledDateseventsss, $dates);
        
        
        // Print or use the merged dates as needed
        echo 'disabledDates4 = ' . json_encode($mergedDates) . ';';
        ?>

        // Function to check if a date is in the disabledDates array
        function isDateDisabled(date4) {
            var formattedDates4 = $.datepicker.formatDate('yy-mm-dd', date4);
            return ($.inArray(formattedDates4, disabledDates4) != -1);
        }

        // Initialize the date picker
        $("#Date_Funeral_S").datepicker({
            beforeShowDay: function(date4) {
                var dateString4 = $.datepicker.formatDate('yy-mm-dd', date4);
                if (isDateDisabled(date4)) {
                    return [false, 'disabled-date', 'Date is disabled'];
                }
                return [true, '', ''];
            },
            minDate: 0, // Set minimum date to today to disable previous dates
        });
    });

    $(function() {
        //childd
        var disabledDates5 = [];

        <?php
        $tables = ["tbl_wedding_event", "tbl_funeral_service", "tbl_blessing_event", "tbl_child_dedication_events", "tbl_birthday_event"];
        $ja1id5 = 0;

        foreach ($tables as $table) {
            $query = "SELECT * FROM " . $table;
            $result = $conn->query($query);

            if ($result) {
                $ja1id5 += $result->num_rows;
                $result->close();
            } else {
                echo "Error executing query: " . $conn->error;
            }
        }

        if ($ja1id5 > 0) {
            $queryeventsss = "SELECT DATE(start) as start_date, DATE(end) as end_date FROM events";
            $resulteventsss =  $conn->query($queryeventsss);
            
            // Array to store disabled dates
            $disabledDateseventsss = [];
            
            // Fetch date ranges and add them to the disabledDates array
            while ($roweventsss = $resulteventsss->fetch_assoc()) {
                $startDateeventsss = strtotime($roweventsss['start_date']);
                $endDateeventsss = strtotime($roweventsss['end_date']);
            
                // Iterate through the date range and add each date to disabledDates
                while ($startDateeventsss <= $endDateeventsss) {
                    $disabledDateseventsss[] = date('Y-m-d', $startDateeventsss);
                    $startDateeventsss = strtotime('+1 day', $startDateeventsss);
                }
            }
            
            $query5 = 'SELECT DATE(Set_Appointment_Date) as date FROM `tbl_wedding_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_funeral_service` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_blessing_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_child_dedication_events` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_birthday_event`';
            $result5 = $conn->query($query5);

            if ($result5) {
                while ($row5 = $result5->fetch_assoc()) {
                    $dates5[] = $row5['date'];
                }

                //echo 'disabledDates5 = ' . json_encode($dates5) . ';';
            } else {
                echo 'Query failed: ' . $conn->error;
            }
        }
        
        // Merge the two arrays
        $mergedDates = array_merge($disabledDateseventsss, $dates);
        
        
        // Print or use the merged dates as needed
        echo 'disabledDates5 = ' . json_encode($mergedDates) . ';';
        ?>

        // Function to check if a date is in the disabledDates array
        function isDateDisabled(date5) {
            var formattedDates5 = $.datepicker.formatDate('yy-mm-dd', date5);
            return ($.inArray(formattedDates5, disabledDates5) != -1);
        }

        // Initialize the date picker
        $("#Set_Dedication_Date_Want").datepicker({
            beforeShowDay: function(date5) {
                var dateString5 = $.datepicker.formatDate('yy-mm-dd', date5);
                if (isDateDisabled(date5)) {
                    return [false, 'disabled-date', 'Date is disabled'];
                }
                return [true, '', ''];
            },
            minDate: 0, // Set minimum date to today to disable previous dates
        });
    });

    var timeInput = document.getElementById("timewant");
    //var timeInput2 = document.getElementById("timewant2");
    var timeInput3 = document.getElementById("Time_Blessing");
    var timeInput4 = document.getElementById("Time_Funeral_S");
    var timeInput5 = document.getElementById("timewantDedication");

    timeInput.addEventListener("input", function() {
        var selectedTime = timeInput.value;
        var selectedHours = parseInt(selectedTime.split(":")[0]);
        var selectedMinutes = parseInt(selectedTime.split(":")[1]);

        // Check if the selected time is within the desired range (7 am to 10 pm)
        if (selectedHours < 7 || (selectedHours === 22 && selectedMinutes > 0) || selectedHours > 22) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Time',
                text: 'Please select a time between 7 am and 10 pm.',
                confirmButtonText: 'OK'
            });
            timeInput.value = "07:00"; // Set the default value to 7 am
        } else {
            // If the time is valid, set the minutes to "00"
            timeInput.value = selectedTime.split(":")[0] + ":00";
        }
    });

    /*timeInput2.addEventListener("input", function() {
        var selectedTime = timeInput2.value;
        var selectedHours = parseInt(selectedTime.split(":")[0]);
        var selectedMinutes = parseInt(selectedTime.split(":")[1]);

        // Check if the selected time is within the desired range (7 am to 10 pm)
        if (selectedHours < 7 || (selectedHours === 22 && selectedMinutes > 0) || selectedHours > 22) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Time',
                text: 'Please select a time between 7 am and 10 pm.',
                confirmButtonText: 'OK'
            });
            timeInput2.value = "07:00"; // Set the default value to 7 am
        } else {
            // If the time is valid, set the minutes to "00"
            timeInput2.value = selectedTime.split(":")[0] + ":00";
        }
    });*/

    timeInput3.addEventListener("input", function() {
        var selectedTime = timeInput3.value;
        var selectedHours = parseInt(selectedTime.split(":")[0]);
        var selectedMinutes = parseInt(selectedTime.split(":")[1]);

        // Check if the selected time is within the desired range (7 am to 10 pm)
        if (selectedHours < 7 || (selectedHours === 22 && selectedMinutes > 0) || selectedHours > 22) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Time',
                text: 'Please select a time between 7 am and 10 pm.',
                confirmButtonText: 'OK'
            });
            timeInput3.value = "07:00"; // Set the default value to 7 am
            timeInput3.value = selectedTime.split(":")[0] + ":00";
        } else {
            // If the time is valid, set the minutes to "00"
            timeInput3.value = selectedTime.split(":")[0] + ":00";
        }
    });

    timeInput4.addEventListener("input", function() {
        var selectedTime = timeInput4.value;
        var selectedHours = parseInt(selectedTime.split(":")[0]);
        var selectedMinutes = parseInt(selectedTime.split(":")[1]);

        // Check if the selected time is within the desired range (7 am to 10 pm)
        if (selectedHours < 7 || (selectedHours === 22 && selectedMinutes > 0) || selectedHours > 22) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Time',
                text: 'Please select a time between 7 am and 10 pm.',
                confirmButtonText: 'OK'
            });
            timeInput4.value = "07:00"; // Set the default value to 7 am
        } else {
            // If the time is valid, set the minutes to "00"
            timeInput4.value = selectedTime.split(":")[0] + ":00";
        }
    });
    timeInput5.addEventListener("input", function() {
        var selectedTime = timeInput5.value;
        var selectedHours = parseInt(selectedTime.split(":")[0]);
        var selectedMinutes = parseInt(selectedTime.split(":")[1]);

        // Check if the selected time is within the desired range (7 am to 10 pm)
        if (selectedHours < 7 || (selectedHours === 22 && selectedMinutes > 0) || selectedHours > 22) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Time',
                text: 'Please select a time between 7 am and 10 pm.',
                confirmButtonText: 'OK'
            });
            timeInput5.value = "07:00"; // Set the default value to 7 am
        } else {
            // If the time is valid, set the minutes to "00"
            timeInput5.value = selectedTime.split(":")[0] + ":00";
        }
    });
</script>


<script>
    function displayImg(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#cimg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function displayImg2(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#cimg2').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        const bcert = document.getElementById('cimg');
        const mcert = document.getElementById('cimg2');

        $('.BirthCert').click(function() {
            const src = bcert.getAttribute('src');
            viewer_modal(src)
        })
        $('.MarriageCert').click(function() {
            const src2 = mcert.getAttribute('src');
            viewer_modal(src2)
        })
    })
</script>




<!------------------- Insertion ----------------->
<script>
    /** Inserting into Content Class **/
    $(document).ready(function() {

        var Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000
        });

        $('#birthday_event').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Content.php?f=birthday_event",
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
                        if (resp.event_type == 'Walk-In') {
                            location.href = _base_url_ + "dashboard/?page=ja1_reservation";
                        } else if (resp.event_type == 'E-Wallet') {
                            location.href = resp.link;
                        }
                    } else {
                        alert_toast("An error occured", 'error')
                        console.log(resp);
                        end_loader();
                    }
                }
            })
        })

        $('#wedding_event').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Content.php?f=wedding_event",
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
                        location.href = _base_url_ + "dashboard/?page=ja1_reservation";
                    } else {
                        alert_toast("An error occured", 'error')
                        console.log(resp);
                        end_loader();
                    }
                }
            })
        })

        $('#child_dedication_events').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Content.php?f=child_dedication_events",
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
                        location.href = _base_url_ + "dashboard/?page=ja1_reservation";
                    } else {
                        alert_toast("An error occured", 'error')
                        console.log(resp);
                        end_loader();
                    }
                }
            })
        })

        $('#funeral_service').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Content.php?f=funeral_service",
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
                        location.href = _base_url_ + "dashboard/?page=ja1_reservation";
                    } else {
                        alert_toast("An error occured", 'error')
                        console.log(resp);
                        end_loader();
                    }
                }
            })
        })

        $('#blessing_event').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Content.php?f=blessing_event",
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
                        if (resp.event_type == 'Walk-In') {
                            location.href = _base_url_ + "dashboard/?page=ja1_reservation";
                        } else if (resp.event_type == 'E-Wallet') {
                            location.href = resp.link;
                        }
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

<script>
    $(function() {

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;

        var calendarEl = document.getElementById('calendar');

        // initialize the external events
        // -----------------------------------------------------------------

        var calendar = new Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            eventContent: function(arg) {
                var eventEl = document.createElement('div');
                var timeEl = document.createElement('b');
                timeEl.textContent = arg.timeText;
                eventEl.appendChild(timeEl);

                // Create a div for the title with max-width: 100%
                var titleDiv = document.createElement('div');
                titleDiv.style.maxWidth = '100%';
                titleDiv.style.overflowWrap = 'break-word';
                titleDiv.textContent = arg.event.title;

                // Append the title div to the event element
                eventEl.appendChild(titleDiv);

                eventEl.style.backgroundColor = arg.event.backgroundColor;
                eventEl.style.borderColor = arg.event.borderColor;
                eventEl.style.borderWidth = '0px';
                eventEl.style.color = 'white';
                eventEl.style.padding = '5px';
                eventEl.style.width = '100%';
                eventEl.style.borderRadius = '5px';

                return {
                    domNodes: [eventEl]
                };
            },
            themeSystem: 'bootstrap',
            //Random default events
            events: _base_url_ + 'dashboard/ja1_reservation/events.php',
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!

        });

        calendar.render();

    })
</script>