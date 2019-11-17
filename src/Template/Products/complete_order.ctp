<?php 
$total = 0;
foreach ($items as $item) {
	$total += $item['price'] * $item['count'];
}
?>

<div class="container">
	<h4>Thank you for shopping with us.</h4>
	<p class="mb-4">Here is your order summary.</p>
	<div class="row">
		<div class="col-lg-8 p-3 bg-white rounded shadow-sm mb-3">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th scope="col" class="border-0 bg-light">
								<div class="p-2 px-3 text-uppercase">Product</div>
							</th>
							<th scope="col" class="border-0 bg-light">
								<div class="p-2 px-3 text-uppercase">Size</div>
							</th>
							<th scope="col" class="border-0 bg-light">
	                    		<div class="py-2 text-uppercase">Price</div>
	                  		</th>
	                  		<th scope="col" class="border-0 bg-light">
	                    		<div class="py-2 text-uppercase">Quantity</div>
	                  		</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($items as $item): ?>
							<tr scope="row" class="border-0">
								<th>
									<div class="p-2">
										<?= $this->Html->image('product_images/' . $item['image'], ['class' => 'img-fluid rounded shadow-sm', 'width' => '70']) ?>
									</div>
									<div class="ml-3 d-inline-block align-middle">
								        <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle"><?= $item['name'] ?></a></h5>
								     </div>
								</th>
								<td class="border-0 align-middle"><strong><?= $item['size_name'] ?></strong></td>
								<td class="border-0 align-middle"><strong>PHP <?= number_format($item['price'], 2) ?></strong></td>
								<td class="border-0 align-middle"><strong><?= $item['count'] ?></strong></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-lg-4 p-3 bg-white rounded shadow-sm mb-3">
			<div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
			<div class="p-4">
				<ul class="list-unstyled mb-4">
					<li class="d-flex justify-content-between py-3 border-bottom">
						<strong class="text-muted">Order Subtotal </strong>
						<strong id="total-cart">P<?= number_format($total, 2) ?></strong>
					</li>
					<li class="d-flex justify-content-between py-3 border-bottom">
						<strong class="text-muted">Shipping and handling</strong>
						<strong id="shipping-fee">P100.00</strong>
					</li>
					<li class="d-flex justify-content-between py-3 border-bottom">
						<strong class="text-muted">
							Total
						</strong>
                		<h5 class="font-weight-bold" id="total">P<?= number_format($total + 100, 2) ?></h5>
              		</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		shoppingCart.clearCart();
		cartBadge();
	});
</script>