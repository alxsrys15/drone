
<?php foreach ($cart as $product): ?>
<tr scope="row" class="border-0">
	<th>
		<div class="p-2">
			<?= $this->Html->image('product_images/' . $product['image'], ['class' => 'img-fluid rounded shadow-sm', 'width' => '70']) ?>
		</div>
		<div class="ml-3 d-inline-block align-middle">
	        <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle"><?= $product['name'] ?></a></h5>
	     </div>
	</th>
	<td class="border-0 align-middle"><strong>PHP <?= number_format($product['price'], 2) ?></strong></td>
	<td class="border-0 align-middle"><strong><?= $product['count'] ?></strong></td>
	<td class="border-0 align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a></strong></td>
</tr>
<?php endforeach ?>