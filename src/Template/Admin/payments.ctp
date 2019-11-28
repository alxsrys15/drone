<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Payment Methods</h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<table class="table">
			<thead>
				<tr>
					<th>Payment Type</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($payments as $payment): ?>
				<tr>
					<td><?= $payment->name ?></td>
					<td><?= $payment->is_active ? 'ACTIVE' : 'DEACTIVATED' ?></td>
					<td>
						<?php if ($payment->is_active): ?>
							<?= $this->Html->link('DEACTIVATE', ['action' => 'paymentChangeStatus', $payment->id], ['class' => 'btn btn-danger btn-sm']) ?>
						<?php else: ?>
							<?= $this->Html->link('ACTIVATE', ['action' => 'paymentChangeStatus', $payment->id, true], ['class' => 'btn btn-success btn-sm']) ?>
						<?php endif ?>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>