<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Reports</h1>
</div>
<?= $this->Form->create() ?>
<div class="form-row">
	<div class="col-sm-4 form-group">
		<label for="start-date">Start Date</label>
		<input type="text" name="start_date" class="form-control datepicker" id="start-date" autocomplete="off">
	</div>
	<div class="col-sm-4 form-group">
		<label for="start-date">End Date</label>
		<input type="text" name="end_date" class="form-control datepicker" id="end-date" autocomplete="off">
	</div>
</div>
<div class="form-row">
	<div class="col-sm-4 form-group">
		<?= $this->Form->button('Generate', ['class' => 'btn btn-primary', 'type' => 'submit']) ?>
	</div>
</div>
<div class="row" style="display: <?= isset($export_data) ? 'block' : 'none' ?>;" id="report-table">
	<div class="col-xl-12 col-lg-12" id="to-print">
		<table class="table">
			<thead>
				<th>Customer</th>
				<th>Total</th>
				<th>Shipping Address</th>
				<th>Payment Type</th>
				<th>Date</th>
				<th>Status</th>
			</thead>
			<tbody>
				<?php if (isset($export_data) && count($export_data) > 0): ?>
					<?php foreach ($export_data as $d): ?>
					<tr>
						<td><?= $d['customer'] ?></td>
						<td><?= 'P ' . $d['total'] ?></td>
						<td>
							<?= $d['shipping_address'] ?>
								
						</td>
						<td><?= $d['payment_type'] ?></td>
						<td><?= $d['date']->setTimezone('Asia/Manila') ?></td>
						<td><?= $d['status'] ?></td>
					</tr>
					<?php endforeach ?>
				<?php endif ?>
			</tbody>
		</table>
	</div>
	<div class="col-xl-4 col-lg-4">
		<button class="btn btn-primary btn-print">Print/Export as PDF</button>
	</div>
</div>
<?= $this->Form->end() ?>
<script type="text/javascript">
	$(document).ready(function () {
		$('.datepicker').datepicker();
		$('.btn-print').on('click', function () {
			var markUp = $('#to-print').html();
			$('.print').html(markUp);
			window.print();
		});
	});
</script>