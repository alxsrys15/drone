<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">New Branch Transaction</h1>
	<button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm btn-add"><i class="fas fa-plus fa-sm text-white-50"></i> Add Item</button>
</div>
<div class="row">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h5 class="text-gray-800"><?= $branch->name ?></h5>
	</div>
	<div class="col-sm-12">
		<table class="table" id="items-table">
			<thead>
				<th>Product Name</th>
				<th>Size</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Total</th>
				<th></th>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>
</div>

<div id="template" class="d-none">
	<tr>
		<td>
			<select data-live-search="true" class="product-select" name="order_details[0][product_id]" id="order-details-0-product-id">
				<?php foreach ($products as $p): ?>
				<option data-tokens="<?= $p->name ?>" value="<?= $p->id ?>"><?= $p->name ?></option>
				<?php endforeach ?>
			</select>
		</td>
		<td>
			<select data-live-seach="true" class="size-select" name="order_details[0][size_id]" id="order-details-0-size-id">
				
			</select>
		</td>
	</tr>
</div>

<script type="text/javascript">
	var products = <?= json_encode($products) ?>;
	console.log(products);
	$(document).ready(function () {
		$('.product-select').selectpicker();
		$('.btn-add').on('click', function () {
			$('#items-table tbody').append($('#template').html());
			$('.product-select').selectpicker();
		});

		$('.product-select').on('changed.bs.select', function (e) {
			console.log(e);
			
		});
	});
</script>