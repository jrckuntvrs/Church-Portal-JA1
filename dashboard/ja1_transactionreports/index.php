<?php if ($_settings->chk_flashdata('success')) : ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>

<head>

    <link rel="stylesheet" href="<?php echo base_url ?>dist/customfiles/css/reports.css" />

</head>

<style>
    footer {
        display: none;
    }

    .layout-footer-fixed .wrapper .content-wrapper {
        padding-bottom: 0;
    }

    .container-fluid {
        overflow: auto;
    }
</style>

<div class="background">
    <img src="<?php echo base_url ?>dist/customfiles/images/JA1HOME.jpeg" alt="" />
</div>

<div class="contact-bg">
    <h2>Booking Details</h2>
    <div class="line">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>

<br>
<br>

<div class="card card-outline" style="border-top: 3px solid var(--pink);">
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-striped table-hover table-bordered table-compact nowrap" id="list">
                <colgroup>
                    <col width="10%">
                    <col width="10%">
                    <col width="20%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr>
                        <th>Transaction No</th>
                        <th>Transaction Date</th>
                        <th>Full Name</th>
                        <th>Booking Events</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $clientuser = ucwords($_settings->userdata('id'));

                    $qry = $conn->query("SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,Price,customer_id,CONCAT(Customer_Name) as fullname FROM `tbl_wedding_event` WHERE customer_id='$clientuser'  UNION SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,Price,customer_id,CONCAT(Full_Name) as fullname FROM `tbl_funeral_service` WHERE customer_id='$clientuser' UNION SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,Price,customer_id,CONCAT(Owner_Name) as fullname FROM `tbl_blessing_event` WHERE customer_id='$clientuser' UNION SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,Price,customer_id,CONCAT(Full_Name) as fullname FROM `tbl_child_dedication_events` WHERE customer_id='$clientuser' UNION SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,Price,customer_id,CONCAT(Full_Name) as fullname FROM `tbl_birthday_event` WHERE customer_id='$clientuser'");
                    while ($row = $qry->fetch_assoc()) :
                    ?>
                        <tr>
                            <td><b style="color: var(--pink);"><?php echo $row['Transaction_No'] ?></b></td>
                            <td class="text-center"><?php echo date("Y-m-d\\ H:i:s", strtotime($row['Transaction_Date'])) ?></td>
                            <td><b style="color: var(--pink);"><?php echo ucwords($row['fullname']) ?></b></td>
                            <td><?php echo $row['Event_Type'] ?></td>
                            <td class="text-center">
                                <?php if ($row['Status'] == 1) : ?>
                                    <span class="badge badge-success">Paid</span>
                                <?php else : ?>
                                    <span class="badge badge-danger">Pending</span>
                                <?php endif; ?>
                            </td>
                            <td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" style="z-index: 9999 !important;" role="menu">
                                    <?php if ($row['Event_Type'] !== 'Wedding Event') : ?>
                                        <?php if ($row['Status'] == 0) : ?>
                                            <?php if ($row['Status'] == 0 && $row['Price'] == 0) { ?>

                                            <?php } else if ($row['Status'] == 1 && $row['Price'] == 0) { ?>

                                            <?php } else { ?>
                                                <a href="javascript:void(0)" class="dropdown-item pay_TransactR" data-name="<?php echo $row['Transaction_No'] ?>" data-date="<?php echo $row['Transaction_Date'] ?>" data-price="<?php echo $row['Price'] ?>" data-id="<?php echo $row['id'] ?>" data-event="<?php echo $row['Event_Type'] ?>" data-role="TransactView"><span class="fa fa-money-bill-wave text-primary"></span> Pay</a>
                                                <div class="dropdown-divider"></div>
                                            <?php } ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <a href="javascript:void(0)" class="dropdown-item view_TransactR" data-name="<?php echo $row['Transaction_No'] ?>" data-date="<?php echo $row['Transaction_Date'] ?>" data-price="<?php echo $row['Price'] ?>" data-id="<?php echo $row['id'] ?>" data-event="<?php echo $row['Event_Type'] ?>" data-role="TransactView"><span class="fa fa-eye text-success"></span> View</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item edit_TransactR" href="javascript:void(0)" data-name="<?php echo $row['Transaction_No'] ?>" data-date="<?php echo $row['Transaction_Date'] ?>" data-price="<?php echo $row['Price'] ?>" data-id="<?php echo $row['id'] ?>" data-event="<?php echo $row['Event_Type'] ?>" data-role="TransactEdit"><span class="fa fa-edit text-primary"></span> Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-name="<?php echo $row['Transaction_No'] ?>" data-event="<?php echo $row['Event_Type'] ?>" data-custid="<?php echo $row['customer_id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


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

<script src="<?php echo base_url ?>dist/customfiles/user_js/home.js"></script>

<script>
    $('section').removeClass('content');
    $('div').removeClass('container-fluid');
    $('div').removeClass('content-header');
</script>

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
    $(document).ready(function() {
        $('#list').DataTable({
            responsive: true,
            order: [
                [0, 'desc']
            ],
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('.delete_data').click(function() {
            //uni_modal("", "remittance/add_denomination.php?id=" + $(this).attr('data-id'), "modal-lg")
            if ($(this).attr('data-event') == 'Birthday Event') {
                _conf("Are you sure to delete this Transaction No. <b><u>" + $(this).attr('data-name') + "</u></b> record permanently?", "delete_birthday", [$(this).attr('data-id'), $(this).attr('data-name'), $(this).attr('data-custid')])
            } else if ($(this).attr('data-event') == 'Wedding Event') {
                _conf("Are you sure to delete this Transaction No. <b><u>" + $(this).attr('data-name') + "</u></b> record permanently?", "delete_wedding", [$(this).attr('data-id'), $(this).attr('data-name'), $(this).attr('data-custid')])
            } else if ($(this).attr('data-event') == 'Blessing Event') {
                _conf("Are you sure to delete this Transaction No. <b><u>" + $(this).attr('data-name') + "</u></b> record permanently?", "delete_blessing", [$(this).attr('data-id'), $(this).attr('data-name'), $(this).attr('data-custid')])
            } else if ($(this).attr('data-event') == 'Child Dedication Event') {
                _conf("Are you sure to delete this Transaction No. <b><u>" + $(this).attr('data-name') + "</u></b> record permanently?", "delete_child_dedication", [$(this).attr('data-id'), $(this).attr('data-name'), $(this).attr('data-custid')])
            } else if ($(this).attr('data-event') == 'Funeral Service') {
                _conf("Are you sure to delete this Transaction No. <b><u>" + $(this).attr('data-name') + "</u></b> record permanently?", "delete_funeral_s", [$(this).attr('data-id'), $(this).attr('data-name'), $(this).attr('data-custid')])
            }
        })
    })

    function delete_birthday($id, $name, $custid) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Content.php?f=user_delete_birtday_record",
            method: "POST",
            data: {
                id: $id,
                name: $name,
                custid: $custid
            },
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }

    function delete_wedding($id, $name, $custid) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Content.php?f=user_delete_wedding_record",
            method: "POST",
            data: {
                id: $id,
                name: $name,
                custid: $custid
            },
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }

    function delete_blessing($id, $name, $custid) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Content.php?f=user_delete_blessing_record",
            method: "POST",
            data: {
                id: $id,
                name: $name,
                custid: $custid
            },
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }

    function delete_child_dedication($id, $name, $custid) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Content.php?f=user_delete_child_dedication_record",
            method: "POST",
            data: {
                id: $id,
                name: $name,
                custid: $custid
            },
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }

    function delete_funeral_s($id, $name, $custid) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Content.php?f=user_delete_funeral_s_record",
            method: "POST",
            data: {
                id: $id,
                name: $name,
                custid: $custid
            },
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }
</script>

