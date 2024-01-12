<?php
require_once('../../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `tbl_funeral_service` where id = '{$_GET['id']}' ");
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
        cursor: pointer;
    }
</style>

<div class="container-fluid">
    <div class="container">

        <div class="text-center">
            <img src="<?php echo base_url ?>dist/customfiles/images/ja1.png" class="ja1logo" alt="" style="width:70px;">
            <b>JESUS <br> THE ANNOINTED <br> ONE CHURCH</b>
        </div>

        <br>

        <form id="fs_update_form">
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
            <input type="hidden" name="Customer_Name" value="<?php echo isset($customer_id) ? $customer_id : '' ?>">
            <input type="hidden" name="Customer_ID" value="<?php echo isset($customer_id) ? $customer_id : '' ?>">
            <input type="hidden" name="Transaction_No" value="<?php echo isset($Transaction_No) ? $Transaction_No : '' ?>">

            <div class="row">
                <div class="col">
                    <p><b>Transaction No.: </b><?php echo $Transaction_No ?></p>
                </div>
                <div class="col">
                    <p><b>Transaction Date: </b><?php echo date("Y-m-d", strtotime($Transaction_Date)) ?></p>
                </div>
                <div class="col">
                    <p><b>Status: </b><?php echo ($Status == 1) ? "Paid" : "Pending" ?></p>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="First_Name">Full Name: </label>
                        <input type="text" class="form-control" name="First_Name" id="First_Name" value="<?php echo $Full_Name ?>">
                    </div>
                    <div class="col">
                        <label for="Contact_No">Contact No.: </label>
                        <input type="text" class="form-control" name="Contact_No" id="Contact_No" value="<?php echo $Contact_No ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="Last_Name">Name of Deceased: </label>
                        <input type="text" class="form-control" name="Last_Name" id="Last_Name" value="<?php echo $Deceased_Name ?>">
                    </div>
                    <div class="col">
                        <label for="Cause_Death">Cause Death: </label>
                        <input type="text" class="form-control" name="Cause_Death" id="Cause_Death" value="<?php echo $Cause_Death ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>Gender:</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="radio" id="male" name="gender" value="Male" <?php if ($Gender === 'Male') echo 'checked'; ?> />
                        <label for="male">Male</label>
                    </div>
                    <div class="col">
                        <input type="radio" id="female" name="gender" value="Female" <?php if ($Gender === 'Female') echo 'checked'; ?> />
                        <label for="female">Female</label>
                    </div>
                    <div class="col">
                        <input type="radio" id="other" name="gender" value="N/A" <?php if ($Gender === 'N/A') echo 'checked'; ?> />
                        <label for="other">Prefer not to say</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>Funeral Date</label>
                        <input type="text" placeholder="" class="form-control" name="Date_Funeral_S" id="Date_Funeral_S" value="<?php echo isset($DateTime_Event) ? date("m/d/Y", strtotime($DateTime_Event)) : '' ?>" required />
                        <span class="p-viewer">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="col">
                        <label>Funeral Time</label>
                        <input type="time" class="form-control" name="Time_Funeral_S" id="Time_Funeral_S"  value="<?php echo isset($DateTime_Event) ? date("H:i", strtotime($DateTime_Event)) : '' ?>" style="margin-top: 10px;" placeholder="" required />
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="Address1">Burial Location: </label>
                        <input type="text" class="form-control" name="Venue_Location" id="Venue_Location" value="<?php echo $Venue_Location ?>">
                    </div>
                </div>

                

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" form="fs_update_form">Update</button>
            </div>
        </form>

    </div>
</div>


<script>
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
            $query4 = 'SELECT DATE(Set_Appointment_Date) as date FROM `tbl_wedding_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_funeral_service` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_blessing_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_child_dedication_events` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_birthday_event`';
            $result4 = $conn->query($query4);

            if ($result4) {
                while ($row4 = $result4->fetch_assoc()) {
                    $dates4[] = $row4['date'];
                }

                echo 'disabledDates4 = ' . json_encode($dates4) . ';';
            } else {
                echo 'Query failed: ' . $conn->error;
            }
        }
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

    var timeInput4 = document.getElementById("Time_Funeral_S");
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
        }else {
            // If the time is valid, set the minutes to "00"
            timeInput4.value = selectedTime.split(":")[0] + ":00";
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#fs_update_form').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Content.php?f=user_funeral_service",
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