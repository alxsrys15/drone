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
</div>

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
	$(document).ready(function () {
		populateCartTable();
	});
</script>