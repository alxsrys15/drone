<?php $cat = !empty($this->request->query['category']) ? $this->request->query['category'] : "" ?>

<div id="menu_sidebar">
    <div class="card">
        <div class="card-header text-center">
            <h5 class="panel-title">PRODUCT CATEGORIES</h5>
        </div>
        <div class="row">
            <div class="col-11 mx-auto my-4">
                <div class="list-group list-group-flush " id="list-tab" role="tablist">
                    <?php foreach ($categories as $category): ?>
                        <?= $this->Html->link($category->name, ['controller' => 'products', 'action' => 'index', '?' => ['category' => $category->id]], ['class' => $cat == $category->id ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action']) ?>
                    <?php endforeach ?>
                </div>	
            </div>
        </div>
    </div>
    <!-- <div class="card mt-5">
        <div class="card-header text-center">
            <h5 class="panel-title">PRODUCTS</h5>
        </div>
        <div class="row">
            <div class="col-11 mx-auto my-4">
                <div class="list-group list-group-flush " id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">MEN</a>
                    <a class="list-group-item list-group-item-action active" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">WOMEN</a>
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">OTHERS</a>
                </div>	
            </div>
        </div>
    </div> -->	
</div>
    