<script>
    $(document).ready(function() {
        $('.view_TransactR').click(function() {
            //uni_modal("", "remittance/add_denomination.php?id=" + $(this).attr('data-id'), "modal-lg")
            if ($(this).attr('data-event') == 'Birthday Event') {
                uni_modal("Birthday Event", "ja1_transactionreports/reportsviewpay/view_report_birthday.php?id=" + $(this).attr('data-id'), "mid-large")
            } else if ($(this).attr('data-event') == 'Wedding Event') {
                uni_modal("Wedding Event", "ja1_transactionreports/reportsviewpay/view_report_wedding.php?id=" + $(this).attr('data-id'), "mid-large")
            } else if ($(this).attr('data-event') == 'Blessing Event') {
                uni_modal("Blessing Event", "ja1_transactionreports/reportsviewpay/view_report_blessing.php?id=" + $(this).attr('data-id'), "mid-large")
            } else if ($(this).attr('data-event') == 'Child Dedication Event') {
                uni_modal("Child Dedication Event", "ja1_transactionreports/reportsviewpay/view_report_child_dedication.php?id=" + $(this).attr('data-id'), "mid-large")
            } else if ($(this).attr('data-event') == 'Funeral Service') {
                uni_modal("Funeral Service", "ja1_transactionreports/reportsviewpay/view_report_funeral_S.php?id=" + $(this).attr('data-id'), "mid-large")
            }
        })

        $('.edit_TransactR').click(function() {
            //uni_modal("", "remittance/add_denomination.php?id=" + $(this).attr('data-id'), "modal-lg")
            if ($(this).attr('data-event') == 'Birthday Event') {
                uni_modal("Edit Birthday Event", "ja1_transactionreports/reportsview/view_birthday.php?id=" + $(this).attr('data-id'), "mid-large")
            } else if ($(this).attr('data-event') == 'Wedding Event') {
                uni_modal("Edit Wedding Event", "ja1_transactionreports/reportsview/view_wedding.php?id=" + $(this).attr('data-id'), "mid-large")
            } else if ($(this).attr('data-event') == 'Blessing Event') {
                uni_modal("Edit Blessing Event", "ja1_transactionreports/reportsview/view_blessing.php?id=" + $(this).attr('data-id'), "mid-large")
            } else if ($(this).attr('data-event') == 'Child Dedication Event') {
                uni_modal("Edit Child Dedication Event", "ja1_transactionreports/reportsview/view_child_dedication.php?id=" + $(this).attr('data-id'), "mid-large")
            } else if ($(this).attr('data-event') == 'Funeral Service') {
                uni_modal("Edit Funeral Service", "ja1_transactionreports/reportsview/view_funeral_S.php?id=" + $(this).attr('data-id'), "mid-large")
            }
        })
    })
