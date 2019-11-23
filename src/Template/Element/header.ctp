<style type="text/css">
    .navbar-
</style>

<nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-first">
    <div class="container">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-phone-alt"></i> 0956-249-5904</a>
            </li> 
            <!-- <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-fire-alt"></i> WHAT'S HOT!</a>
            </li>   -->
            <li class="nav-item">
                <a class="nav-link" href="https://www.instagram.com/droneclothingco/"><i class="fab fa-instagram"></i> #DRONECLOTHINGCO.</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <?php if ($this->request->getSession()->read('Auth.User.id')): ?>
            <li class="nav-item">
                <?= $this->Html->link('LOGOUT', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link']) ?>
            </li>
            <?php else: ?>
            <li class="nav-item">
                <?= $this->Html->link('LOGIN', ['controller' => 'Users', 'action' => 'login'], ['class' => 'nav-link']) ?>
            </li>
            <li class="nav-item">
                <?= $this->Html->link('REGISTER', ['controller' => 'Users', 'action' => 'register'], ['class' => 'nav-link']) ?>
            </li>   
            <?php endif ?>
        </ul>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">
        <!-- <a class="navbar-brand" href="#">
            
        </a> -->
        <?= $this->Html->link($this->Html->image('assets/drone_logo.jpg', ['width' => '150px', 'height' => '100px']), ['controller' => 'Home'], ['class' => 'navbar-brand', 'escape' => false]) ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent1">
          <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto navtab-ul-custom">
                <li class="nav-item">
                    <?= $this->Html->link('HOME', ['controller' => 'home', 'action' => 'index'], ['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('SHOP', '/shop', ['class' => 'nav-link']) ?>   
                </li>
                <!-- <li class="nav-item">
                    <?= $this->Html->link('PROFILE', ['controller' => 'home', 'action' => 'index'], ['class' => 'nav-link']) ?>
                    
                </li> -->
                <li class="nav-item">
                    <?= $this->Html->link('CART', '/cart', ['class' => 'nav-link']) ?>
                    
                </li>
                <!-- <li class="nav-item">
                    <?= $this->Html->link('ABOUT', ['controller' => 'home', 'action' => 'index'], ['class' => 'nav-link']) ?>
                    
                </li> -->
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a id="btn_cart" role="button" href="/cart" class="btn navbar-btn btn-primary right px-4">
                        <span class="badge badge-danger rounded-circle position-absolute king-badger cart-badge"></span><i class="fa fa-shopping-cart"></i>
                    </a>
                    <!-- <button id="btn_srch" class="btn btn-primary navbar-btn px-4" type="button" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">toggle search</span>
                        <i class="fa fa-search"></i>
                    </button> -->
                </div>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="collapse clearfix" id="search">
                <form action="#" method="POST">
                    <div class="input-group my-3">
                        <input type="text" class="form-control form-control-lg">
                        <div class="input-group-append">
                            <button class="input-group-text btn btn-primary" id="basic-addon2"><i class="fas fa-search mr-1 mt-1"></i> Search</button>
                        </div>
                    </div>
                </form>	
            </div>
        </div>
    </div>
</div>