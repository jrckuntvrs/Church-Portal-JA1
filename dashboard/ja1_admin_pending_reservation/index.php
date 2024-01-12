<?php if ($_settings->chk_flashdata('success')) : ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>

<div class="card">
    <div class="card-title p-2 rounded-top" style="background: #001629; color: white;">
        <h4 class="ml-2">Pending Receive Reservation List</h4>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-striped table-hover table-bordered table-compact nowrap" id="list">
                    <colgroup>
                        <col width="10%">
                        <col width="10%">
                        <col width="20%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Transaction No</th>
                            <th>Transaction Date</th>
                            <th>Full Name</th>
                            <th>Booking Events</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $clientuser = ucwords($_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname'));

                        $qry = $conn->query("SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,customer_id,CONCAT(Customer_Name) as fullname FROM `tbl_wedding_event` WHERE tdy_rsrvtn_status='0' UNION SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,customer_id,CONCAT(Full_Name) as fullname FROM `tbl_funeral_service` WHERE tdy_rsrvtn_status='0' UNION SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,customer_id,CONCAT(Owner_Name) as fullname FROM `tbl_blessing_event` WHERE tdy_rsrvtn_status='0' UNION SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,customer_id,CONCAT(Full_Name) as fullname FROM `tbl_child_dedication_events` WHERE tdy_rsrvtn_status='0' UNION SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,customer_id,CONCAT(Full_Name) as fullname FROM `tbl_birthday_event` WHERE tdy_rsrvtn_status='0'");
                        while ($row = $qry->fetch_assoc()) :
                        ?>
                            <tr>
                                <td><b style="color: var(--pink);"><?php echo $row['Transaction_No'] ?></b></td>
                                <td class="text-center"><?php echo date("Y-m-d\\ H:i:s", strtotime($row['Transaction_Date'])) ?></td>
                                <td><b style="color: var(--pink);"><?php echo ucwords($row['fullname']) ?></b></td>
                                <td><?php echo $row['Event_Type'] ?></td>
                                <td class="text-center">
                                    <?php if ($row['Status'] == 1) : ?>
                                        <span class="badge badge-success">Paid</span>
                                    <?php else : ?>
                                        <span class="badge badge-danger">Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td align="center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item view_TransactR" href="javascript:void(0)" data-name="<?php echo $row['Transaction_No'] ?>" data-date="<?php echo $row['Transaction_Date'] ?>" data-id="<?php echo $row['id'] ?>" data-event="<?php echo $row['Event_Type'] ?>" data-role="TransactEdit"><span class="fa fa-edit text-primary"></span> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_data" href="javascript:void(0)" data-name="<?php echo $row['Transaction_No'] ?>" data-event="<?php echo $row['Event_Type'] ?>" data-custid="<?php echo $row['customer_id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php if ($_settings->chk_flashdata('success')) : ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>

<script>
    $(document).ready(function() {
        $('.table').dataTable({
            responsive: true,
            order: [
                [1, 'desc']
            ]
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('.delete_data').click(function() {
            //uni_modal("", "remittance/add_denomination.php?id=" + $(this).attr('data-id'), "modal-lg")
            if ($(this).attr('data-event') == 'Birthday Event') {
                _conf("Are you sure to delete this Transaction No. <b><u>" + $(this).attr('data-name') + "</u></b> record permanently?", "delete_birthday", [$(this).attr('data-id'), $(this).attr('data-name'), $(this).attr('data-custid')])
            } else if ($(this).attr('data-event') == 'Wedding Event') {
                _conf("Are you sure to delete this Transaction No. <b><u>" + $(this).attr('data-name') + "</u></b> record permanently?", "delete_wedding", [$(this).attr('data-id'), $(this).attr('data-name'), $(this).attr('data-custid')])
            } else if ($(this).attr('data-event') == 'Blessing Event') {
                _conf("Are you sure to delete this Transaction No. <b><u>" + $(this).attr('data-name') + "</u></b> record permanently?", "delete_blessing", [$(this).attr('data-id'), $(this).attr('data-name'), $(this).attr('data-custid')])
            } else if ($(this).attr('data-event') == 'Child Dedication Event') {
                _conf("Are you sure to delete this Transaction No. <b><u>" + $(this).attr('data-name') + "</u></b> record permanently?", "delete_child_dedication", [$(this).attr('data-id'), $(this).attr('data-name'), $(this).attr('data-custid')])
            } else if ($(this).attr('data-event') == 'Funeral Service') {
                _conf("Are you sure to delete this Transaction No. <b><u>" + $(this).attr('data-name') + "</u></b> record permanently?", "delete_funeral_s", [$(this).attr('data-id'), $(this).attr('data-name'), $(this).attr('data-custid')])
            }
        })
    })

    function delete_birthday($id, $name, $custid) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Content.php?f=delete_birtday_record",
            method: "POST",
            data: {
                id: $id,
                name: $name,
                custid: $custid
            },
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }

    function delete_wedding($id, $name, $custid) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Content.php?f=delete_wedding_record",
            method: "POST",
            data: {
                id: $id,
                name: $name,
                custid: $custid
            },
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }

    function delete_blessing($id, $name, $custid) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Content.php?f=delete_blessing_record",
            method: "POST",
            data: {
                id: $id,
                name: $name,
                custid: $custid
            },
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }

    function delete_child_dedication($id, $name, $custid) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Content.php?f=delete_child_dedication_record",
            method: "POST",
            data: {
                id: $id,
                name: $name,
                custid: $custid
            },
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }

    function delete_funeral_s($id, $name, $custid) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Content.php?f=delete_funeral_s_record",
            method: "POST",
            data: {
                id: $id,
                name: $name,
                custid: $custid
            },
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }
</script>

<script>
    $(document).ready(function() {
        $('.view_TransactR').click(function() {
            //uni_modal("", "remittance/add_denomination.php?id=" + $(this).attr('data-id'), "modal-lg")
            if ($(this).attr('data-event') == 'Birthday Event') {
                uni_modal("Birthday Event", "ja1_admin_pending_reservation/reportsview/view_birthday.php?id=" + $(this).attr('data-id'), "mid-large")
            } else if ($(this).attr('data-event') == 'Wedding Event') {
                uni_modal("Wedding Event", "ja1_admin_pending_reservation/reportsview/view_wedding.php?id=" + $(this).attr('data-id'), "mid-large")
            } else if ($(this).attr('data-event') == 'Blessing Event') {
                uni_modal("Blessing Event", "ja1_admin_pending_reservation/reportsview/view_blessing.php?id=" + $(this).attr('data-id'), "mid-large")
            } else if ($(this).attr('data-event') == 'Child Dedication Event') {
                uni_modal("Child Dedication Event", "ja1_admin_pending_reservation/reportsview/view_child_dedication.php?id=" + $(this).attr('data-id'), "mid-large")
            } else if ($(this).attr('data-event') == 'Funeral Service') {
                uni_modal("Funeral Service", "ja1_admin_pending_reservation/reportsview/view_funeral_S.php?id=" + $(this).attr('data-id'), "mid-large")
            }

        })
    })
</script>