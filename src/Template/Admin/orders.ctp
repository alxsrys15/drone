<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Orders</h1>
	<!-- <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-target="#users_add_modal" data-toggle="modal"><i class="fas fa-plus fa-sm text-white-50"></i> Add Admin User</button> -->
</div>
<div class="form-row">
	<div class="col-sm-4 form-group">
		<?= $this->Form->create() ?>
			<div class="input-group mb-3">
				<input type="text" name="search" placeholder="search" class="form-control" value="<?=  isset($this->request->data['search']) ? $this->request->data['search'] : '' ?>">
				<div class="input-group-append">
					<button class="btn btn-primary" type="submit">
						<i class="fas fa-search text-gray" aria-hidden="true"></i>
    				</button>
				</div>
			</div>
		<?= $this->Form->end() ?>
	</div>
</div>
<div class="row">
	<div class="col-xl-12 col-lg-12">
		<table class="table">
			<thead>
				<th>Customer</th>
				<th>Total</th>
				<th>Shipping Address</th>
				<th>Payment Type</th>
				<th>Date</th>
				<th>Status</th>
				<th>Actions</th>
			</thead>
			<tbody>
				<?php foreach ($orders as $order): ?>
				<tr>
					<td><?= $order->user->first_name . ' ' . $order->user->last_name ?></td>
					<td><?= 'P ' . $order->total ?></td>
					<td>
						<?= $branch->street_address . ' ' . $branch->barangay . ' ' . $branch->city . ' ' . $branch->province ?>
							
					</td>
					<td><?= $order->payment_type ?></td>
					<td><?= $order->created->setTimezone('Asia/Manila') ?></td>
					<td><?= $order->lib_status_code->name ?></td>
					<td>
						<?php 
							switch ($order->lib_status_code_id) {
								case 1:
									echo $this->Html->link('<i class="fa fa-check" aria-hidden="true"></i> Paid',['controller' => 'admin', 'action' => 'updateOrderStatus', $order->id, 2] ,['class' => 'btn btn-primary btn-sm btn-update', 'escape' => false]);
									break;
								case 2:
									echo $this->Html->link('<i class="fa fa-check" aria-hidden="true"></i> Shipped',['controller' => 'admin', 'action' => 'updateOrderStatus', $order->id, 3] ,['class' => 'btn btn-primary btn-sm btn-update', 'escape' => false]);
									break;
								case 3:
									echo $this->Html->link('<i class="fa fa-check" aria-hidden="true"></i> Complete',['controller' => 'admin', 'action' => 'updateOrderStatus', $order->id, 4] ,['class' => 'btn btn-success btn-sm btn-update', 'escape' => false]);
									break;
								default:
									break;
							}
						 ?>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
		    cancelButton: 'btn btn-danger'
		},
		  	buttonsStyling: false
		});
	$(document).ready(function () {
		$(document).on('click', '.btn-update', function (e) {
			e.preventDefault();
			swalWithBootstrapButtons.fire({
				title: 'Are you sure?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Yes',
				cancelButtonText: 'No',
				reverseButtons: true
			}).then((result) => {
				if (result.value) {
					window.location.href = $(this).attr('href');
				}
			});
		});
	})
</script>