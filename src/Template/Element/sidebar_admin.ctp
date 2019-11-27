<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
	<a href="/admin">
        <div class="sidebar-brand-text mx-3" style="color: white">
        	DRONE CLOTHING
        </div>
	</a>
	<hr class="sidebar-divider my-0">
	<li class="nav-item">
        <?= $this->Html->link('<i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span>', ['controller' => 'Admin', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false]) ?>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
       Master Data
    </div>
    <li class="nav-item">
        <?= $this->Html->link('<i class="fa fa-gift"></i><span>Products</span>', ['action' => 'products'], ['class' => 'nav-link', 'escape' => false]) ?>
    </li>
    <li class="nav-item">
        <?= $this->Html->link('<i class="fa fa-book"></i><span>Categories</span>', ['action' => 'categories'], ['class' => 'nav-link', 'escape' => false]) ?>
    </li>
    <li class="nav-item">
        <?= $this->Html->link('<i class="fa fa-users"></i><span>Users</span></a>', ['action' => 'users'], ['class' => 'nav-link', 'escape' => false]) ?>
    </li>
    <li class="nav-item">
        <?= $this->Html->link('<i class="fa fa-users"></i><span>Customers</span></a>', ['action' => 'customers'], ['class' => 'nav-link', 'escape' => false]) ?>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
       Sales
    </div>
    <li class="nav-item">
        <?= $this->Html->link('<i class="fa fa-shopping-cart"></i><span>Orders</span></a>', ['action' => 'orders'], ['class' => 'nav-link', 'escape' => false]) ?>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <!-- <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div> -->
</ul>