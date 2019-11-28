<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Branches</h1>
	<button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-target="#branch_add_modal" data-toggle="modal"><i class="fas fa-plus fa-sm text-white-50"></i> Add Branch</button>
</div>
<div class="form-row">
	<div class="col-sm-4 form-group">
		<?= $this->Form->create() ?>
			<div class="input-group mb-3">
				<input type="text" name="search" placeholder="search" class="form-control">
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
	<div class="col-sm-12">
		<table class="table">
			<thead>
				<th>Name</th>
				<th>Contact Person</th>
				<th>Contact Number</th>
				<th>Address</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php foreach ($branches as $branch): ?>
				<tr>
					<td><?= $branch->name ?></td>
					<td><?= $branch->contact_person ?></td>
					<td><?= $branch->contact_no ?></td>
					<td>
						<?= $branch->street_address . ' ' . $branch->barangay . ' ' . $branch->city . ' ' . $branch->province ?>
							
					</td>
					<td>
						<?= $this->Html->link('New Transaction', ['action' => 'branchTransaction', $branch->id], ['class' => 'btn btn-success btn-sm']) ?>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="branch_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Branch</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= $this->Form->create(null, ['url' => ['action' => 'branchAdd']]) ?>
			<div class="modal-body">
				<div class="form-row">
					<div class="col-sm-12 form-group">
						<label for="name">Branch Name</label>
						<input type="text" name="name" class="form-control" required>
					</div>
					<div class="col-sm-6 form-group">
						<label for="contact-person">Contact Person</label>
						<input type="text" name="contact_person" id="contact-person" required class="form-control">
					</div>
					<div class="col-sm-6 form-group">
						<label for="contact-no" required>Contact Number</label>
						<input type="text" name="contact_no" id="contact-no" required class="form-control">
					</div>
					<div class="col-sm-12 form-group">
						<label for="street-address">Street Address</label>
						<input type="text" name="street_address" id="street-address" required class="form-control">
					</div>
					<div class="col-sm-4 form-group">
						<label for="barangay">Barangay</label>
						<input type="text" name="barangay" id="barangay" required class="form-control">
					</div>
					<div class="col-sm-4 form-group">
						<label for="city" required>City/Municipality</label>
						<input type="text" name="city" id="city" required class="form-control">
					</div>
					<div class="col-sm-4 form-group">
						<label for="province" required>Province</label>
						<input type="text" name="province" id="province" class="form-control">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<?= $this->Form->button('Add Branch', ['type' => 'submit', 'class' => 'btn btn-primary']) ?>
			</div>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>