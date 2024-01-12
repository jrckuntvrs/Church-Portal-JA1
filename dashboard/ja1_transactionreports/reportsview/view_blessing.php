<?php
require_once('../../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `tbl_blessing_event` where id = '{$_GET['id']}' ");
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
            <b>JESUS <br> THE ANNOINTED <br> ONE CHURCH</b>
        </div>

        <br>
        <br>

        <form id="blessing_update_form">
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
            <input type="hidden" name="Customer_Name" value="<?php echo isset($Customer_Name) ? $Customer_Name : '' ?>">
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
                        <label for="First_Name">Owner Name: </label>
                        <input type="text" class="form-control" name="Owner_Name" id="First_Name" value="<?php echo $Owner_Name ?>">
                    </div>
                    <div class="col">
                        <label for="Contact_No">Contact Number: </label>
                        <input type="number" class="form-control" name="Contact_No" id="Contact_No" value="<?php echo $Contact_No ?>" style="margin-top: 10px;">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="Blessing_Type">Type of Blessing</label>
                        <select class="form-control" name="Blessing_Type" id="Blessing_Type" style="width: 90%;">
                            <option hidden>Blessings</option>
                            <option value="House" <?php echo (isset($Blessing_Type) && $Blessing_Type == 'House') ? 'selected' : '' ?>>House</option>
                            <option value="Business" <?php echo (isset($Blessing_Type) && $Blessing_Type == 'Business') ? 'selected' : '' ?>>Business</option>
                            <option value="Exhibit" <?php echo (isset($Blessing_Type) && $Blessing_Type == 'Exhibit') ? 'selected' : '' ?>>Exhibit</option>
                            <option value="Vehicles" <?php echo (isset($Blessing_Type) && $Blessing_Type == 'Vehicles') ? 'selected' : '' ?>>Vehicles</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>Service Date</label>
                        <input type="text" class="form-control" placeholder="" name="Date_Blessing" id="Date_Blessing" value="<?php echo isset($DateTime_Blessing) ? date("m/d/Y",strtotime($DateTime_Blessing)) : '' ?>" required />
                        <span class="p-viewer">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="col">
                        <label>Service Time</label>
                        <input type="time" class="form-control" name="Time_Blessing" id="Time_Blessing" placeholder="" style="margin-top: 10px;" value="<?php echo isset($DateTime_Blessing) ? date("H:i",strtotime($DateTime_Blessing)) : '' ?>" required />
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="Venue_Location">Venue Location</label><br>
                        <input type="text" class="form-control" name="Venue_Location" id="Venue_Location" value="<?php echo $Venue_Location ?>">
                    </div>
                    <div class="col">

                    </div>
                </div>

            </div>


            <div class="modal-footer">
                <button class="btn btn-primary" form="blessing_update_form">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
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
            $query3 = 'SELECT DATE(Set_Appointment_Date) as date FROM `tbl_wedding_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_funeral_service` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_blessing_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_child_dedication_events` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_birthday_event`';
            $result3 = $conn->query($query3);

            if ($result3) {
                while ($row3 = $result3->fetch_assoc()) {
                    $dates3[] = $row3['date'];
                }

                echo 'disabledDates3 = ' . json_encode($dates3) . ';';
            } else {
                echo 'Query failed: ' . $conn->error;
            }
        }
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

    var timeInput3 = document.getElementById("Time_Blessing");

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
        }else {
            // If the time is valid, set the minutes to "00"
            timeInput3.value = selectedTime.split(":")[0] + ":00";
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#blessing_update_form').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Content.php?f=user_blessing_event",
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