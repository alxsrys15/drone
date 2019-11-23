<?php if (count($cart) > 0): ?>
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
		<td class="border-0 align-middle"><strong><?= $product['size_name'] ?></strong></td>
		<td class="border-0 align-middle"><strong>PHP <?= number_format($product['price'], 2) ?></strong></td>
		<td class="border-0 align-middle"><strong><?= $product['count'] ?></strong></td>
		<td class="border-0 align-middle"><a href="#" class="text-dark class remove-item" data-name="<?= $product['name'] ?>" data-size="<?= $product['size_name'] ?>"><i class="fa fa-trash"></i></a></strong></td>
	</tr>
	<?php endforeach ?>
<?php else: ?>
	<tr scope="row" class="border-0">
		<td colspan="20" class="border-0 align-middle text-center">
			<strong>No item items in cart.</strong>
		</td>
	</tr>
	<tr scope="row" class="border-0">
		<td colspan="20" class="border-0 align-middle text-center">
			<strong>Click <?= $this->Html->link('here', '/shop') ?> to shop.</strong>
		</td>
	</tr>
<?php endif ?>