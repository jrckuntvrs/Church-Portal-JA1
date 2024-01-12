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


$paynow =  $_GET['paynow'] ?? '';
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

<button class="btn btn-flat btn-primary" type="button" id="print"><i class="fa fa-print"></i> Print</button>

<div class="container-fluid" id="print_out">
    <div class="container">

        <div class="text-center">
            <img src="<?php echo base_url ?>dist/customfiles/images/ja1.png" class="ja1logo" alt="" style="width:70px;">
            <b>JESUS <br> THE ANOINTED <br> ONE CHURCH</b>
        </div>

        <br>
        <br>

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
        <div class="row">
            <div class="col">
                <p><b>Full Name: </b><?php echo $Full_Name ?></p>
            </div>
            <div class="col">
                <p><b>Contact No: </b><?php echo $Contact_No ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <p><b>Full Name of Child: </b><?php echo $Child_Name ?></p>
            </div>
            <div class="col">
                <p><b>Address: </b><?php echo $Address ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <p><b>Birthday: </b><?php echo $Birthdate ?></p>
            </div>
            <div class="col">
                <p><b>Birthplace: </b><?php echo $Birthplace ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <p><b>Father Name: </b><?php echo $GodFather_Name ?></p>
            </div>
            <div class="col">
                <p><b>Native Province: </b><?php echo $Native_Prov_Father ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <p><b>Mother Name: </b><?php echo $GodMother_Name ?></p>
            </div>
            <div class="col">
                <p><b>Native Province: </b><?php echo $Native_Prov_Mother ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <p><b>Witnesses: </b><br><?php echo nl2br($Witnesses) ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <p><b>Place of Dedication: </b><?php echo $Venue_Location ?></p>
            </div>
            <div class="col">
                <p><b>Date and Time of Event: </b><?php echo $DateTime_Event ?></p>
            </div>
            <div class="col">
                <?php if ($Gender == 'Male') { ?>
                    <p><b>Gender: </b>Male</p>
                <?php } else if ($Gender == 'Female') { ?>
                    <p><b>Gender: </b>Female</p>
                <?php } else { ?>
                    <p><b>Gender: </b>Prefer not to say</p>
                <?php } ?>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <?php if ($Officiating_Minister == '') { ?>
                    <p><b>Officiating Minister: </b>TBA</p>
                <?php } else { ?>
                    <p><b>Officiating Minister: </b><?php echo $Officiating_Minister ?></p>
                <?php } ?>
            </div>
            <div class="col">
                <?php if ($Price == 0) { ?>
                    <p><b>Fees: </b>TBA</p>
                <?php } else { ?>
                    <p><b>Fees: </b><?php echo $Price ?></p>
                <?php } ?>
            </div>
        </div>

    </div>
    <script>
        var paceElement = document.querySelector('.pace');
        if (paceElement) {
            paceElement.parentNode.removeChild(paceElement);
        }
    </script>
</div>

<?php if ($paynow == 'ewallet') : ?>
    <form id="cd_event">
        <?php if ($Status == 0) : ?>
            <footer class="modal-footer">
                <?php if ($Status == 0 && $Price == 0) { ?>

                <?php } else if ($Status == 1 && $Price == 0) { ?>

                <?php } else { ?>
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                    <input type="hidden" name="price" value="<?php echo isset($Price) ? $Price : '' ?>">
                    <input type="hidden" name="Transaction_No" value="<?php echo isset($Transaction_No) ? $Transaction_No : '' ?>">
                    <input type="hidden" name="payment_type" value="E-Wallet">
                    <button class="btn btn-primary" form="cd_event" data-id="<?php echo $id ?>">Pay</button>
                <?php } ?>
            </footer>
        <?php endif ?>
    </form>
<?php endif ?>


<script>
    $(document).ready(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000
        });

        $('#cd_event').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Content.php?f=pay_child_dedication_event",
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
    $(document).ready(function() {
        $('#print').click(function() {
            start_loader()
            var _h = $('head').clone()
            var _p = $('#print_out').clone();
            var _el = $('<div> <br> <br> <br> <br>')
            _el.append(_h)
            _el.append('<style>html, body, .wrapper {-webkit-print-color-adjust: exact;-webkit-filter:opacity(1);min-height: unset !important;} .ja1logo{ float: left; position:absolute; left: 350px; margin-top: -1px; }</style>')
            _el.append(_p)
            var nw = window.open("", "_blank", "width=1200,height=1200")
            nw.document.write(_el.html())
            nw.document.close()
            setTimeout(() => {
                nw.print()
                setTimeout(() => {
                    nw.close()
                    end_loader()
                }, 300);
            }, 500);
        })
    })
</script>