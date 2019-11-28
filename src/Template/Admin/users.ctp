<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Admin Users</h1>
	<button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-target="#users_add_modal" data-toggle="modal"><i class="fas fa-plus fa-sm text-white-50"></i> Add Admin User</button>
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
		<table class="table table-responsive">
			<thead>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Date Created</th>
				<th>Actions</th>
			</thead>
			<tbody>
				<?php foreach ($users as $user): ?>
				<tr>
					<td><?= $user->first_name ?></td>
					<td><?= $user->last_name ?></td>
					<td><?= $user->created ?></td>
					<td>
						<?php if ($user->is_active): ?>
						<?= $this->Html->link('<i class="fa fa-trash" aria-hidden="true"></i> Deactivate',['controller' => 'admin', 'action' => 'usersDelete', $user->id, 0] ,['class' => 'btn btn-danger btn-sm btn-deactivate', 'escape' => false]) ?>
						<?php else: ?>
						<?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i> Activate',['controller' => 'admin', 'action' => 'usersDelete', $user->id, true] ,['class' => 'btn btn-success btn-sm btn-deactivate', 'escape' => false]) ?>
						<?php endif ?>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="users_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Admin User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= $this->Form->create(null, ['url' => ['action' => 'userAdd']]) ?>
			<div class="modal-body">
				<div class="form-group row">
	            	<label for="first-name" class="col-md-4 col-form-label text-md-right">First Name</label>
	            	<div class="col-md-6">
	            		<?= $this->Form->input('first_name', ['class' => 'form-control', 'label' => false, 'required']) ?>
	            	</div>
	            </div>
	            <div class="form-group row">
	            	<label for="last-name" class="col-md-4 col-form-label text-md-right">Last Name</label>
	            	<div class="col-md-6">
	            		<?= $this->Form->input('last_name', ['class' => 'form-control', 'label' => false]) ?>
	            	</div>
	            </div>
	            <div class="form-group row">
	            	<label for="email" class="col-md-4 col-form-label text-md-right">Email address</label>
	            	<div class="col-md-6">
	            		<input type="email" name="email" id="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" required>
	            		<?php if (isset($errors['email'])): ?>
	            		<div class="invalid-feedback">
	  						<?= $errors['email']['unique'] ?>
						</div>
	            		<?php endif ?>
	            	</div>
	            </div>
	            <div class="form-group row">
	            	<label for="password2" class="col-md-4 col-form-label text-md-right">Password</label>
	            	<div class="col-md-6">
	            		<input type="password" name="password" id="password" required class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>">
	            		<?php if (isset($errors['password'])): ?>
	            		<div class="invalid-feedback">
	  						<?= $errors['password']['compare'] ?>
						</div>
	            		<?php endif ?>
	            	</div>
	            </div>
	            <div class="form-group row">
	            	<label for="password2" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
	            	<div class="col-md-6">
	            		<input type="password" name="password2" id="password2" required class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>">
	            		<?php if (isset($errors['password'])): ?>
	            		<div class="invalid-feedback">
	  						<?= $errors['password']['compare'] ?>
						</div>
	            		<?php endif ?>
	            	</div>
	            </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<?= $this->Form->button('Add Admin User', ['type' => 'submit', 'class' => 'btn btn-primary']) ?>
			</div>
			<?= $this->Form->input('is_active', ['type' => 'hidden', 'value' => '1']) ?>
			<?= $this->Form->input('lib_user_roles_id', ['type' => 'hidden', 'value' => '1']) ?>
			</<?= $this->Form->end() ?>
		</div>
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
		$(document).on('click', '.btn-deactivate', function (e) {
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
	});
</script>