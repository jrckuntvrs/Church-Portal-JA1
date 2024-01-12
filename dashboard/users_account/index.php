<?php if ($_settings->chk_flashdata('success')) : ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif; ?>

<style>
	.img-avatar {
		width: 45px;
		height: 45px;
		object-fit: cover;
		object-position: center center;
		border-radius: 100%;
	}


	.container-fluid {
		overflow: auto;
	}
</style>
<div class="card">
	<div class="card-title p-2 rounded-top" style="background: #001629; color: white;">
		<h4 class="ml-2">Admin Profile</h4>
	</div>
	<div class="card-header">
		<div class="card-tools">
			<a href="?page=users_account/manage_user" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Create New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<div class="container-fluid">
				<table class="table table-bordered table-stripped">
					<colgroup>
						<col width="5%">
						<col width="15%">
						<col width="25%">
						<col width="20%">
						<col width="25%">
						<col width="15%">
						<col width="10%">
					</colgroup>
					<thead>
						<tr>
							<th>#</th>
							<th>Avatar</th>
							<th>Name</th>
							<th>Address</th>
							<th>Username</th>
							<th>Type</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$qry = $conn->query("SELECT *,concat(firstname,' ',lastname) as name from `users` where id != '1' and type='1' and id != '{$_settings->userdata('id')}' order by concat(firstname,' ',lastname) asc ");
						while ($row = $qry->fetch_assoc()) :
						?>
							<tr>
								<td class="text-center"><?php echo $i++; ?></td>
								<td class="text-center"><img src="<?php echo validate_image($row['avatar']) ?>" class="img-avatar img-thumbnail p-0 border-2" alt="user_avatar"></td>
								<td><b style="color: var(--pink);"><?php echo ucwords($row['name']) ?></b></td>
								<td><?php echo ucwords($row['address']) ?></td>
								<td>
									<p class="m-0 truncate-1"><b style="color: var(--pink);"><?php echo $row['username'] ?></b></p>
								</td>
								<td><?php echo ($row['type'] == 1) ? 'Administrator' : 'User' ?></td>
								<td align="center">
									<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
										Action
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<div class="dropdown-menu" role="menu">
										<a class="dropdown-item" href="?page=users_account/manage_user&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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
		$('.delete_data').click(function() {
			_conf("Are you sure to delete this User permanently?", "delete_user", [$(this).attr('data-id')])
		})
		$('.table').dataTable({
		    responsive: true,
		});
	})

	function delete_user($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Users.php?f=delete_users",
			method: "POST",
			data: {
				id: $id
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
					location.reload();
				}
			}
		})
	}
</script>