<div class="card">
    <div class="card-title p-2 rounded-top" style="background: #001629; color: white;">
        <h4 class="ml-2">Booking Details</h4>
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
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Transaction No</th>
                            <th>Transaction Date</th>
                            <th>Full Name</th>
                            <th>Booking Events</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $clientuser = ucwords($_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname'));

                        $qry = $conn->query("SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,Price,customer_id,CONCAT(Customer_Name) as fullname FROM `tbl_wedding_event`  UNION SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,Price,customer_id,CONCAT(Full_Name) as fullname FROM `tbl_funeral_service` UNION SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,Price,customer_id,CONCAT(Owner_Name) as fullname FROM `tbl_blessing_event` UNION SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,Price,customer_id,CONCAT(Full_Name) as fullname FROM `tbl_child_dedication_events` UNION SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,Price,customer_id,CONCAT(Full_Name) as fullname FROM `tbl_birthday_event`");
                        while ($row = $qry->fetch_assoc()) :
                        ?>
                            <tr>
                                <td><b><a href="javascript:void(0)" class="view_TransactR" data-name="<?php echo $row['Transaction_No'] ?>" data-date="<?php echo $row['Transaction_Date'] ?>" data-id="<?php echo $row['id'] ?>" data-event="<?php echo $row['Event_Type'] ?>" data-role="TransactView"><?php echo $row['Transaction_No'] ?></b></td>
                                <td class="text-center"><?php echo date("Y-m-d\\ H:i:s", strtotime($row['Transaction_Date'])) ?></td>
                                <td><b><a href="javascript:void(0)" class="view_TransactR" data-name="<?php echo $row['Transaction_No'] ?>" data-date="<?php echo $row['Transaction_Date'] ?>" data-id="<?php echo $row['id'] ?>" data-event="<?php echo $row['Event_Type'] ?>" data-role="TransactView"><?php echo ucwords($row['fullname']) ?></b></td>
                                <td><?php echo $row['Event_Type'] ?></td>
                                <td class="text-center">
                                    <?php if ($row['Status'] == 1) : ?>
                                        <span class="badge badge-success">Paid</span>
                                    <?php else : ?>
                                        <span class="badge badge-danger">Pending</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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
        $('.view_TransactR').click(function() {
            //uni_modal("", "remittance/add_denomination.php?id=" + $(this).attr('data-id'), "modal-lg")
            if ($(this).attr('data-event') == 'Birthday Event') {
                uni_modal("Birthday Event", "ja1_admin_transactionreports/reportsview/view_report_birthday.php?id=" + $(this).attr('data-id'), "mid-large")
            } else if ($(this).attr('data-event') == 'Wedding Event') {
                uni_modal("Wedding Event", "ja1_admin_transactionreports/reportsview/view_report_wedding.php?id=" + $(this).attr('data-id'), "mid-large")
            } else if ($(this).attr('data-event') == 'Blessing Event') {
                uni_modal("Blessing Event", "ja1_admin_transactionreports/reportsview/view_report_blessing.php?id=" + $(this).attr('data-id'), "mid-large")
            } else if ($(this).attr('data-event') == 'Child Dedication Event') {
                uni_modal("Child Dedication Event", "ja1_admin_transactionreports/reportsview/view_report_child_dedication.php?id=" + $(this).attr('data-id'), "mid-large")
            } else if ($(this).attr('data-event') == 'Funeral Service') {
                uni_modal("Funeral Service", "ja1_admin_transactionreports/reportsview/view_report_funeral_S.php?id=" + $(this).attr('data-id'), "mid-large")
            }

        })
    })
</script>