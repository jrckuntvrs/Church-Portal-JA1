<?php
require_once('../../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `tbl_wedding_event` where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}

?>

<head>
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/jquery-ui/jquery-ui.css" />
</head>

<style>
    .ja1logo {
        float: left;
        position: absolute;
        left: 100px;
        margin-top: -1px;
    }

    @media (max-width: 837px) {
        .ja1logo {
            left: 55px;
        }
    }

    .p-viewer {
        float: right;
        margin-top: -40px;
        margin-right: 20px;
        position: relative;
        z-index: 1;
    }
</style>

<div class="container-fluid">
    <div class="container">

        <div class="text-center">
            <img src="<?php echo base_url ?>dist/customfiles/images/ja1.png" class="ja1logo" alt="" style="width:70px;">
            <b>JESUS <br> THE ANOINTED <br> ONE CHURCH</b>
        </div>

        <br>
        <br>

        <form id="wedding_update_form">
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
            <input type="hidden" name="Customer_ID" value="<?php echo isset($customer_id) ? $customer_id : '' ?>">
            <input type="hidden" name="Transaction_No" value="<?php echo isset($Transaction_No) ? $Transaction_No : '' ?>">
            <div class="row">
                <div class="col">
                    <p><b>Transaction No.: </b><?php echo $Transaction_No ?></p>
                </div>
                <div class="col">
                    <p><b>Transaction Date: </b><?php echo date("Y-m-d", strtotime($Transaction_Date)) ?></p>
                </div>
                <?php if ($tdy_rsrvtn_status == 1) : ?>
                    <div class="col">
                        <p><b>Status: </b><?php echo ($Status == 1) ? "Paid" : "Pending" ?></p>
                    </div>
                <?php endif ?>
            </div>


            <?php if ($tdy_rsrvtn_status == 1) { ?>
                <div class="row">
                    <div class="col">
                        <p><b>Full Name: </b><?php echo $Customer_Name ?></p>
                    </div>
                    <div class="col">
                        <p><b>Contact No.: </b><?php echo $Contact ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <p><b>Target Date to Marry: </b><?php echo $Target_Marry_Date ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <p><b>Questions/Inquiries: </b><br><?php echo nl2br($Ques_Inqs) ?></p>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="Groom_Name">Groom Name: </label>
                            <input type="text" class="form-control" name="Groom_Name" id="Groom_Name" value="<?php echo $Groom_Name ?>">
                        </div>
                        <div class="col">
                            <label for="Bride_Name">Bride Name: </label>
                            <input type="text" class="form-control" name="Bride_Name" id="Bride_Name" value="<?php echo $Bride_Name ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Set Date of Appointment</label>
                            <input type="text" class="form-control" placeholder="" name="Set_Appointment_Date_Want" id="Set_Appointment_Date_Want" value="<?php echo isset($Set_Appointment_Date) ? date("m/d/Y", strtotime($Set_Appointment_Date)) : '' ?>" required />
                            <span class="p-viewer">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="col">
                            <label>Set Time of Appointment</label>
                            <input type="time" class="form-control" name="Set_Appointment_Time_Want" id="timewant2" value="<?php echo isset($Set_Appointment_Date) ? date("H:i", strtotime($Set_Appointment_Date)) : '' ?>" placeholder="" style="margin-top: 10px;" required />
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="Customer_Name" id="Customer_Name" value="<?php echo isset($Customer_Name) ? $Customer_Name : '' ?>">
                    <input type="hidden" class="form-control" name="Contact" id="Contact" value="<?php echo isset($Contact) ? $Contact : '' ?>">
                    <input type="hidden" class="form-control" name="target_marry_date" id="target_marry_date" value="<?php echo isset($Target_Marry_Date) ? date("Y-m-d", strtotime($Target_Marry_Date)) : '' ?>">
                    <input type="hidden" class="form-control" name="ques_inqs" id="ques_inqs" value="<?php echo isset($Ques_Inqs) ? $Ques_Inqs : '' ?>">
                </div>
            <?php } else { ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="Customer_Name">Full Name:</label>
                            <input type="text" class="form-control" name="Customer_Name" id="Customer_Name" value="<?php echo isset($Customer_Name) ? $Customer_Name : '' ?>">
                        </div>
                        <div class="col">
                            <label for="Contact">Contact No.:</label>
                            <input type="text" class="form-control" name="Contact" id="Contact" value="<?php echo isset($Contact) ? $Contact : '' ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="target_marry_date">Target Date to Marry:</label>
                            <input type="date" class="form-control" name="target_marry_date" id="target_marry_date" value="<?php echo isset($Target_Marry_Date) ? date("Y-m-d", strtotime($Target_Marry_Date)) : '' ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="ques_inqs">Questions/Inquiries:</label>
                            <textarea name="ques_inqs" id="ques_inqs" cols="30" rows="5" style="width: 100%;"><?php echo $Ques_Inqs ?></textarea>
                        </div>
                    </div>

                    <input type="hidden" class="form-control" name="Groom_Name" id="Groom_Name" value="<?php echo $Groom_Name ?>">
                    <input type="hidden" class="form-control" name="Bride_Name" id="Bride_Name" value="<?php echo $Bride_Name ?>">
                    <input type="hidden" class="form-control" placeholder="" name="Set_Appointment_Date_Want" id="Set_Appointment_Date_Want" value="<?php echo isset($Set_Appointment_Date) ? date("m/d/Y", strtotime($Set_Appointment_Date)) : '' ?>" required />
                    <input type="hidden" class="form-control" name="Set_Appointment_Time_Want" id="timewant2" value="<?php echo isset($Set_Appointment_Date) ? date("H:i", strtotime($Set_Appointment_Date)) : '' ?>" placeholder="" style="margin-top: 10px;" required />
                </div>
            <?php } ?>


            <div class="modal-footer">
                <button class="btn btn-primary" form="wedding_update_form">Update</button>
            </div>
        </form>

    </div>
</div>

<script>
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
            $query2 = 'SELECT DATE(Set_Appointment_Date) as date FROM `tbl_wedding_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_funeral_service` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_blessing_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_child_dedication_events` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_birthday_event`';
            $result2 = $conn->query($query2);

            if ($result2) {
                while ($row2 = $result2->fetch_assoc()) {
                    $dates2[] = $row2['date'];
                }

                echo 'disabledDates2 = ' . json_encode($dates2) . ';';
            } else {
                echo 'Query failed: ' . $conn->error;
            }
        }
        ?>

        // Function to check if a date is in the disabledDates array
        function isDateDisabled(date2) {
            var formattedDates2 = $.datepicker.formatDate('yy-mm-dd', date2);
            return ($.inArray(formattedDates2, disabledDates2) != -1);
        }

        // Initialize the date picker
        $("#Set_Appointment_Date_Want").datepicker({
            beforeShowDay: function(date2) {
                var dateString2 = $.datepicker.formatDate('yy-mm-dd', date2);
                if (isDateDisabled(date2)) {
                    return [false, 'disabled-date', 'Date is disabled'];
                }
                return [true, '', ''];
            },
            minDate: 0, // Set minimum date to today to disable previous dates
        });

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

    var timeInput2 = document.getElementById("timewant2");
    timeInput2.addEventListener("input", function() {
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
        }else {
            // If the time is valid, set the minutes to "00"
            timeInput2.value = selectedTime.split(":")[0] + ":00";
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#wedding_update_form').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Content.php?f=user_wedding_event",
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
                        location.href = _base_url_ + "dashboard/?page=ja1_transactionreports";
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