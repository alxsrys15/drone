<?php $isShop = $this->request->getParam('controller') === "Products" ?>

<?php foreach ($products as $product): ?>
	<div class="<?= $isShop ? 'col-4' : 'col-3' ?>">
		<div class="card shadow-lg rounded mb-3">
			<?= $this->Html->link(
					$this->Html->image('product_images/' . $product->img1, ['class' => 'card-img-top']),
					['controller' => 'products', 'action' => 'view', $product->id],
					['escape' => false]
				)
			 ?>
			<div class="card-body">
				<?= $this->Html->link('<h5>'.$product->name.'</h5>', ['controller' => 'products', 'action' => 'view', $product->id], ['class' => 'card-title text-center', 'escape' => false]) ?>
				<p class="justify-content-center text-muted">
                    <?= $product->description ?>
                </p>
			</div>
			<div class="card-footer">
                <p class="card-text text-center"><?= 'PHP ' . number_format($product->price, 2) ?></p>
            </div>
		</div>
	</div>
<?php endforeach ?>

