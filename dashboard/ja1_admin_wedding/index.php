<?php if ($_settings->chk_flashdata('success')) : ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>

<div class="card">
    <div class="card-title p-2 rounded-top" style="background: #001629; color: white;">
        <h4 class="ml-2">Wedding Events</h4>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-bordered table-stripped">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="15%">
                        <col width="20%">
                        <col width="15%">
                        <col width="15%">
                        <col width="5%">
                        <col width="5%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Transaction No.</th>
                            <th>Transaction Date</th>
                            <th>Full Name</th>
                            <th>Address</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $qry = $conn->query("SELECT *,concat(Customer_Name) as fullname from `tbl_wedding_event` order by Transaction_Date desc ");
                        while ($row = $qry->fetch_assoc()) :
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td class="text-center"><b style="color: var(--pink);"><?php echo $row['Transaction_No'] ?></b></td>
                                <td><?php echo ucwords($row['Transaction_Date']) ?></td>
                                <td><b style="color: var(--pink);"><?php echo $row['fullname'] ?></b></td>
                                <td>
                                    <?php if ($row['Address'] == null) { ?>
                                        <b>To Be Announce</b>
                                    <?php } else { ?>
                                        <?php echo $row['Address'] ?>
                                    <?php } ?>
                                </td>
                                <td>
                                    <div class="col">
                                        <?php if ($row['Price'] == 0) { ?>
                                            <b class="text-danger">Set an Amount/Price</b>
                                        <?php } else { ?>
                                            <?php echo $row['Price'] ?>
                                        <?php } ?>
                                    </div>
                                </td>
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

<script>
    $(document).ready(function() {
        $('.table').dataTable({
		    responsive: true,
		});
    })
</script>

<script>
    $(document).ready(function() {
        $('.delete_data').click(function() {

            _conf("Are you sure to delete this Transaction No. <b><u>" + $(this).attr('data-name') + "</u></b> record permanently?", "delete_wedding", [$(this).attr('data-id'), $(this).attr('data-name'), $(this).attr('data-custid')])

        })
    })

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
</script>

<script>
    $(document).ready(function() {
        $('.view_TransactR').click(function() {

            uni_modal("Wedding Event", "ja1_admin_wedding/view_wedding.php?id=" + $(this).attr('data-id'), "mid-large")

        })
    })
</script>