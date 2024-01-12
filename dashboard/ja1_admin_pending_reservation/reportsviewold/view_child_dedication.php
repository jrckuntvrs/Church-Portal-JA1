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
                        <label for="First_Name">First Name:</label>
                        <input type="text" class="form-control" name="First_Name" id="First_Name" value="<?php echo $First_Name ?>">
                    </div>
                    <div class="col">
                        <label for="Last_Name">Last Name:</label>
                        <input type="text" class="form-control" name="Last_Name" id="Last_Name" value="<?php echo $Last_Name ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="Contact_No">Contact Number: </label>
                        <input type="number" class="form-control" name="Contact_No" id="Contact_No" value="<?php echo $Contact_No ?>">
                    </div>
                    <div class="col">
                        <label for="GodFather_Name">GodFather Name:</label>
                        <input type="text" class="form-control" name="GodFather_Name" id="GodFather_Name" value="<?php echo $GodFather_Name ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="GodMother_Name">GodMother Name:</label>
                        <input type="text" class="form-control" name="GodMother_Name" id="GodMother_Name" value="<?php echo $GodMother_Name ?>">
                    </div>
                    <div class="col">
                        <label for="Venue_Location">Venue Location:</label>
                        <input type="text" class="form-control" name="Venue_Location" id="Venue_Location" value="<?php echo $Venue_Location ?>">
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
                        <label for="BirthCert_Child">Birth Certificate of Child</label>
                        <br>
                        <input type="file" name="BirthCert_Child" id="BirthCert_Child" placeholder="" onchange="displayImg(this,$(this))" style="padding-top: 7px; display: none;" />
                        <img src="<?php echo validate_image(isset($BirthCert_Child) ? $BirthCert_Child : '') ?>" alt="" id="cimg" class="img-fluid img-thumbnail" style="display: none;">
                        <a href="javascript:void(0)" class="BirthCert"><span class="fa fa-image text-pink"></span>View Birth Certificate</a>
                    </div>
                    <div class="col">
                        <label for="MarriageCert_Guardian">Marriage Certificate of Guardian</label>
                        <br>
                        <input type="file" name="MarriageCert_Guardian" id="MarriageCert_Guardian" placeholder="" onchange="displayImg2(this,$(this))" style="padding-top: 7px; display: none;" />
                        <img src="<?php echo validate_image(isset($MarriageCert_Guardian) ? $MarriageCert_Guardian : '') ?>" alt="" id="cimg2" class="img-fluid img-thumbnail" style="display: none;">
                        <a href="javascript:void(0)" class="MarriageCert"><span class="fa fa-image text-pink"></span>View Marriage Certificate</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="Set_Event_Date">Date and Time of Event:</label>
                        <input type="datetime-local" class="form-control" name="Set_Event_Date" id="Set_Event_Date" value="<?php echo isset($DateTime_Event) ? date("Y-m-d\\TH:i", strtotime($DateTime_Event)) : date("Y-m-d\\TH:i") ?>" required>
                    </div>
                    <div class="col">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" name="price" id="price" value="<?php echo $Price ?>">
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
    $(document).ready(function() {
        $('#cd_update_form').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Content.php?f=admin_child_dedication_events",
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
                        location.href = _base_url_ + "dashboard/?page=ja1_admin_pending_reservation";
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