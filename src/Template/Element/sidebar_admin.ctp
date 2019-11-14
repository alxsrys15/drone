<div class="nav flex-column nav-pills" id="v-pills-tab">
	<a class="nav-link" href="#" ><i class="fa fa-tachometer-alt" aria-hidden="true"></i> Dashboard</a>
	<?= $this->Html->link('<i class="fa fa-gift" aria-hidden="true"></i> Products', ['controller' => 'admin', 'action' => 'products'], ['class' => 'nav-link', 'escape' => false]) ?>
	<?= $this->Html->link('<i class="fa fa-book" aria-hidden="true"></i> Categories', ['controller' => 'admin', 'action' => 'categories'], ['class' => 'nav-link', 'escape' => false]) ?>
	<a class="nav-link" href="#"><i class="fa fa-user" aria-hidden="true"></i> View Customers</a>
	<a class="nav-link" href="#"><i class="fa fa-book" aria-hidden="true"></i> Orders</a>
	<a class="nav-link" href="#"><i class="fa fa-users" aria-hidden="true"></i> Users</a>
</div>