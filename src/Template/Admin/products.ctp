<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Products</h1>
	<button class="btn btn-sm btn-primary shadow-sm" data-target="#product_add_modal" data-toggle="modal"><i class="fas fa-plus fa-sm text-white-50"></i> Add Product</button>
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
	<div class="col-sm-12 table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>Product name</th>
					<th>Product Code</th>
					<th>Category</th>
					<th>For who</th>
					<th>Price</th>
					<th>Stocks</th>
					<!-- <th>Action</th> -->
				</tr>
			</thead>
			<tbody>
				<?php foreach ($products as $product): ?>
				<tr>
					<td><?= $product->name ?></td>
					<td><?= $product->product_code ?></td>
					<td><?= $product->category->name ?></td>
					<td><?= $product->gender->name ?></td>
					<td><?= number_format($product->price, 2) ?></td>
					<td>
						<?php 
							$sku = 0;
							foreach ($product->product_variants as $v) {
								$sku += $v->sku;
							}
						 ?>
						 <?= $sku ?>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="product_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= $this->Form->create(null,['url' => ['action' => 'productAdd'], 'enctype' => 'multipart/form-data']) ?>
				<div class="modal-body">
					<div class="form-group">
						<label for="name" class="col-form-label">Name:</label>
						<?= $this->Form->input('name', ['class' => 'form-control', 'required', 'autocomplete' => 'off', 'label' => false]) ?>
					</div>
					<div class="row form-group">
						<div class="col-sm-6">
							<label for="category-id" class="col-form-label">Category:</label>
							<?= $this->Form->input('category_id', ['class' => 'form-control', 'required', 'autocomplete' => 'off', 'label' => false, 'type' => 'select']) ?>
						</div>
						<div class="col-sm-6">
							<label for="gender-id" class="col-form-label">For Whom:</label>
							<?= $this->Form->input('gender_id', ['class' => 'form-control', 'required', 'autocomplete' => 'off', 'label' => false, 'type' => 'select']) ?>
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-form-label">Price:</label>
						<?= $this->Form->input('price', ['class' => 'form-control', 'required', 'autocomplete' => 'off', 'label' => false, 'type' => 'number', 'min' => 1, 'step' => '0.01']) ?>
					</div>
					<div class="form-group">
						<label for="price" class="col-form-label">Description:</label>
						<?= $this->Form->input('description', ['class' => 'form-control', 'required', 'autocomplete' => 'off', 'label' => false, 'type' => 'textarea']) ?>
					</div>
					<div class="row container form-group">
						<div class="col-12">
							<h5>Images</h5>
						</div>
						<div class="col-4">
							<?= $this->Html->image('assets/default-image.jpg', ['class' => 'mx-auto img-fluid preview', 'data-input' => '#img1', 'style' => ['cursor: pointer'],'id' => 'image1-preview']) ?>
							<div class="custom-file d-none">
								  <?= $this->Form->input('img1', ['type' => 'file', 'data-preview' => '#image1-preview', 'class' => 'uploader', 'accept' => 'image/x-png,image/gif,image/jpeg']) ?>
							</div>
						</div>
						<div class="col-4">
							<?= $this->Html->image('assets/default-image.jpg', ['class' => 'mx-auto img-fluid preview', 'data-input' => '#img2', 'style' => ['cursor: pointer'],'id' => 'image2-preview']) ?>
							<div class="custom-file d-none">
								  <?= $this->Form->input('img2', ['type' => 'file', 'data-preview' => '#image2-preview', 'class' => 'uploader', 'accept' => 'image/x-png,image/gif,image/jpeg']) ?>
							</div>
						</div>
						<div class="col-4">
							<?= $this->Html->image('assets/default-image.jpg', ['class' => 'mx-auto img-fluid preview', 'data-input' => '#img3', 'style' => ['cursor: pointer'],'id' => 'image3-preview']) ?>
							<div class="custom-file d-none">
								  <?= $this->Form->input('img3', ['type' => 'file', 'data-preview' => '#image3-preview', 'class' => 'uploader', 'accept' => 'image/x-png,image/gif,image/jpeg']) ?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<a href="#!" class="btn btn-sm btn-primary btn-add-stocks">Add Size</a>
					</div>
					<div id="sizes" class="container">

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<?= $this->Form->button('Add Product', ['type' => 'submit', 'class' => 'btn btn-primary']) ?>
				</div>
			<?= $this->Form->end(); ?>
		</div>
	</div>
</div>

<div id="template" class="d-none">
	<div class="form-row align-items-center">
		<div class="col-6">
			<label class="sr-only">Size</label>
			<?= $this->Form->input('product_variants.0.size_id', ['class' => 'form-control', 'type' => 'select', 'label' => false]) ?>
		</div>
		<div class="col-5">
			<label class="sr-only">Stock</label>
			<?= $this->Form->input('product_variants.0.sku', ['class' => 'form-control sku', 'type' => 'number', 'min' => 1, 'label' => false, 'placeholder' => 'Quantity', 'required']) ?>
		</div>
		<div class="col-1">
			<a class="btn btn-sm btn-danger btn-remove-stocks"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
		</div>
	</div>
</div>

<script type="text/javascript">
	function renameStockInputs () {
		$('#sizes').find('input[type=number]').each(function (i) {
			$(this).attr('name', 'product_variants['+i+'][sku]');
			$(this).attr('id', 'product-variants-'+i+'-sku');
		});
		$('#sizes').find('select').each(function (i) {
			$(this).attr('name', 'product_variants['+i+'][size_id]');
			$(this).attr('id', 'product-variants-'+i+'-size_id');
		});
	}

	function readURL (input, uploader) {
		if (input.files && input.files[0]) {
		    var reader = new FileReader();
		    reader.onload = function(e) {
		      $(uploader.data('preview')).attr('src', e.target.result);
		    }
		    reader.readAsDataURL(input.files[0]);
		 }
	}

	$(document).ready(function () {
		$(document).on('click', '.btn-add-stocks', function () {
			$('#sizes').append($('#template').html());
			renameStockInputs();
		});

		$(document).on('click', '.btn-remove-stocks', function () {
			$(this).parent().parent().remove();
			renameStockInputs();
		});
	});

	$('.preview').on('click', function () {
		$($(this).data('input')).trigger('click');
	});

	$('.uploader').on('change', function () {
		readURL(this, $(this));
	});
</script>