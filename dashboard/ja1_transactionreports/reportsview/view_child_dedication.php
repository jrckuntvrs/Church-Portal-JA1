<?php
require_once('../../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `tbl_child_dedication_events` where id = '{$_GET['id']}' ");
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

        <form id="cd_update_form">
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
                    <!--label for="status">Status:</label>
                    <select name="status" id="status">
                        <option value="0" <?php //echo (isset($Status) && $Status == '0') ? 'selected' : '' 
                                            ?>>Pending</option>
                        <option value="1" <?php //echo (isset($Status) && $Status == '1') ? 'selected' : '' 
                                            ?>>Paid</option>
                    </select-->
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="First_Name">Full Name:</label>
                        <input type="text" class="form-control" name="First_Name" id="First_Name" value="<?php echo $Full_Name ?>">
                    </div>
                    <div class="col">
                        <label for="Contact_No">Contact Number: </label>
                        <input type="number" class="form-control" name="Contact_No" id="Contact_No" style="margin-top: 10px;" value="<?php echo $Contact_No ?>">
                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        <label for="Last_Name">Full Name of Child:</label>
                        <input type="text" class="form-control" name="Last_Name" id="Last_Name" value="<?php echo $Child_Name ?>">
                    </div>
                    <div class="col">
                        <label for="Address">Address:</label>
                        <input type="text" class="form-control" name="Address" id="Address" value="<?php echo $Address ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="Birthdate">Birthday:</label>
                        <input type="date" class="form-control" name="Birthdate" id="Birthdate" value="<?php echo date("Y-m-d", strtotime($Birthdate)) ?>">
                    </div>
                    <div class="col">
                        <label for="Birthplace">Birthplace:</label>
                        <input type="text" class="form-control" name="Birthplace" id="Birthplace" value="<?php echo $Birthplace ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="GodFather_Name">Father Name:</label>
                        <input type="text" class="form-control" name="GodFather_Name" id="GodFather_Name" value="<?php echo $GodFather_Name ?>">
                    </div>
                    <div class="col">
                        <label for="Father_Province">Native of Province:</label>
                        <input type="text" class="form-control" name="Father_Province" id="Father_Province" value="<?php echo $Native_Prov_Father ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="GodMother_Name">Mother Name:</label>
                        <input type="text" class="form-control" name="GodMother_Name" id="GodMother_Name" value="<?php echo $GodMother_Name ?>">
                    </div>
                    <div class="col">
                        <label for="Mother_Province">Native of Province:</label>
                        <input type="text" class="form-control" name="Mother_Province" id="Mother_Province" value="<?php echo $Native_Prov_Mother ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="BirthCert_Child">Birth Certificate of Child</label>
                        <br>
                        <input type="file" name="BirthCert_Child" id="BirthCert_Child" placeholder="" onchange="displayImg(this,$(this))" style="padding-top: 7px" />
                        <img src="<?php echo validate_image(isset($BirthCert_Child) ? $BirthCert_Child : '') ?>" alt="" id="cimg" class="img-fluid img-thumbnail" style="display: none;">
                        <a href="javascript:void(0)" class="BirthCert"><span class="fa fa-image text-pink"></span>View Birth Certificate</a>
                    </div>
                    <div class="col">
                        <label for="MarriageCert_Guardian">Marriage Certificate of Guardian</label>
                        <br>
                        <input type="file" name="MarriageCert_Guardian" id="MarriageCert_Guardian" placeholder="" onchange="displayImg2(this,$(this))" style="padding-top: 7px" />
                        <img src="<?php echo validate_image(isset($MarriageCert_Guardian) ? $MarriageCert_Guardian : '') ?>" alt="" id="cimg2" class="img-fluid img-thumbnail" style="display: none;">
                        <a href="javascript:void(0)" class="MarriageCert"><span class="fa fa-image text-pink"></span>View Marriage Certificate</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="witnesses">Witnesses</label>
                        <textarea class="form-control" name="name_witnesses" id="name_witnesses" cols="30" rows="10" style="width: 100%;"><?php echo ($Witnesses) ?></textarea>
                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        <label for="Venue_Location">Place of Dedication:</label>
                        <input type="text" class="form-control" name="Venue_Location" id="Venue_Location" value="<?php echo $Venue_Location ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>Set Date of Dedication</label>
                        <input type="text" class="form-control" placeholder="" name="Set_Dedication_Date_Want" id="Set_Dedication_Date_Want" value="<?php echo isset($DateTime_Event) ? date("m/d/Y", strtotime($DateTime_Event)) : '' ?>" required />
                        <span class="p-viewer">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="col">
                        <label>Set Time of Dedication</label>
                        <input type="time" class="form-control" name="Set_Dedication_Time_Want" id="timewantDedication" value="<?php echo isset($DateTime_Event) ? date("H:i", strtotime($DateTime_Event)) : '' ?>" style="margin-top: 10px;" placeholder="" required />
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

            </div>


            <div class="modal-footer">
                <button class="btn btn-primary" form="cd_update_form">Update</button>
            </div>
        </form>

    </div>
</div>

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

<script>
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
            $query5 = 'SELECT DATE(Set_Appointment_Date) as date FROM `tbl_wedding_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_funeral_service` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_blessing_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_child_dedication_events` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_birthday_event`';
            $result5 = $conn->query($query5);

            if ($result5) {
                while ($row5 = $result5->fetch_assoc()) {
                    $dates5[] = $row5['date'];
                }

                echo 'disabledDates5 = ' . json_encode($dates5) . ';';
            } else {
                echo 'Query failed: ' . $conn->error;
            }
        }
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

    var timeInput5 = document.getElementById("timewantDedication");

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
        }else {
            // If the time is valid, set the minutes to "00"
            timeInput5.value = selectedTime.split(":")[0] + ":00";
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#cd_update_form').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Content.php?f=user_child_dedication_events",
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