</script>


<script>
    $(document).ready(function() {
        $('.pay_TransactR').click(function() {
            //uni_modal("", "remittance/add_denomination.php?id=" + $(this).attr('data-id'), "modal-lg")
            if ($(this).attr('data-event') == 'Birthday Event') {
                uni_modal("Birthday Event", "ja1_transactionreports/reportsviewpay/view_report_birthday.php?id=" + $(this).attr('data-id') + "&paynow=ewallet", "mid-large")
            } else if ($(this).attr('data-event') == 'Wedding Event') {
                uni_modal("Wedding Event", "ja1_transactionreports/reportsviewpay/view_report_wedding.php?id=" + $(this).attr('data-id'), "mid-large")
            } else if ($(this).attr('data-event') == 'Blessing Event') {
                uni_modal("Blessing Event", "ja1_transactionreports/reportsviewpay/view_report_blessing.php?id=" + $(this).attr('data-id') + "&paynow=ewallet", "mid-large")
            } else if ($(this).attr('data-event') == 'Child Dedication Event') {
                uni_modal("Child Dedication Event", "ja1_transactionreports/reportsviewpay/view_report_child_dedication.php?id=" + $(this).attr('data-id') + "&paynow=ewallet", "mid-large")
            } else if ($(this).attr('data-event') == 'Funeral Service') {
                uni_modal("Funeral Service", "ja1_transactionreports/reportsviewpay/view_report_funeral_S.php?id=" + $(this).attr('data-id') + "&paynow=ewallet", "mid-large")
            }
        })
    })
</script>