<style type="text/css">
	.invalid {
		border: solid 1px red !important;
	}
</style>

<div class="container">
	<div class="row">
		<div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
			<div class="table-responsive">
				<table class="table" id="cart_table">
					<thead>
						<tr>
							<th scope="col" class="border-0 bg-light">
								<div class="p-2 px-3 text-uppercase">Product</div>
							</th>
							<th scope="col" class="border-0 bg-light">
	                    		<div class="py-2 text-uppercase">Size</div>
	                  		</th>
							<th scope="col" class="border-0 bg-light">
	                    		<div class="py-2 text-uppercase">Price</div>
	                  		</th>
	                  		<th scope="col" class="border-0 bg-light">
	                    		<div class="py-2 text-uppercase">Quantity</div>
	                  		</th>
	                  		<th scope="col" class="border-0 bg-light">
	                    		<div class="py-2 text-uppercase">Action</div>
	                  		</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
				<div class="text-center d-none" id="loader">
				  	<div class="spinner-border spinner-border-lg" role="status">
				    	<span class="sr-only">Loading...</span>
				  	</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row py-5 p-4 bg-white rounded shadow-sm">
		<div class="col-lg-6">
			<div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Payment Method</div>
			<div class="p-4">
	            <p class="font-italic mb-4">Please select a payment method</p>
	            <div class="input-group mb-4 border rounded-pill p-2">
	              	<select class="form-control border-0" id="payment-select">
	              		<option value="paypal">PAYPAL</option>
	              		<option value="paymaya">PAYMAYA</option>
	              		<option value="bank-deposit">BANK DEPOSIT</option>
	              	</select>
	            </div>
			</div>
			<div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Shipping Address</div>
			<div class="p-4">
            	<p class="font-italic mb-4">Please provide an accurate shipping address below</p>
            	<textarea name="" cols="30" rows="2" class="form-control" id="shipping-address-input"></textarea>
          	</div>
		</div>
		<div class="col-lg-6">
			<div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
			<div class="p-4">
				<ul class="list-unstyled mb-4">
					<li class="d-flex justify-content-between py-3 border-bottom">
						<strong class="text-muted">Order Subtotal </strong>
						<strong id="total-cart">$390.00</strong>
					</li>
					<li class="d-flex justify-content-between py-3 border-bottom">
						<strong class="text-muted">Shipping and handling</strong>
						<strong id="shipping-fee">$10.00</strong>
					</li>
					<li class="d-flex justify-content-between py-3 border-bottom">
						<strong class="text-muted">
							Total
						</strong>
                		<h5 class="font-weight-bold" id="total">$400.00</h5>
              		</li>
				</ul>
				<a href="#" class="btn btn-primary rounded-pill py-2 btn-block btn-checkout">Procceed to checkout</a>
			</div>
		</div>
	</div>
</div>

<?= $this->Form->create(null, ['id' => 'cart-form']) ?>
<?= $this->Form->control('payment_type', ['type' => 'hidden']) ?>
<?= $this->Form->control('items', ['type' => 'hidden']) ?>
<?= $this->Form->control('shipping_address', ['type' => 'hidden']) ?>
<?= $this->Form->end() ?>

<script type="text/javascript">
	function populateCartTable () {
		var cart = shoppingCart.listCart();
		
		$.ajax({
			headers: {
        		'X-CSRF-Token': csrfToken
    		},
			url: url + 'products/populateCartTable',
			type: 'post',
			data: {
				data: JSON.stringify(cart)
			},
			beforeSend: function () {
				$('#loader').removeClass('d-none');
			},
			success: function (data) {
				$('#loader').addClass('d-none');
				$('#cart_table tbody').html(data);
			}
		});
	}

	function populateOrderSummary () {
		var total_cart = shoppingCart.totalCart();
		var cart = shoppingCart.listCart();
		var shipping = cart.length > 0 ? 100 : 0;
		$('#shipping-fee').text('P' + shipping.toFixed(2));
		$('#total-cart').text('P' + total_cart.toFixed(2));
		$("#total").text('P' + (total_cart + shipping).toFixed(2));
	}

	$('#payment-select').on('change', function () {
		$('#payment-type').val($(this).val());
	});

	$(document).ready(function () {
		populateCartTable();
		populateOrderSummary();
		$('#payment-select').trigger('change');
		$('.btn-checkout').on('click', function () {
			$('#items').val(JSON.stringify(shoppingCart.listCart()));
			if ($('#shipping-address-input').val() == "") {
				$('#shipping-address-input').addClass('is-invalid');
				$('#shipping-address-input').focus();
				Swal.fire(
	                'Error!',
	                'Please provide a shipping address',
	                'error'
	            );
	            return;
			}
			$('#shipping-address').val($('#shipping-address-input').val());
			$('#cart-form').trigger('submit');
		});
	});
</script>