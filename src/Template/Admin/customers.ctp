<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Customers</h1>
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
	<div class="col-xl-12 col-lg-12">
		<table class="table">
			<thead>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Member Since</th>
			</thead>
			<tbody>
				<?php foreach ($customers as $customer): ?>
				<tr>
					<td><?= $customer->first_name ?></td>
					<td><?= $customer->last_name ?></td>
					<td><?= $customer->email ?></td>
					<td><?= $customer->created ?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>