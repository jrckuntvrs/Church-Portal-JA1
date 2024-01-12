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
            <?php if ($tdy_rsrvtn_status == 1) : ?>
                <div class="col">
                    <p><b>Status: </b><?php echo ($Status == 1) ? "Paid" : "Pending" ?></p>
                </div>
            <?php endif ?>
        </div>

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

        <?php if ($tdy_rsrvtn_status == 1) : ?>
            <div class="row">
                <div class="col">
                    <?php if ($Groom_Name == null) { ?>
                        <p><b>Groom Name: </b>To Be Announce</p>
                    <?php } else { ?>
                        <p><b>Groom Name: </b><?php echo $Groom_Name ?></p>
                    <?php } ?>
                </div>
                <div class="col">
                    <?php if ($Bride_Name == null) { ?>
                        <p><b>Bride Name: </b>To Be Announce</p>
                    <?php } else { ?>
                        <p><b>Bride Name: </b><?php echo $Bride_Name ?></p>
                    <?php } ?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php if ($Set_Appointment_Date == null) { ?>
                        <p><b>Date and Time of Appointment: </b>To Be Announce</p>
                    <?php } else { ?>
                        <p><b>Date and Time of Appointment: </b><?php echo $Set_Appointment_Date ?></p>
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
            </div>

            <div class="row">
                <div class="col">
                    <?php if ($Address == null) { ?>
                        <p><b>Address: </b>To Be Announce</p>
                    <?php } else { ?>
                        <p><b>Address: </b><?php echo $Address ?></p>
                    <?php } ?>
                </div>

                <div class="col">
                    <?php if ($Price == 0) { ?>
                        <p><b>Fees: </b>To Be Announce</p>
                    <?php } else { ?>
                        <p><b>Fees: </b><?php echo $Price ?></p>
                    <?php } ?>
                </div>
            </div>
        <?php endif ?>
    </div>
    <script>
        var paceElement = document.querySelector('.pace');
        if (paceElement) {
            paceElement.parentNode.removeChild(paceElement);
        }
    </script>
</div>


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