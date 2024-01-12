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
                    <label for="status">Status:</label>
                    <select class="form-control" name="status" id="status">
                        <option value="0" <?php echo (isset($Status) && $Status == '0') ? 'selected' : ''
                                            ?>>Pending</option>
                        <option value="1" <?php echo (isset($Status) && $Status == '1') ? 'selected' : ''
                                            ?>>Paid</option>
                    </select>
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
                        <label for="DateTime_Death">Date and Time of Service: </label>
                        <input type="datetime-local" class="form-control" name="DateTime_Death" id="DateTime_Death" value="<?php echo isset($DateTime_Event) ? date("Y-m-d\\TH:i", strtotime($DateTime_Event)) : date("Y-m-d\\TH:i") ?>" required>
                    </div>
                    <div class="col">
                        <label for="Venue_Location">Burial Location: </label>
                        <input type="text" class="form-control" name="Venue_Location" id="Venue_Location" value="<?php echo $Venue_Location ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="Food_Equipment_Rent">Officiating Minister:</label>
                        <input type="text" class="form-control" name="off_minister" id="Food_Equipment_Rent" value="<?php echo $Officiating_Minister ?>">
                    </div>
                    <div class="col">
                        <label for="price">Fees:</label><br>
                        <input type="text" class="form-control" name="price" id="price" value="<?php echo $Price ?>">
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
    $(document).ready(function() {
        $('#fs_update_form').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Content.php?f=admin_funeral_service",
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
                        location.href = _base_url_ + "dashboard/?page=ja1_admin_funeral_s";
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