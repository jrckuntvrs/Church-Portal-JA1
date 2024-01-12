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

<style>
    .ja1logo {
        float: left;
        position: absolute;
        left: 100px;
        margin-top: -1px;
    }
</style>

<button class="btn btn-flat btn-primary" type="button" id="print"><i class="fa fa-print"></i> Print</button>

<div class="container-fluid" id="print_out">
    <div class="container">

        <div class="text-center">
            <img src="<?php echo base_url ?>dist/customfiles/images/ja1.png" class="ja1logo" alt="" style="width:70px;">
            <b>JESUS <br> THE ANNOINTED <br> ONE CHURCH</b>
        </div>

        <br>
        <br>

        <div class="row">
            <div class="col">
                <p><b>First Name: </b><?php echo $First_Name ?></p>
            </div>
            <div class="col">
                <p><b>Last Name: </b><?php echo $Last_Name ?></p>
            </div>
            <div class="col">
                <p><b>Type of Blessing: </b><?php echo $Blessing_Type ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <p><b>Date and Time of Blessing: </b><?php echo $DateTime_Blessing ?></p>
            </div>
            <div class="col">
                <p><b>Venue Location: </b><?php echo $Venue_Location ?></p>
            </div>
            <div class="col">
                <?php if ($Price == 0) { ?>
                    <p><b>Price: </b>TBA</p>
                <?php } else { ?>
                    <p><b>Price: </b><?php echo $Price ?></p>
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