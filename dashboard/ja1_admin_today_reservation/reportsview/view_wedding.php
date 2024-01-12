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
                <?php if ($tdy_rsrvtn_status == 1) : ?>
                    <div class="col">
                        <p><b>Status:
                                <select class="form-control" name="status" id="status">
                                    <option value="0" <?php echo (isset($Status) && $Status == '0') ? 'selected' : '' ?>>Pending</option>
                                    <option value="1" <?php echo (isset($Status) && $Status == '1') ? 'selected' : '' ?>>Paid</option>
                                </select>
                            </b></p>

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
                            <p><b>Date and Time of Appointment: </b>
                                <input type="datetime-local" class="form-control" name="Set_Appointment_Date" id="Set_Appointment_Date" value="<?php echo isset($Set_Appointment_Date) ? date("Y-m-d\\TH:i", strtotime($Set_Appointment_Date)) : date("Y-m-d\\TH:i") ?>" required>
                            </p>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Input address here" value="<?php echo $Address ?>">
                        </div>
                        <div class="col">
                            <label for="Food_Equipment_Rent">Officiating Minister:</label>
                            <input type="text" class="form-control" name="off_minister" id="Food_Equipment_Rent" value="<?php echo $Officiating_Minister ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="price">Fees:</label><br>
                            <input type="text" class="form-control" name="price" id="price" value="<?php echo $Price ?>">
                        </div>
                        <div class="col">
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
                            <textarea class="form-control" name="ques_inqs" id="ques_inqs" cols="30" rows="5" style="width: 100%;"><?php echo $Ques_Inqs ?></textarea>
                        </div>
                    </div>

                    <input type="hidden" class="form-control" name="Groom_Name" id="Groom_Name" value="<?php echo $Groom_Name ?>">
                    <input type="hidden" class="form-control" name="Bride_Name" id="Bride_Name" value="<?php echo $Bride_Name ?>">
                    <input type="hidden" class="form-control" name="Set_Appointment_Date" id="Set_Appointment_Date" value="<?php echo isset($Set_Appointment_Date) ? date("Y-m-d\\TH:i", strtotime($Set_Appointment_Date)) : date("Y-m-d\\TH:i") ?>">
                    <input type="hidden" class="form-control" name="address" id="address" placeholder="Input address here" value="<?php echo $Address ?>">
                    <input type="hidden" class="form-control" name="status" id="status" placeholder="Input address here" value="<?php echo $Status ?>">
                    <input type="hidden" class="form-control" name="price" id="price" placeholder="Input address here" value="<?php echo $Price ?>">
                </div>
            <?php } ?>


            <div class="modal-footer">
                <button class="btn btn-primary" form="wedding_update_form">Update</button>
            </div>
        </form>

    </div>
</div>

<script>
    $(document).ready(function() {
        $('#wedding_update_form').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Content.php?f=admin_wedding_event",
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
                        location.href = _base_url_ + "dashboard/?page=ja1_admin_wedding";
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