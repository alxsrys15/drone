<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>

<style type="text/css">
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    },
    #quantity {
        direction: rtl;
    }
</style>

<div class="container">
    <div class="card" style="padding: 10px">
        <div class="row">
            <div class="col-5">
                <div class="carousel slide" data-ride="carousel" id="productCarousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <?= $this->Html->image('product_images/' . $product->img1, ['class' => 'd-block w-100']) ?>
                        </div>
                        <?php if (!empty($product->img2)): ?>
                        <div class="carousel-item">
                            <?= $this->Html->image('product_images/' . $product->img2, ['class' => 'd-block w-100']) ?>
                        </div>
                        <?php endif ?>
                        <?php if (!empty($product->img3)): ?>
                        <div class="carousel-item">
                            <?= $this->Html->image('product_images/' . $product->img3, ['class' => 'd-block w-100']) ?>
                        </div>
                        <?php endif ?>
                    </div>
                    <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-7" style="margin-top: 16px">
                <h3 class="title mb-3"><?= $product->name ?></h3>
                <h4 class="title">PHP <?= $product->price ?></h4>
                <dl>
                    <dt>Description</dt>
                    <dd>
                        <p>
                            <?= $product->description ?> 
                        </p>
                    </dd>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <dl>
                            <dt>Size</dt>
                            <dd>
                                <?= $this->Form->input('sizes', ['form-control', 'options' => $sizes, 'type' => 'select', 'label' => false]) ?>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <dl>
                            <dt>Quantity</dt>
                            <dd>
                                <div class="input-group">
                                    <div class="input-group-prepend spinner minus">
                                        <button class="btn btn-outline-primary" type="button" id="button-addon1">-</button>
                                    </div>
                                    <input type="number" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" min="1" id="quantity" disabled value="1">
                                    <div class="input-group-append spinner add">
                                        <button class="btn btn-outline-primary" type="button" id="button-addon1">+</button>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="col-6">
                        <dl>
                            <dt>Available:</dt>
                            <dd id="available_items">
                                
                            </dd>
                        </dl>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <button type="button" class="btn btn-primary btn-block" data-name="<?= $product->name ?>" data-price="<?= $product->price ?>" id="add-to-cart-btn" data-image="<?= $product->img1 ?>" data-id="<?= $product->id ?>">
                            <i class="fa fa-cart-plus"></i>
                            Add to cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    var sizes = <?= json_encode($sizes); ?>;
    var sku = <?= json_encode($sku) ?>;
    $(document).ready(function () {
        $('#sizes').on('change', function () {
            var selected = $(this).val();
            $('#available_items').text(sku[selected]);
            $('#quantity').attr('max', sku[selected]);
            if (sku[selected] <= 0) {
                $('#add-to-cart-btn').prop('disabled', true);
            }
        });

        $('#sizes').trigger('change');

        $('.spinner').on('click', function () {
            var quantity = $('#quantity').val();
            var min = $('#quantity').attr('min');
            var max = $('#quantity').attr('max');
            if ($(this).hasClass('add')) {
                if (Number(quantity) < max) {
                    $('#quantity').val(Number(quantity) + 1);
                }
            } else {
                if (Number(quantity) > 1) {
                    $('#quantity').val(Number(quantity) - 1);
                }
            }
        });

        $('#add-to-cart-btn').on('click', function () {
            var item = {
                name: $(this).data('name'),
                price: Number($(this).data('price')),
                quantity: Number($('#quantity').val()),
                image: $(this).data('image'),
                id: $(this).data('id'),
                size_id: $('#sizes').val(),
                size_name: $("#sizes option:selected").html()
            };
            console.log(item);
            shoppingCart.addItemToCart(item.name, item.price, item.quantity, item.image, item.id, item.size_id, item.size_name);
            Swal.fire(
                'Success!',
                'Item added to cart',
                'success'
            );
            var cartCounter = shoppingCart.listCart().length;
            $('.cart-badge').text(cartCounter);
        }); 
    });
</script>