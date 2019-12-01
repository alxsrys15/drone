<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Payments</h1>
</div>
<ul class="nav nav-tabs" id="myTab" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="true">Payment Methods</a>
	</li>
	<li class="nav-item">
	    <a class="nav-link" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab" aria-controls="shipping" aria-selected="false">Shipping Fee</a>
	</li>
</ul>
<div class="tab-content">
	<div class="tab-pane fade show active" id="payment" role="tabpanel" aria-labelledby="payment-tab">
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
	</div>
	<div class="tab-pane fade" id="shipping" aria-labelledby="shipping-tab">
		<?= $this->Form->create() ?>
		<div class="form-row">
			<div class="form-group col-sm-4">
				<label for="shipping-fee">Shipping Fee</label>
				<input type="number" name="shipping_fee" class="form-control" value="<?= $shipping->shipping_fee ?>" id="shipping-fee">
				<input type="hidden" name="id" value="<?= $shipping->id ?>">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-sm-4">
				<?= $this->Form->button('Update', ['type' => 'submit', 'class' => 'btn btn-primary']) ?>
			</div>
		</div>
		<?= $this->Form->end() ?>
	</div>
</div>

