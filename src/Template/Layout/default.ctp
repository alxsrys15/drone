<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Drone Clothing Co - Virtual Shop
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->script('jquery.min.js') ?> 
    <?= $this->Html->script('bootstrap.bundle.min.js') ?>
    <?= $this->Html->script('https://cdn.jsdelivr.net/npm/sweetalert2@9') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">
</head>
<body>
    <?php if (is_admin()): ?>
        <?= $this->element('header_admin') ?>
    <?php else: ?>
        <?= $this->element('header') ?>
        <?= $this->Flash->render() ?>
    <?php endif ?>
    
    <div class="row">
        <?php if (is_admin()): ?>
            <div class="col-sm-2">
                <?= $this->element('sidebar_admin') ?>
            </div>
            <div class="col-sm-10">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        <?php else: ?>
            <?= $this->fetch('content') ?>
        <?php endif ?>
    </div>
    <footer>
    </footer>
    <?= $this->Html->script('cart'); ?>
    <?= $this->fetch('script') ?>
    <script type="text/javascript">
        var url = '<?= $this->Url->build('/', true); ?>';
        var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;
        $(document).ready(function () {
            var cartCounter = shoppingCart.listCart().length;
            $('.cart-badge').text(cartCounter);
        });
    </script>
</body>
</html>
