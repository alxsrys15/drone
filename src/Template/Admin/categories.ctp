<div class="jumbotron">
	<div class="row">
		<div class="col-sm-3">
			<h2>Product Categories</h2>
		</div>
		<div class="col-sm-9">
			<!-- <button class="btn btn-primary float-right" data-toggle="modal" data-target="#product_add_modal"><i class="fas fa-plus"></i> Add Product</button> -->
			<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#category_add_modal" data-whatever="@mdo"><i class="fas fa-plus"></i> Add Category</button>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<table class="table table-stripped table-condensed table-light table-bordered text-center">
				<thead class="thead-dark">
					<tr>
						<th>Category Name</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($categories as $category): ?>
					<tr>
						<td><?= $category->name ?></td>
						<td><?= $category->is_active ? 'Active' : 'Not Active' ?></td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="category_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= $this->Form->create(null, ['url' => ['action' => 'categories_add']]) ?>
			<div class="modal-body">
				<div class="form-group">
					<label for="message-text" class="col-form-label">Name:</label>
					<?= $this->Form->input('name', ['class' => 'form-control', 'label' => false, 'autocomplete' => 'off', 'required']) ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<?= $this->Form->button('Add Category', ['type' => 'submit', 'class' => 'btn btn-primary']) ?>
			</div>
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
	})
</script>